<?php

namespace App\Http\Controllers;

use App\Models\Persyaratanadministratif;
use App\Models\App;
use App\Models\Uploads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class PersyaratanadministratifController extends Controller
{
    var $persyaratanadministratif;

    public function __construct()
    {
        $this->persyaratanadministratif = new Persyaratanadministratif;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'persyaratanadministratif';
        return view('persyaratanadministratif.index', $data);
    }

    public function tambah()
    {
        $data['idpersyaratanadministratif'] = '';
        $data['menu'] = 'persyaratanadministratif';
        $data['ltambah'] = true;
        return view('persyaratanadministratif.form', $data);
    }

    public function edit($idpersyaratanadministratif)
    {
        try {
            $idpersyaratanadministratif = Crypt::decrypt($idpersyaratanadministratif);
            $rsPersyaratanAdministratif = Persyaratanadministratif::findOrFail($idpersyaratanadministratif);
        } catch (ModelNotFoundException $e) {
            return redirect('persyaratanadministratif')->with('other', 'Data tidak ditemukan!');
        }
        $data['menu'] = 'persyaratanadministratif';
        $data['idpersyaratanadministratif'] = $idpersyaratanadministratif;
        $data['ltambah'] = false;
        return view('persyaratanadministratif.form', $data);
    }

    public function listindex(Request $request)
    {
        // Query dasar
        $query = Persyaratanadministratif::select("*");

        if ($request->has('statusFilter') && $request->input('statusFilter') != 'Semua') {
            $status = $request->input('statusFilter');
            $query->where('statusaktif', $status);
        }

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where('idpersyaratanadministratif', 'LIKE', "%{$search}%")
                ->orWhere('namapersyaratanadministratif', 'LIKE', "%{$search}%");
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'idpersyaratanadministratif', 'namapersyaratanadministratif', null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('idpersyaratanadministratif', 'Asc');
            }
        } else {
            $query->orderBy('idpersyaratanadministratif', 'Asc');
        }


        // Hitung total data tanpa filter
        $totalData = Persyaratanadministratif::count();

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
                'idpersyaratanadministratif' => $row->idpersyaratanadministratif,
                'namapersyaratanadministratif' => $row->namapersyaratanadministratif,
                'statusaktif' => $statusaktif,
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('persyaratanadministratif/hapus/' . Crypt::encrypt($row->idpersyaratanadministratif)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('persyaratanadministratif/edit/' . Crypt::encrypt($row->idpersyaratanadministratif)) . '" class="btn btn-warning">Edit</a>                                
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
        $idpersyaratanadministratif = $request->get('idpersyaratanadministratif');
        $namapersyaratanadministratif = $request->get('namapersyaratanadministratif');
        $statusaktif = $request->get('statusaktif');
        $ltambah = $request->get('ltambah');
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');

        if ($ltambah) {
            $data = array(
                'idpersyaratanadministratif' => $idpersyaratanadministratif,
                'namapersyaratanadministratif' => $namapersyaratanadministratif,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'statusaktif' => $statusaktif,
                'idpengguna' => session()->get('idpengguna'),
            );
            $simpan = $this->persyaratanadministratif->simpanData($data);
        } else {
            $data = array(
                'idpersyaratanadministratif' => $idpersyaratanadministratif,
                'namapersyaratanadministratif' => $namapersyaratanadministratif,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'statusaktif' => $statusaktif,
                'idpengguna' => session()->get('idpengguna'),
            );
            $simpan = $this->persyaratanadministratif->updateData($data, $idpersyaratanadministratif);
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



    public function hapus($idpersyaratanadministratif)
    {
        $idpersyaratanadministratif = Crypt::decrypt($idpersyaratanadministratif);
        try {
            $rsPersyaratanAdministratif = Persyaratanadministratif::findOrFail($idpersyaratanadministratif);
        } catch (ModelNotFoundException $e) {
            return redirect('persyaratanadministratif')->with('other', 'Data tidak ditemukan!');
        }

        $hapus = $this->persyaratanadministratif->hapusData($idpersyaratanadministratif, $rsPersyaratanAdministratif);
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
        $idpersyaratanadministratif = $request->input('idpersyaratanadministratif');
        $rsPersyaratanAdministratif = Persyaratanadministratif::find($idpersyaratanadministratif);
        return response()->json($rsPersyaratanAdministratif);
    }
}
