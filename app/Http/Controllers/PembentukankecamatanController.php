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
        $data['rsPersyaratanDasar'] = $this->pembentukankecamatan->getPersyaratanDasar();
        $data['rsPersyaratanAdministratif'] = $this->pembentukankecamatan->getPersyaratanAdministratif();
        $data['rsPersyaratanTeknis'] = $this->pembentukankecamatan->getPersyaratanTeknis();
        $data['nopengajuan'] = '';
        $data['menu'] = 'pembentukankecamatan';
        $data['ltambah'] = true;
        return view('pembentukankecamatan.form', $data);
    }

    public function edit($nopengajuan)
    {
        try {
            $nopengajuan = Crypt::decrypt($nopengajuan);
            $rsPembentukanKecamatan = Pembentukankecamatan::findOrFail($nopengajuan);
        } catch (ModelNotFoundException $e) {
            return redirect('pembentukankecamatan')->with('other', 'Data tidak ditemukan!');
        }
        $data['menu'] = 'pembentukankecamatan';
        $data['nopengajuan'] = $nopengajuan;
        $data['ltambah'] = false;
        return view('pembentukankecamatan.form', $data);
    }

    public function listindex(Request $request)
    {
        // Query dasar
        $query = Pembentukankecamatan::select("*");

        if ($request->has('statusFilter') && $request->input('statusFilter') != 'Semua') {
            $status = $request->input('statusFilter');
            if ($status == 'Onprogress') {
                $query->where('idstatuspengajuanterakhir', '!=', '999');                
            }else{
                $query->where('idstatuspengajuanterakhir', '999');                
            }
        }

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where('nopengajuan', 'LIKE', "%{$search}%")
                ->orWhere('namakabupaten', 'LIKE', "%{$search}%")
                ->orWhere('namakecamatan', 'LIKE', "%{$search}%")
                ->orWhere('namalengkap', 'LIKE', "%{$search}%");
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'nopengajuan', 'namakabupaten', 'namakecamatan', 'namastatuspengajuannext', null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('nopengajuan', 'Asc');
            }
        } else {
            $query->orderBy('nopengajuan', 'Asc');
        }


        // Hitung total data tanpa filter
        $totalData = Pembentukankecamatan::count();

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

            if ($row->idstatuspengajuanterakhir == '999') {
                $statuspengajuan = '<span class="badge badge-success">Selesai</span>';
            } else {
                $statuspengajuan = '<span class="badge badge-danger">' . $row->namastatuspengajuannext . '</span>';
            }

            $data[] = [
                'no' => $no++,
                'nopengajuan' => $row->nopengajuan,
                'namakabupaten' => $row->namakabupaten,
                'namakecamatan' => $row->namakecamatan,
                'statuspengajuan' => $statuspengajuan,
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('pembentukankecamatan/hapus/' . Crypt::encrypt($row->nopengajuan)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('pembentukankecamatan/edit/' . Crypt::encrypt($row->nopengajuan)) . '" class="btn btn-warning">Edit</a>                                
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
        $nopengajuan = $request->get('nopengajuan');
        $tglpengajuan = $request->get('tglpengajuan');
        $statusaktif = $request->get('statusaktif');
        $ltambah = $request->get('ltambah');
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');

        if ($ltambah) {
            $data = array(
                'nopengajuan' => $nopengajuan,
                'tglpengajuan' => $tglpengajuan,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'statusaktif' => $statusaktif,
                'idpengguna' => session()->get('idpengguna'),
            );
            $simpan = $this->pembentukankecamatan->simpanData($data);
        } else {
            $data = array(
                'nopengajuan' => $nopengajuan,
                'tglpengajuan' => $tglpengajuan,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'statusaktif' => $statusaktif,
                'idpengguna' => session()->get('idpengguna'),
            );
            $simpan = $this->pembentukankecamatan->updateData($data, $nopengajuan);
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



    public function hapus($nopengajuan)
    {
        $nopengajuan = Crypt::decrypt($nopengajuan);
        try {
            $rsPembentukanKecamatan = Pembentukankecamatan::findOrFail($nopengajuan);
        } catch (ModelNotFoundException $e) {
            return redirect('pembentukankecamatan')->with('other', 'Data tidak ditemukan!');
        }

        $hapus = $this->pembentukankecamatan->hapusData($nopengajuan, $rsPembentukanKecamatan);
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
        $nopengajuan = $request->input('nopengajuan');
        $rsPembentukanKecamatan = Pembentukankecamatan::find($nopengajuan);
        return response()->json($rsPembentukanKecamatan);
    }
}
