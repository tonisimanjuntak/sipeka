<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\App;
use App\Models\Uploads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class KabupatenController extends Controller
{
    var $kabupaten;

    public function __construct()
    {
        $this->kabupaten = new Kabupaten;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'kabupaten';
        return view('kabupaten.index', $data);
    }

    public function tambah()
    {
        $data['kodekabupaten'] = '';
        $data['menu'] = 'kabupaten';
        $data['ltambah'] = true;
        return view('kabupaten.form', $data);
    }

    public function edit($kodekabupaten)
    {
        try {
            $kodekabupaten = Crypt::decrypt($kodekabupaten);
            $rsKabupaten = Kabupaten::findOrFail($kodekabupaten);
        } catch (ModelNotFoundException $e) {
            return redirect('kabupaten')->with('other', 'Data tidak ditemukan!');
        }
        $data['menu'] = 'kabupaten';
        $data['kodekabupaten'] = $kodekabupaten;
        $data['ltambah'] = false;
        return view('kabupaten.form', $data);
    }

    public function listindex(Request $request)
    {
        // Query dasar
        $query = Kabupaten::select("*");

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where('kodekabupaten', 'LIKE', "%{$search}%")
                ->orWhere('namakabupaten', 'LIKE', "%{$search}%");
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'kodekabupaten', 'namakabupaten', null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('kodekabupaten', 'Asc');
            }
        } else {
            $query->orderBy('kodekabupaten', 'Asc');
        }


        // Hitung total data tanpa filter
        $totalData = Kabupaten::count();

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

            $data[] = [
                'no' => $no++,
                'kodekabupaten' => $row->kodekabupaten,
                'namakabupaten' => $row->namakabupaten,
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('kabupaten/hapus/' . Crypt::encrypt($row->kodekabupaten)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('kabupaten/edit/' . Crypt::encrypt($row->kodekabupaten)) . '" class="btn btn-warning">Edit</a>                                
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
        $kodekabupaten = $request->get('kodekabupaten');
        $namakabupaten = $request->get('namakabupaten');
        $ltambah = $request->get('ltambah');
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');

        if ($ltambah) {
            $data = array(
                'kodekabupaten' => $kodekabupaten,
                'namakabupaten' => $namakabupaten,
            );
            $simpan = $this->kabupaten->simpanData($data);
        } else {
            $data = array(
                'kodekabupaten' => $kodekabupaten,
                'namakabupaten' => $namakabupaten,
            );
            $simpan = $this->kabupaten->updateData($data, $kodekabupaten);
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



    public function hapus($kodekabupaten)
    {
        $kodekabupaten = Crypt::decrypt($kodekabupaten);
        try {
            $rsKabupaten = Kabupaten::findOrFail($kodekabupaten);
        } catch (ModelNotFoundException $e) {
            return redirect('kabupaten')->with('other', 'Data tidak ditemukan!');
        }

        $hapus = $this->kabupaten->hapusData($kodekabupaten, $rsKabupaten);
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
        $kodekabupaten = $request->input('kodekabupaten');
        $rsKabupaten = Kabupaten::find($kodekabupaten);
        return response()->json($rsKabupaten);
    }
}
