<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\App;
use App\Models\Uploads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class KecamatanController extends Controller
{
    var $kabupaten;
    var $kecamatan;

    public function __construct()
    {
        $this->kecamatan = new Kabupaten;
        $this->kecamatan = new Kecamatan;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'kecamatan';
        return view('kecamatan.index', $data);
    }

    public function tambah()
    {
        $data['kodekecamatan'] = '';
        $data['menu'] = 'kecamatan';
        $data['ltambah'] = true;
        return view('kecamatan.form', $data);
    }

    public function edit($kodekecamatan)
    {
        try {
            $kodekecamatan = Crypt::decrypt($kodekecamatan);
            $rsKecamatan = Kecamatan::findOrFail($kodekecamatan);
        } catch (ModelNotFoundException $e) {
            return redirect('kecamatan')->with('other', 'Data tidak ditemukan!');
        }
        $data['menu'] = 'kecamatan';
        $data['kodekecamatan'] = $kodekecamatan;
        $data['ltambah'] = false;
        return view('kecamatan.form', $data);
    }

    public function listindex(Request $request)
    {
        // Query dasar
        $query = Kecamatan::select("*");

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where('kodekecamatan', 'LIKE', "%{$search}%")
                ->orWhere('namakecamatan', 'LIKE', "%{$search}%")
                ->orWhere('namakabupaten', 'LIKE', "%{$search}%");
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'kodekecamatan', 'namakecamatan', null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('kodekecamatan', 'Asc');
            }
        } else {
            $query->orderBy('kodekecamatan', 'Asc');
        }


        // Hitung total data tanpa filter
        $totalData = Kecamatan::count();

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
                'kodekecamatan' => $row->kodekecamatan,
                'namakecamatan' => $row->namakecamatan.'<br><small>'.$row->namakabupaten.'</small>',
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('kecamatan/hapus/' . Crypt::encrypt($row->kodekecamatan)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('kecamatan/edit/' . Crypt::encrypt($row->kodekecamatan)) . '" class="btn btn-warning">Edit</a>                                
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
        $kodekecamatan = $request->get('kodekecamatan');
        $namakecamatan = $request->get('namakecamatan');
        $tglberdiri = $request->get('tglberdiri');
        $ltambah = $request->get('ltambah');
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');

        if ($ltambah) {
            $data = array(
                'kodekabupaten' => $kodekabupaten,
                'kodekecamatan' => $kodekecamatan,
                'namakecamatan' => $namakecamatan,
                'tglberdiri' => $tglberdiri,
            );
            $simpan = $this->kecamatan->simpanData($data);
        } else {
            $data = array(
                'kodekabupaten' => $kodekabupaten,
                'kodekecamatan' => $kodekecamatan,
                'namakecamatan' => $namakecamatan,
                'tglberdiri' => $tglberdiri,
            );
            $simpan = $this->kecamatan->updateData($data, $kodekecamatan);
        }

        // dd(htmlspecialchars($simpan['message']));
        if ($simpan['status'] == 'success') {
            return redirect('kecamatan')->with('success', $simpan['message']);
        } else {
            return redirect('kecamatan')->with('fail', 'Data gagal disimpan! Error: ' . $simpan['message']);
        }
    }



    public function hapus($kodekecamatan)
    {
        $kodekecamatan = Crypt::decrypt($kodekecamatan);
        try {
            $rsKecamatan = Kecamatan::findOrFail($kodekecamatan);
        } catch (ModelNotFoundException $e) {
            return redirect('kecamatan')->with('other', 'Data tidak ditemukan!');
        }

        $hapus = $this->kecamatan->hapusData($kodekecamatan, $rsKecamatan);
        if ($hapus['status'] == 'success') {
            return redirect('kecamatan')->with('success', $hapus['message']);
        } else {
            return redirect('kecamatan')->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }

    public function getId(Request $request)
    {
        $kodekecamatan = $request->input('kodekecamatan');
        $rsKecamatan = Kecamatan::find($kodekecamatan);
        return response()->json($rsKecamatan);
    }
}
