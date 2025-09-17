<?php

namespace App\Http\Controllers;

use App\Models\Persyaratandasar;
use App\Models\App;
use App\Models\Uploads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class PersyaratandasarController extends Controller
{
    var $persyaratandasar;

    public function __construct()
    {
        $this->persyaratandasar = new Persyaratandasar;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'persyaratandasar';
        return view('persyaratandasar.index', $data);
    }

    public function tambah()
    {
        $data['idpersyaratandasar'] = '';
        $data['menu'] = 'persyaratandasar';
        $data['ltambah'] = true;
        return view('persyaratandasar.form', $data);
    }

    public function edit($idpersyaratandasar)
    {
        try {
            $idpersyaratandasar = Crypt::decrypt($idpersyaratandasar);
            $rsPersyaratanDasar = Persyaratandasar::findOrFail($idpersyaratandasar);
        } catch (ModelNotFoundException $e) {
            return redirect('persyaratandasar')->with('other', 'Data tidak ditemukan!');
        }
        $data['menu'] = 'persyaratandasar';
        $data['idpersyaratandasar'] = $idpersyaratandasar;
        $data['ltambah'] = false;
        return view('persyaratandasar.form', $data);
    }

    public function listindex(Request $request)
    {
        // Query dasar
        $query = Persyaratandasar::select("*");

        if ($request->has('statusFilter') && $request->input('statusFilter') != 'Semua') {
            $status = $request->input('statusFilter');
            $query->where('statusaktif', $status);
        }

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where('idpersyaratandasar', 'LIKE', "%{$search}%")
                ->orWhere('namapersyaratandasar', 'LIKE', "%{$search}%");
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'idpersyaratandasar', 'namapersyaratandasar', null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('idpersyaratandasar', 'Asc');
            }
        } else {
            $query->orderBy('idpersyaratandasar', 'Asc');
        }


        // Hitung total data tanpa filter
        $totalData = Persyaratandasar::count();

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
                'idpersyaratandasar' => $row->idpersyaratandasar,
                'namapersyaratandasar' => $row->namapersyaratandasar,
                'batasminimal' => 'Kabupaten: ' . $row->batasminimalkabupaten . '<br>Kota: ' . $row->batasminimalkota,
                'statusaktif' => $statusaktif,
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('persyaratandasar/hapus/' . Crypt::encrypt($row->idpersyaratandasar)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('persyaratandasar/edit/' . Crypt::encrypt($row->idpersyaratandasar)) . '" class="btn btn-warning">Edit</a>                                
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
        $idpersyaratandasar = $request->get('idpersyaratandasar');
        $namapersyaratandasar = $request->get('namapersyaratandasar');
        $batasminimalkabupaten = $request->get('batasminimalkabupaten');
        $batasminimalkota = $request->get('batasminimalkota');
        $statusaktif = $request->get('statusaktif');
        $ltambah = $request->get('ltambah');
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');

        if ($ltambah) {
            $data = array(
                'idpersyaratandasar' => $idpersyaratandasar,
                'namapersyaratandasar' => $namapersyaratandasar,
                'batasminimalkabupaten' => $batasminimalkabupaten,
                'batasminimalkota' => $batasminimalkota,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'statusaktif' => $statusaktif,
                'idpengguna' => session()->get('idpengguna'),
            );
            $simpan = $this->persyaratandasar->simpanData($data);
        } else {
            $data = array(
                'idpersyaratandasar' => $idpersyaratandasar,
                'namapersyaratandasar' => $namapersyaratandasar,
                'batasminimalkabupaten' => $batasminimalkabupaten,
                'batasminimalkota' => $batasminimalkota,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'statusaktif' => $statusaktif,
                'idpengguna' => session()->get('idpengguna'),
            );
            $simpan = $this->persyaratandasar->updateData($data, $idpersyaratandasar);
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



    public function hapus($idpersyaratandasar)
    {
        $idpersyaratandasar = Crypt::decrypt($idpersyaratandasar);
        try {
            $rsPersyaratanDasar = Persyaratandasar::findOrFail($idpersyaratandasar);
        } catch (ModelNotFoundException $e) {
            return redirect('persyaratandasar')->with('other', 'Data tidak ditemukan!');
        }

        $hapus = $this->persyaratandasar->hapusData($idpersyaratandasar, $rsPersyaratanDasar);
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
        $idpersyaratandasar = $request->input('idpersyaratandasar');
        $rsPersyaratanDasar = Persyaratandasar::find($idpersyaratandasar);
        return response()->json($rsPersyaratanDasar);
    }
}
