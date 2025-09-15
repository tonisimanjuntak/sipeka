<?php

namespace App\Http\Controllers\admin;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PenggunaController extends Controller
{
    var $pengguna;

    public function __construct()
    {
        $this->pengguna = new Pengguna;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'pengguna';
        return view('pengguna.index', $data);
    }

    public function tambah()
    {
        $data['idpengguna'] = '';
        $data['menu'] = 'pengguna';
        return view('pengguna.form', $data);
    }

    public function edit($idpengguna)
    {
        try {
            $idpengguna = Crypt::decrypt($idpengguna);
            $rsAdmin = Pengguna::findOrFail($idpengguna);
        } catch (ModelNotFoundException $e) {
            return redirect('pengguna')->with('other', 'Data tidak ditemukan!');
        }
        $data['menu'] = 'pengguna';
        $data['idpengguna'] = $idpengguna;
        return view('pengguna.form', $data);
    }

    public function listindex(Request $request)
    {
        // Query dasar
        $query = Pengguna::select("*");

        if ($request->has('statusFilter') && $request->input('statusFilter') != 'Semua') {
            $status = $request->input('statusFilter');
            $query->where('statusaktif', $status);
        }

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where('idpengguna', 'LIKE', "%{$search}%")
                ->orWhere('namalengkap', 'LIKE', "%{$search}%");
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, null, 'idpengguna', 'namalengkap', 'statusaktif', null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('idpengguna', 'Asc');
            }
        } else {
            $query->orderBy('idpengguna', 'Asc');
        }


        // Hitung total data tanpa filter
        $totalData = Pengguna::count();

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
                'idpengguna' => $row->idpengguna,
                'namalengkap' => $row->namalengkap,
                'statusaktif' => $statusaktif,
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('pengguna/hapus/' . Crypt::encrypt($row->idpengguna)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('pengguna/edit/' . Crypt::encrypt($row->idpengguna)) . '" class="btn btn-warning">Edit</a>                                
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
        $idpengguna = $request->get('idpengguna');
        $namalengkap = $request->get('namalengkap');
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');
        $statusaktif = $request->get('statusaktif');

        if (empty($idpengguna)) {

            $idpengguna = $this->pengguna->createID();

            $data = array(
                'idpengguna' => $idpengguna,
                'namalengkap' => $namalengkap,
                'statusaktif' => $statusaktif,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'idadmin' => session('idadmin'),
            );
            $simpan = $this->pengguna->simpanData($data);
        } else {

            $data = array(
                'idpengguna' => $idpengguna,
                'namalengkap' => $namalengkap,
                'statusaktif' => $statusaktif,
                'updated_date' => $updated_date,
                'idadmin' => session('idadmin'),
            );

            $simpan = $this->pengguna->updateData($data, $idpengguna);
        }

        // dd(htmlspecialchars($simpan['message']));
        if ($simpan['status'] == 'success') {
            return redirect('pengguna')->with('success', $simpan['message']);
        } else {
            return redirect('pengguna')->with('fail', 'Data gagal disimpan! Error: ' . $simpan['message']);
        }
    }



    public function hapus($idpengguna)
    {
        $idpengguna = Crypt::decrypt($idpengguna);
        try {
            $rsAdmin = Pengguna::findOrFail($idpengguna);
        } catch (ModelNotFoundException $e) {
            return redirect('pengguna')->with('other', 'Data tidak ditemukan!');
        }

        $hapus = $this->pengguna->hapusData($idpengguna, $rsAdmin);
        if ($hapus['status'] == 'success') {
            return redirect('pengguna')->with('success', $hapus['message']);
        } else {
            return redirect('pengguna')->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }

    public function getId(Request $request)
    {
        $idpengguna = $request->input('idpengguna');
        $rsAdmin = Pengguna::find($idpengguna);
        return response()->json($rsAdmin);
    }
}
