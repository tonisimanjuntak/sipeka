<?php

namespace App\Http\Controllers;

use App\Models\Pembentukankecamatan;
use App\Models\App;
use App\Models\Uploads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class PembentukankecamatanController extends Controller
{
    var $pembentukankecamatan;

    public function __construct()
    {
        $this->pembentukankecamatan = new Pembentukankecamatan;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'pembentukankecamatan';
        return view('pembentukankecamatan.index', $data);
    }

    public function tambah()
    {
        $data['idpengajuan'] = '';
        $data['menu'] = 'pembentukankecamatan';
        $data['ltambah'] = true;
        return view('pembentukankecamatan.form', $data);
    }

    public function edit($idpengajuan)
    {
        try {
            $idpengajuan = Crypt::decrypt($idpengajuan);
            $rsPersyaratanTeknis = Persyaratanteknis::findOrFail($idpengajuan);
        } catch (ModelNotFoundException $e) {
            return redirect('pembentukankecamatan')->with('other', 'Data tidak ditemukan!');
        }
        $data['menu'] = 'pembentukankecamatan';
        $data['idpengajuan'] = $idpengajuan;
        $data['ltambah'] = false;
        return view('pembentukankecamatan.form', $data);
    }

    public function listindex(Request $request)
    {
        // Query dasar
        $query = Persyaratanteknis::select("*");

        if ($request->has('statusFilter') && $request->input('statusFilter') != 'Semua') {
            $status = $request->input('statusFilter');
            $query->where('statusaktif', $status);
        }

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where('idpengajuan', 'LIKE', "%{$search}%")
                ->orWhere('namapersyaratanteknis', 'LIKE', "%{$search}%");
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'idpengajuan', 'namapersyaratanteknis', null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('idpengajuan', 'Asc');
            }
        } else {
            $query->orderBy('idpengajuan', 'Asc');
        }


        // Hitung total data tanpa filter
        $totalData = Persyaratanteknis::count();

        // Hitung total data setelah filter (jika ada pencarian)
        $totalFiltered = $query->count();

        // Ambil parameter 'length' dan 'start' dari DataTables
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);

        // Ambil data dengan limit dan offset
        $rsData = $query->offset($start)
            ->limit($limit)
            ->get();


        // Format data untuk DataTables
        $data = [];
        $no = 1;
        foreach ($rsData as $row) {

            if ($row->statusaktif == 'Aktif') {
                $statusaktif = '<span class="badge badge-success">Aktif</span>';
            } else {
                $statusaktif = '<span class="badge badge-danger">Tidak Aktif</span>';
            }

            $data[] = [
                'no' => $no++,
                'idpengajuan' => $row->idpengajuan,
                'namapersyaratanteknis' => $row->namapersyaratanteknis,
                'statusaktif' => $statusaktif,
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('pembentukankecamatan/hapus/' . Crypt::encrypt($row->idpengajuan)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('pembentukankecamatan/edit/' . Crypt::encrypt($row->idpengajuan)) . '" class="btn btn-warning">Edit</a>                                
                            </div>',

            ];
        }

        // Response untuk DataTables
        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $data,
        ]);
    }

    public function simpan(Request $request)
    {
        $idpengajuan = $request->get('idpengajuan');
        $namapersyaratanteknis = $request->get('namapersyaratanteknis');
        $statusaktif = $request->get('statusaktif');
        $ltambah = $request->get('ltambah');
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');

        if ($ltambah) {
            $data = array(
                'idpengajuan' => $idpengajuan,
                'namapersyaratanteknis' => $namapersyaratanteknis,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'statusaktif' => $statusaktif,
                'idpengguna' => session()->get('idpengguna'),
            );
            $simpan = $this->pembentukankecamatan->simpanData($data);
        } else {
            $data = array(
                'idpengajuan' => $idpengajuan,
                'namapersyaratanteknis' => $namapersyaratanteknis,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'statusaktif' => $statusaktif,
                'idpengguna' => session()->get('idpengguna'),
            );
            $simpan = $this->pembentukankecamatan->updateData($data, $idpengajuan);
        }

        // dd(htmlspecialchars($simpan['message']));
        if ($simpan['status'] == 'success') {
            return response()->json([
                'success' => true,
            ]);
        } else {
            return response()->json([
                'message' => 'Data gagal disimpan! Error: ' . $simpan['message'],
            ]);
        }
    }



    public function hapus($idpengajuan)
    {
        $idpengajuan = Crypt::decrypt($idpengajuan);
        try {
            $rsPersyaratanTeknis = Persyaratanteknis::findOrFail($idpengajuan);
        } catch (ModelNotFoundException $e) {
            return redirect('pembentukankecamatan')->with('other', 'Data tidak ditemukan!');
        }

        $hapus = $this->pembentukankecamatan->hapusData($idpengajuan, $rsPersyaratanTeknis);
        if ($hapus['status'] == 'success') {
            return response()->json([
                'success' => true,
            ]);            
        } else {
            return response()->json([
                'message' => 'Data gagal dihapus! Error: ' . $hapus['message'],
            ]);
        }
    }

    public function getId(Request $request)
    {
        $idpengajuan = $request->input('idpengajuan');
        $rsPersyaratanTeknis = Persyaratanteknis::find($idpengajuan);
        return response()->json($rsPersyaratanTeknis);
    }
}
