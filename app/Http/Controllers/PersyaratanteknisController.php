<?php

namespace App\Http\Controllers;

use App\Models\Persyaratanteknis;
use App\Models\App;
use App\Models\Uploads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class PersyaratanteknisController extends Controller
{
    var $persyaratanteknis;

    public function __construct()
    {
        $this->persyaratanteknis = new Persyaratanteknis;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'persyaratanteknis';
        return view('persyaratanteknis.index', $data);
    }

    public function tambah()
    {
        $data['idpersyaratanteknis'] = '';
        $data['menu'] = 'persyaratanteknis';
        $data['ltambah'] = true;
        return view('persyaratanteknis.form', $data);
    }

    public function edit($idpersyaratanteknis)
    {
        try {
            $idpersyaratanteknis = Crypt::decrypt($idpersyaratanteknis);
            $rsPersyaratanTeknis = Persyaratanteknis::findOrFail($idpersyaratanteknis);
        } catch (ModelNotFoundException $e) {
            return redirect('persyaratanteknis')->with('other', 'Data tidak ditemukan!');
        }
        $data['menu'] = 'persyaratanteknis';
        $data['idpersyaratanteknis'] = $idpersyaratanteknis;
        $data['ltambah'] = false;
        return view('persyaratanteknis.form', $data);
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
            $query->where('idpersyaratanteknis', 'LIKE', "%{$search}%")
                ->orWhere('namapersyaratanteknis', 'LIKE', "%{$search}%");
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'idpersyaratanteknis', 'namapersyaratanteknis', null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('idpersyaratanteknis', 'Asc');
            }
        } else {
            $query->orderBy('idpersyaratanteknis', 'Asc');
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
                'idpersyaratanteknis' => $row->idpersyaratanteknis,
                'namapersyaratanteknis' => $row->namapersyaratanteknis,
                'statusaktif' => $statusaktif,
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('persyaratanteknis/hapus/' . Crypt::encrypt($row->idpersyaratanteknis)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('persyaratanteknis/edit/' . Crypt::encrypt($row->idpersyaratanteknis)) . '" class="btn btn-warning">Edit</a>                                
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
        $idpersyaratanteknis = $request->get('idpersyaratanteknis');
        $namapersyaratanteknis = $request->get('namapersyaratanteknis');
        $statusaktif = $request->get('statusaktif');
        $ltambah = $request->get('ltambah');
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');

        if ($ltambah) {
            $data = array(
                'idpersyaratanteknis' => $idpersyaratanteknis,
                'namapersyaratanteknis' => $namapersyaratanteknis,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'statusaktif' => $statusaktif,
                'idpengguna' => session()->get('idpengguna'),
            );
            $simpan = $this->persyaratanteknis->simpanData($data);
        } else {
            $data = array(
                'idpersyaratanteknis' => $idpersyaratanteknis,
                'namapersyaratanteknis' => $namapersyaratanteknis,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'statusaktif' => $statusaktif,
                'idpengguna' => session()->get('idpengguna'),
            );
            $simpan = $this->persyaratanteknis->updateData($data, $idpersyaratanteknis);
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



    public function hapus($idpersyaratanteknis)
    {
        $idpersyaratanteknis = Crypt::decrypt($idpersyaratanteknis);
        try {
            $rsPersyaratanTeknis = Persyaratanteknis::findOrFail($idpersyaratanteknis);
        } catch (ModelNotFoundException $e) {
            return redirect('persyaratanteknis')->with('other', 'Data tidak ditemukan!');
        }

        $hapus = $this->persyaratanteknis->hapusData($idpersyaratanteknis, $rsPersyaratanTeknis);
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
        $idpersyaratanteknis = $request->input('idpersyaratanteknis');
        $rsPersyaratanTeknis = Persyaratanteknis::find($idpersyaratanteknis);
        return response()->json($rsPersyaratanTeknis);
    }
}
