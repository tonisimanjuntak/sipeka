<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\App;
use App\Models\Uploads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class KelurahanController extends Controller
{
    var $kabupaten;
    var $kecamatan;
    var $kelurahan;

    public function __construct()
    {
        $this->kabupaten = new Kabupaten;
        $this->kecamatan = new Kecamatan;
        $this->kelurahan = new Kelurahan;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'kelurahan';
        return view('kelurahan.index', $data);
    }

    public function tambah()
    {
        $data['kodekelurahan'] = '';
        $data['menu'] = 'kelurahan';
        $data['ltambah'] = true;
        return view('kelurahan.form', $data);
    }

    public function edit($kodekelurahan)
    {
        try {
            $kodekelurahan = Crypt::decrypt($kodekelurahan);
            $rsKelurahan = Kelurahan::findOrFail($kodekelurahan);
        } catch (ModelNotFoundException $e) {
            return redirect('kelurahan')->with('other', 'Data tidak ditemukan!');
        }
        $data['menu'] = 'kelurahan';
        $data['kodekelurahan'] = $kodekelurahan;
        $data['ltambah'] = false;
        return view('kelurahan.form', $data);
    }

    public function listindex(Request $request)
    {
        // Query dasar
        $query = Kelurahan::select("*");

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where('kodekelurahan', 'LIKE', "%{$search}%")
                ->orWhere('namakelurahan', 'LIKE', "%{$search}%")
                ->orWhere('namakecamatan', 'LIKE', "%{$search}%")
                ->orWhere('namakabupaten', 'LIKE', "%{$search}%");
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'kodekelurahan', 'namakelurahan', null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('kodekelurahan', 'Asc');
            }
        } else {
            $query->orderBy('kodekelurahan', 'Asc');
        }


        // Hitung total data tanpa filter
        $totalData = Kelurahan::count();

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
                'kodekelurahan' => $row->kodekelurahan,
                'namakelurahan' => $row->namakelurahan.'<br><small>Kec. '.$row->namakecamatan . ', ' . $row->namakabupaten.'</small>',
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('kelurahan/hapus/' . Crypt::encrypt($row->kodekelurahan)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('kelurahan/edit/' . Crypt::encrypt($row->kodekelurahan)) . '" class="btn btn-warning">Edit</a>                                
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
        $kodekelurahan = $request->get('kodekelurahan');
        $namakelurahan = $request->get('namakelurahan');
        $tglberdiri = $request->get('tglberdiri');
        $ltambah = $request->get('ltambah');
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');

        if ($ltambah) {
            $data = array(
                'kodekecamatan' => $kodekecamatan,
                'kodekelurahan' => $kodekelurahan,
                'namakelurahan' => $namakelurahan,
            );
            $simpan = $this->kelurahan->simpanData($data);
        } else {
            $data = array(
                'kodekecamatan' => $kodekecamatan,
                'kodekelurahan' => $kodekelurahan,
                'namakelurahan' => $namakelurahan,
            );
            $simpan = $this->kelurahan->updateData($data, $kodekelurahan);
        }

        // dd(htmlspecialchars($simpan['message']));
        if ($simpan['status'] == 'success') {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['message' => 'Data gagal disimpan! Error: ' . $simpan['message']]);
        }
    }



    public function hapus($kodekelurahan)
    {
        $kodekelurahan = Crypt::decrypt($kodekelurahan);
        try {
            $rsKelurahan = Kelurahan::findOrFail($kodekelurahan);
        } catch (ModelNotFoundException $e) {
            return redirect('kelurahan')->with('other', 'Data tidak ditemukan!');
        }

        $hapus = $this->kelurahan->hapusData($kodekelurahan, $rsKelurahan);
        if ($hapus['status'] == 'success') {
            return response()->json([
                'success' => true
            ]);
            
        } else {
            return response()->json([
                'message' => 'Data gagal dihapus! Error: ' . $hapus['message']
            ]);
        }
    }

    public function getId(Request $request)
    {
        $kodekelurahan = $request->input('kodekelurahan');
        $rsKelurahan = Kelurahan::find($kodekelurahan);
        return response()->json($rsKelurahan);
    }
}
