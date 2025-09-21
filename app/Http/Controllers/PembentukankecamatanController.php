<?php

namespace App\Http\Controllers;

use App\Models\Pembentukankecamatan;
use App\Models\Kelurahan;
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
        if (session('akseslevel') != 'Operator Kabupaten') {
            return redirect('pembentukankecamatan')->with('other', 'Hanya Operator Kabupaten yang dapat mengakses!');            
        }
        $data['stepNumber'] = App::getStepNumber();
        $data['nopengajuan'] = '';
        $data['menu'] = 'pembentukankecamatan';
        $data['ltambah'] = true;
        return view('pembentukankecamatan.form', $data);
    }

    public function progress($nopengajuan)
    {
        try {
            $nopengajuan = Crypt::decrypt($nopengajuan);
            $rsPembentukanKecamatan = Pembentukankecamatan::findOrFail($nopengajuan);
        } catch (ModelNotFoundException $e) {
            return redirect('pembentukankecamatan')->with('other', 'Data tidak ditemukan!');
        }

        $data['stepNumber'] = App::getStepNumber($rsPembentukanKecamatan->idstatuspengajuanterakhir);
        $data['menu'] = 'pembentukankecamatan';
        $data['nopengajuan'] = $nopengajuan;
        $data['ltambah'] = false;
        return view('pembentukankecamatan.form', $data);
    }

    public function listindex(Request $request)
    {
        // Query dasar
        $query = Pembentukankecamatan::select("*");

        if (session('akseslevel') == 'Operator Kabupaten') {
            $query->where('kodekabupaten', session('kodekabupaten'));
        }

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
                $query->orderBy('nopengajuan', 'Desc');
            }
        } else {
            $query->orderBy('nopengajuan', 'Desc');
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


            $button = '
                    <a href="#" class="dropdown-item btn-detail-pengajuan" data-nopengajuan="'  . $row->nopengajuan . '">Lihat Detail Pengajuan</a>
                ';                

            if ($row->idstatuspengajuanterakhir == '001') {
                $button .= '
                    <a href="' . url('pembentukankecamatan/hapus/' . Crypt::encrypt($row->nopengajuan)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                ';                
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
                                    ' . $button . '
                                    </div>
                                </div>
                                <a href="' . url('pembentukankecamatan/progress/' . Crypt::encrypt($row->nopengajuan)) . '" class="btn btn-warning">Progress</a>                                
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

    public function simpanPengajuan(Request $request)
    {
        $nopengajuan = $request->get('nopengajuan');
        $tglpengajuan = $request->get('tglpengajuan');
        $namakecamatanbaru = $request->get('namakecamatanbaru');
        $kodekecamatan = $request->get('kodekecamatan');
        $kodekelurahan = $request->get('kodekelurahan');        
        $jumlahpenduduk = $request->get('jumlahpenduduk');     
        $jumlahkk = $request->get('jumlahkk');     
        $luaswilayah = $request->get('luaswilayah');     
        $jumlahkelurahan = $request->get('jumlahkelurahan');     
        $idstatuspengajuan = '001';
        

        //file surat pengantar
        $filesuratpengantar = $request->file('filesuratpengantar');
        $filesuratpengantar_lama = $request->get('filesuratpengantar_lama');
        $uploads = Uploads::startUpload('uploads/pengajuan', $filesuratpengantar, $filesuratpengantar_lama, 1000);
        if ($uploads['status'] == 'success') {
            $filesuratpengantar = $uploads['file_name'];
        } else {
            return response()->json([
                'message' => 'File surat pengantar gagal disimpan! Error: ' . $uploads['message']
            ]);
        }

        //file persyaratan dasar
        $filepersyaratandasar = $request->file('filepersyaratandasar');
        $filepersyaratandasar_lama = $request->get('filepersyaratandasar_lama');
        $uploads = Uploads::startUpload('uploads/pengajuan', $filepersyaratandasar, $filepersyaratandasar_lama, 1000);
        if ($uploads['status'] == 'success') {
            $filepersyaratandasar = $uploads['file_name'];
        } else {
            return response()->json([
                'message' => 'File persyaratan dasar gagal disimpan! Error: ' . $uploads['message']
            ]);
        }

        //file surat kesepakatan
        $filesuratkesepakatan = $request->file('filesuratkesepakatan');
        $filesuratkesepakatan_lama = $request->get('filesuratkesepakatan_lama');
        $uploads = Uploads::startUpload('uploads/pengajuan', $filesuratkesepakatan, $filesuratkesepakatan_lama, 1000);
        if ($uploads['status'] == 'success') {
            $filesuratkesepakatan = $uploads['file_name'];
        } else {
            return response()->json([
                'message' => 'File surat kesepakatan gagal disimpan! Error: ' . $uploads['message']
            ]);
        }


        //file kemampuan keuangan
        $kemampuankeuangan = $request->file('kemampuankeuangan');
        $kemampuankeuangan_lama = $request->get('kemampuankeuangan_lama');
        $uploads = Uploads::startUpload('uploads/pengajuan', $kemampuankeuangan, $kemampuankeuangan_lama, 1000);
        if ($uploads['status'] == 'success') {
            $kemampuankeuangan = $uploads['file_name'];
        } else {
            return response()->json([
                'message' => 'File kemampuan keuangan gagal disimpan! Error: ' . $uploads['message']
            ]);
        }

        //file sarana prasarana
        $saranaprasarana = $request->file('saranaprasarana');
        $saranaprasarana_lama = $request->get('saranaprasarana_lama');
        $uploads = Uploads::startUpload('uploads/pengajuan', $saranaprasarana, $saranaprasarana_lama, 1000);
        if ($uploads['status'] == 'success') {
            $saranaprasarana = $uploads['file_name'];
        } else {
            return response()->json([
                'message' => 'File sarana prasarana gagal disimpan! Error: ' . $uploads['message']
            ]);
        }

        //file batas wilayah
        $bataswilayah = $request->file('bataswilayah');
        $bataswilayah_lama = $request->get('bataswilayah_lama');
        $uploads = Uploads::startUpload('uploads/pengajuan', $bataswilayah, $bataswilayah_lama, 1000);
        if ($uploads['status'] == 'success') {
            $bataswilayah = $uploads['file_name'];
        } else {
            return response()->json([
                'message' => 'File batas wilayah gagal disimpan! Error: ' . $uploads['message']
            ]);
        }

        //file calon ibukota
        $lokasicalonibukota = $request->file('lokasicalonibukota');
        $lokasicalonibukota_lama = $request->get('lokasicalonibukota_lama');
        $uploads = Uploads::startUpload('uploads/pengajuan', $lokasicalonibukota, $lokasicalonibukota_lama, 1000);
        if ($uploads['status'] == 'success') {
            $lokasicalonibukota = $uploads['file_name'];
        } else {
            return response()->json([
                'message' => 'File lokasi calon ibukota gagal disimpan! Error: ' . $uploads['message']
            ]);
        }


        //file calon ibukota
        $kesesuaiantataruang = $request->file('kesesuaiantataruang');
        $kesesuaiantataruang_lama = $request->get('kesesuaiantataruang_lama');
        $uploads = Uploads::startUpload('uploads/pengajuan', $kesesuaiantataruang, $kesesuaiantataruang_lama, 1000);
        if ($uploads['status'] == 'success') {
            $kesesuaiantataruang = $uploads['file_name'];
        } else {
            return response()->json([
                'message' => 'File kesesuaian tata ruang gagal disimpan! Error: ' . $uploads['message']
            ]);
        }


        //perbup tentang tentang batas wilayah
        $perbupbataswilayah = $request->file('perbupbataswilayah');
        $perbupbataswilayah_lama = $request->get('perbupbataswilayah_lama');
        $uploads = Uploads::startUpload('uploads/pengajuan', $perbupbataswilayah, $perbupbataswilayah_lama, 1000);
        if ($uploads['status'] == 'success') {
            $perbupbataswilayah = $uploads['file_name'];
        } else {
            return response()->json([
                'message' => 'File kesesuaian tata ruang gagal disimpan! Error: ' . $uploads['message']
            ]);
        }

        $nopengajuan = $this->pembentukankecamatan->createID();

        $ltambah = $request->get('ltambah');
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');

        $data = array(
            'nopengajuan' => $nopengajuan,
            'tglpengajuan' => $tglpengajuan,
            'idpengguna' => session()->get('idpengguna'),
            'idstatuspengajuanterakhir' => $idstatuspengajuan,
            'kodekecamatan' => $kodekecamatan,
            'filesuratpengantar' => $filesuratpengantar,
            'inserted_date' => $inserted_date,
            'updated_date' => $updated_date,
        );


        // Persyaratan Dasar
        $namakabupaten = strtoupper(session('namakabupaten'));        
        if (strpos($namakabupaten, 'KOTA') !== false) {
            $jumlahpendudukminimal = session()->get('jumlah_penduduk_minimal_kota');
            $jumlahkkminimal = session()->get('jumlah_kk_kota');
            $luaswilayahminimal = session()->get('luas_wilayah_kota');
            $jumlahkelurahanminimal = session()->get('jumlah_kelurahan_desa_kota');
        }else{
            $jumlahpendudukminimal = session()->get('jumlah_penduduk_minimal_kabupaten');
            $jumlahkkminimal = session()->get('jumlah_kk_kabupaten');
            $luaswilayahminimal = session()->get('luas_wilayah_kabupaten');
            $jumlahkelurahanminimal = session()->get('jumlah_kelurahan_desa_kabupaten');
        }
        $persyaratanDasar = array(
            'nopengajuan' => $nopengajuan,
            'jumlahpenduduk' => $jumlahpenduduk,
            'jumlahpendudukminimal' => $jumlahpendudukminimal,
            'jumlahkk' => $jumlahkk,
            'jumlahkkminimal' => $jumlahkkminimal,
            'luaswilayah' => $luaswilayah,
            'luaswilayahminimal' => $luaswilayahminimal,
            'jumlahkelurahan' => $jumlahkelurahan,
            'jumlahkelurahanminimal' => $jumlahkelurahanminimal,
            'filepersyaratan' => $filepersyaratandasar,
        );

        // Persyaratan Administratif
        $persyaratanAdministratif = array(
            'nopengajuan' => $nopengajuan,
            'filesuratkesepakatan' => $filesuratkesepakatan,            
        );

        // Persyaratan Teknis
        $persyaratanTeknis = array(
            'nopengajuan' => $nopengajuan,
            'filekemampuankeuangan' => $kemampuankeuangan,
            'filesaranadanprasarana' => $saranaprasarana,
            'bataswilayah' => $bataswilayah,
            'lokasicalonibukota' => $lokasicalonibukota,
            'namakecamatan' => $namakecamatanbaru,
            'kesesuaiantataruang' => $kesesuaiantataruang,
            'perbupbataswilayah' => $perbupbataswilayah,
        );

        // return response()->json([
        //     'dataInput' =>$kodekelurahan,
        // ]);

        $dataKelurahan = [];
        foreach ($kodekelurahan as $value) {
            $dataKelurahan[] = array(
                'nopengajuan' => $nopengajuan,
                'kodekelurahan' => $value,
            );
        }

        $simpan = $this->pembentukankecamatan->simpanPengajuan($data, $persyaratanDasar, $persyaratanAdministratif, $persyaratanTeknis, $dataKelurahan);
        

        // dd(htmlspecialchars($simpan['message']));
        if ($simpan['status'] == 'success') {
            return response()->json([
                'success' => true,
                'nopengajuan' => Crypt::encrypt($nopengajuan)
            ]);
        } else {
            return response()->json([
                'message' => 'Data gagal disimpan! Error: ' . $simpan['message'],
            ]);
        }
    }



    public function simpanVerifikasiPropinsi(Request $request)
    {
        $nopengajuan = $request->get('nopengajuan');
        $tglverifikasipropinsi = $request->get('tglverifikasipropinsi');
        $statusverifikasipropinsi = $request->get('statusverifikasipropinsi');
        $deskripsirevisipropinsi = $request->get('deskripsirevisipropinsi');    
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');
        $idstatuspengajuan = '003';

        $rsPengajuan = Pembentukankecamatan::find($nopengajuan);

        if ($this->pembentukankecamatan->tanggalStatusInvalid($nopengajuan, $tglverifikasipropinsi)) {
            return response()->json([
                'message' => 'Tanggal verifikasi propinsi tidak boleh lebih kecil dari tanggal pengajuan!'
            ]);
        }


        if ($statusverifikasipropinsi == '1') {
            $idstatuspengajuanterakhir = $idstatuspengajuan;
            $idstatuspengajuannext = $this->pembentukankecamatan->createStatusPembentukan($idstatuspengajuan);
            $deskripsirevisipropinsi = null;
        }else{
            $idstatuspengajuanterakhir = null;
            $idstatuspengajuannext = '001';
        }


        $data = array(
            'nopengajuan' => $nopengajuan,
            'idstatuspengajuanterakhir' => $idstatuspengajuanterakhir,
            'tglverifikasipropinsi' => $tglverifikasipropinsi,
        );

        $idriwayat = $this->pembentukankecamatan->createIDRiwayat($nopengajuan);
        $riwayat = array(
                'idriwayat' => $idriwayat,
                'nopengajuan' => $nopengajuan,
                'idstatuspengajuan' => $idstatuspengajuan,
                'tglstatuspengajuan' => $tglverifikasipropinsi,
                'deskripsi' => $deskripsirevisipropinsi,
                'idstatuspengajuannext' => $idstatuspengajuannext,
                'statusapprove' => $statusverifikasipropinsi,
                'idpengguna' => session('idpengguna'),
                'inserted_date' => date('Y-m-d H:i:s'),
            );

        $simpan = $this->pembentukankecamatan->simpanVerifikasiPropinsi($data, $riwayat);        

        // dd(htmlspecialchars($simpan['message']));
        if ($simpan['status'] == 'success') {
            return response()->json([
                'success' => true,
                'nopengajuan' => Crypt::encrypt($nopengajuan)
            ]);
        } else {
            return response()->json([
                'message' => 'Data gagal disimpan! Error: ' . $simpan['message'],
            ]);
        }
    }


    public function simpanRaperda(Request $request)
    {
        $nopengajuan = $request->get('nopengajuan');
        $nomorraperda = $request->get('nomorraperda');
        $tglraperda = $request->get('tglraperda');
        
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');
        $idstatuspengajuan = '005';

        if ($this->pembentukankecamatan->tanggalStatusInvalid($nopengajuan, $tglraperda)) {
            return response()->json([
                'message' => 'Tanggal raperda tidak boleh lebih kecil dari tanggal verifikasi propinsi!'
            ]);
        }

        $idstatuspengajuanterakhir = $idstatuspengajuan;
        $idstatuspengajuannext = $this->pembentukankecamatan->createStatusPembentukan($idstatuspengajuan);

        //upload raperda
        $fileraperda = $request->file('fileraperda');
        $fileraperda_lama = $request->get('fileraperda_lama');
        $uploads = Uploads::startUpload('uploads/pengajuan', $fileraperda, $fileraperda_lama, 1000);
        if ($uploads['status'] == 'success') {
            $fileraperda = $uploads['file_name'];
        } else {
            return response()->json([
                'message' => 'File raperda gagal disimpan! Error: ' . $uploads['message']
            ]);
        }

        $data = array(
            'nopengajuan' => $nopengajuan,
            'idstatuspengajuanterakhir' => $idstatuspengajuanterakhir,
            'nomorraperda' => $nomorraperda,
            'tglraperda' => $tglraperda,
            'fileraperda' => $fileraperda,
        );

        $idriwayat = $this->pembentukankecamatan->createIDRiwayat($nopengajuan);
        $riwayat = array(
                'idriwayat' => $idriwayat,
                'nopengajuan' => $nopengajuan,
                'idstatuspengajuan' => $idstatuspengajuan,
                'tglstatuspengajuan' => $tglraperda,
                'deskripsi' => null,
                'idstatuspengajuannext' => $idstatuspengajuannext,
                'statusapprove' => '1',
                'idpengguna' => session('idpengguna'),
                'inserted_date' => date('Y-m-d H:i:s'),
            );

        $simpan = $this->pembentukankecamatan->simpanRaperda($data, $riwayat);        

        // dd(htmlspecialchars($simpan['message']));
        if ($simpan['status'] == 'success') {
            return response()->json([
                'success' => true,
                'nopengajuan' => Crypt::encrypt($nopengajuan)
            ]);
        } else {
            return response()->json([
                'message' => 'Data gagal disimpan! Error: ' . $simpan['message'],
            ]);
        }
    }


    public function simpanTelaahan(Request $request)
    {
        $nopengajuan = $request->get('nopengajuan');
        $nomorregister = $request->get('nomorregister');
        $tglregister = $request->get('tglregister');
        $statusraperda = $request->get('statusraperda');
        $deskripsirevisiraperda = $request->get('deskripsirevisiraperda');
        

        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');
        $idstatuspengajuan = '010';

        if ($this->pembentukankecamatan->tanggalStatusInvalid($nopengajuan, $tglregister)) {
            return response()->json([
                'message' => 'Tanggal raperda tidak boleh lebih kecil dari tanggal verifikasi propinsi!'
            ]);
        }

        
        
        if ($statusraperda == '1') {
            $idstatuspengajuanterakhir = $idstatuspengajuan;
            $idstatuspengajuannext = $this->pembentukankecamatan->createStatusPembentukan($idstatuspengajuan);
            $deskripsirevisiraperda = null;

            

        }else{
            $idstatuspengajuanterakhir = '003';
            $idstatuspengajuannext = '005';
            $nomorregister = null;
            $filetelaahanhukum = '';
            $filetelaahanteknis = '';        
        }

        //upload raperda
        $filetelaahanhukum = $request->file('filetelaahanhukum');
        $filetelaahanhukum_lama = $request->get('filetelaahanhukum_lama');
        $uploads = Uploads::startUpload('uploads/pengajuan', $filetelaahanhukum, $filetelaahanhukum_lama, 1000);
        if ($uploads['status'] == 'success') {
            $filetelaahanhukum = $uploads['file_name'];
        } else {
            return response()->json([
                'message' => 'File raperda gagal disimpan! Error: ' . $uploads['message']
            ]);
        }


        $filetelaahanteknis = $request->file('filetelaahanteknis');
        $filetelaahanteknis_lama = $request->get('filetelaahanteknis_lama');
        $uploads = Uploads::startUpload('uploads/pengajuan', $filetelaahanteknis, $filetelaahanteknis_lama, 1000);
        if ($uploads['status'] == 'success') {
            $filetelaahanteknis = $uploads['file_name'];
        } else {
            return response()->json([
                'message' => 'File raperda gagal disimpan! Error: ' . $uploads['message']
            ]);
        }


        $data = array(
            'nopengajuan' => $nopengajuan,
            'idstatuspengajuanterakhir' => $idstatuspengajuanterakhir,
            'nomorregister' => $nomorregister,
            'tglregister' => $tglregister,
            'filetelaahanhukum' => $filetelaahanhukum,
            'filetelaahanteknis' => $filetelaahanteknis,
        );

        $idriwayat = $this->pembentukankecamatan->createIDRiwayat($nopengajuan);
        $riwayat = array(
                'idriwayat' => $idriwayat,
                'nopengajuan' => $nopengajuan,
                'idstatuspengajuan' => $idstatuspengajuan,
                'tglstatuspengajuan' => $tglregister,
                'deskripsi' => $deskripsirevisiraperda,
                'idstatuspengajuannext' => $idstatuspengajuannext,
                'statusapprove' => $statusraperda,
                'idpengguna' => session('idpengguna'),
                'inserted_date' => date('Y-m-d H:i:s'),
            );

        $simpan = $this->pembentukankecamatan->simpanTelaahan($data, $riwayat);        

        // dd(htmlspecialchars($simpan['message']));
        if ($simpan['status'] == 'success') {
            return response()->json([
                'success' => true,
                'nopengajuan' => Crypt::encrypt($nopengajuan)
            ]);
        } else {
            return response()->json([
                'message' => 'Data gagal disimpan! Error: ' . $simpan['message'],
            ]);
        }
    }


    public function simpanPermohonanKode(Request $request)
    {
        $nopengajuan = $request->get('nopengajuan');
        $nopermohonankode = $request->get('nopermohonankode');
        $tglpermohonankode = $request->get('tglpermohonankode');
        
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');
        $idstatuspengajuan = '015';

        if ($this->pembentukankecamatan->tanggalStatusInvalid($nopengajuan, $tglpermohonankode)) {
            return response()->json([
                'message' => 'Tanggal permohonan kode tidak boleh lebih kecil dari tanggal telaahan!'
            ]);
        }

        $idstatuspengajuanterakhir = $idstatuspengajuan;
        $idstatuspengajuannext = $this->pembentukankecamatan->createStatusPembentukan($idstatuspengajuan);

        //upload raperda
        $filepermohonankode = $request->file('filepermohonankode');
        $filepermohonankode_lama = $request->get('filepermohonankode_lama');
        $uploads = Uploads::startUpload('uploads/pengajuan', $filepermohonankode, $filepermohonankode_lama, 1000);
        if ($uploads['status'] == 'success') {
            $filepermohonankode = $uploads['file_name'];
        } else {
            return response()->json([
                'message' => 'File permohonan kode gagal disimpan! Error: ' . $uploads['message']
            ]);
        }

        $data = array(
            'nopengajuan' => $nopengajuan,
            'idstatuspengajuanterakhir' => $idstatuspengajuanterakhir,
            'nopermohonankode' => $nopermohonankode,
            'tglpermohonankode' => $tglpermohonankode,
            'filepermohonankode' => $filepermohonankode,
        );

        $idriwayat = $this->pembentukankecamatan->createIDRiwayat($nopengajuan);
        $riwayat = array(
                'idriwayat' => $idriwayat,
                'nopengajuan' => $nopengajuan,
                'idstatuspengajuan' => $idstatuspengajuan,
                'tglstatuspengajuan' => $tglpermohonankode,
                'deskripsi' => null,
                'idstatuspengajuannext' => $idstatuspengajuannext,
                'statusapprove' => '1',
                'idpengguna' => session('idpengguna'),
                'inserted_date' => date('Y-m-d H:i:s'),
            );

        $simpan = $this->pembentukankecamatan->simpanPermohonanKode($data, $riwayat);        

        // dd(htmlspecialchars($simpan['message']));
        if ($simpan['status'] == 'success') {
            return response()->json([
                'success' => true,
                'nopengajuan' => Crypt::encrypt($nopengajuan)
            ]);
        } else {
            return response()->json([
                'message' => 'Data gagal disimpan! Error: ' . $simpan['message'],
            ]);
        }
    }


    public function simpanRekomendasiGubernur(Request $request)
    {
        $nopengajuan = $request->get('nopengajuan');
        $norekomendasigubernur = $request->get('norekomendasigubernur');
        $tglrekomendasigubernur = $request->get('tglrekomendasigubernur');
        $statuspermohonankode = $request->get('statuspermohonankode');
        $deskripsirevisipermohonankode = $request->get('deskripsirevisipermohonankode');
        

        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');
        $idstatuspengajuan = '020';

        if ($this->pembentukankecamatan->tanggalStatusInvalid($nopengajuan, $tglrekomendasigubernur)) {
            return response()->json([
                'message' => 'Tanggal rekomendasi gubernur tidak boleh lebih kecil dari tanggal permohonan kode!'
            ]);
        }

        
        
        if ($statuspermohonankode == '1') {
            $idstatuspengajuanterakhir = $idstatuspengajuan;
            $idstatuspengajuannext = $this->pembentukankecamatan->createStatusPembentukan($idstatuspengajuan);
            $deskripsirevisipermohonankode = null;

            //upload raperda
            $filerekomendasigubernur = $request->file('filerekomendasigubernur');
            $filerekomendasigubernur_lama = $request->get('filerekomendasigubernur_lama');
            $uploads = Uploads::startUpload('uploads/pengajuan', $filerekomendasigubernur, $filerekomendasigubernur_lama, 1000);
            if ($uploads['status'] == 'success') {
                $filerekomendasigubernur = $uploads['file_name'];
            } else {
                return response()->json([
                    'message' => 'File raperda gagal disimpan! Error: ' . $uploads['message']
                ]);
            }
    
        }else{
            $idstatuspengajuanterakhir = '010';
            $idstatuspengajuannext = '015';
            $norekomendasigubernur = null;
            $filerekomendasigubernur = '';    
        }


        $data = array(
            'nopengajuan' => $nopengajuan,
            'idstatuspengajuanterakhir' => $idstatuspengajuanterakhir,
            'norekomendasigubernur' => $norekomendasigubernur,
            'tglrekomendasigubernur' => $tglrekomendasigubernur,
            'filerekomendasigubernur' => $filerekomendasigubernur,
        );

        $idriwayat = $this->pembentukankecamatan->createIDRiwayat($nopengajuan);
        $riwayat = array(
                'idriwayat' => $idriwayat,
                'nopengajuan' => $nopengajuan,
                'idstatuspengajuan' => $idstatuspengajuan,
                'tglstatuspengajuan' => $tglrekomendasigubernur,
                'deskripsi' => $deskripsirevisipermohonankode,
                'idstatuspengajuannext' => $idstatuspengajuannext,
                'statusapprove' => $statuspermohonankode,
                'idpengguna' => session('idpengguna'),
                'inserted_date' => date('Y-m-d H:i:s'),
            );

        $simpan = $this->pembentukankecamatan->simpanRekomendasiGubernur($data, $riwayat);        

        // dd(htmlspecialchars($simpan['message']));
        if ($simpan['status'] == 'success') {
            return response()->json([
                'success' => true,
                'nopengajuan' => Crypt::encrypt($nopengajuan)
            ]);
        } else {
            return response()->json([
                'message' => 'Data gagal disimpan! Error: ' . $simpan['message'],
            ]);
        }
    }


    public function simpanKirimSuratKeKemendagri(Request $request)
    {
        $nopengajuan = $request->get('nopengajuan');
        $tglkirimsuratkekemendagri = $request->get('tglkirimsuratkekemendagri');
        
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');
        $idstatuspengajuan = '025';

        if ($this->pembentukankecamatan->tanggalStatusInvalid($nopengajuan, $tglkirimsuratkekemendagri)) {
            return response()->json([
                'message' => 'Tanggal kirim surat tidak boleh lebih kecil dari tanggal rekomendasi!'
            ]);
        }

        $idstatuspengajuanterakhir = $idstatuspengajuan;
        $idstatuspengajuannext = $this->pembentukankecamatan->createStatusPembentukan($idstatuspengajuan);

        $data = array(
            'nopengajuan' => $nopengajuan,
            'idstatuspengajuanterakhir' => $idstatuspengajuanterakhir,
            'tglkirimsuratkekemendagri' => $tglkirimsuratkekemendagri,
        );

        $idriwayat = $this->pembentukankecamatan->createIDRiwayat($nopengajuan);
        $riwayat = array(
                'idriwayat' => $idriwayat,
                'nopengajuan' => $nopengajuan,
                'idstatuspengajuan' => $idstatuspengajuan,
                'tglstatuspengajuan' => $tglkirimsuratkekemendagri,
                'deskripsi' => null,
                'idstatuspengajuannext' => $idstatuspengajuannext,
                'statusapprove' => '1',
                'idpengguna' => session('idpengguna'),
                'inserted_date' => date('Y-m-d H:i:s'),
            );

        $simpan = $this->pembentukankecamatan->simpanKirimSuratKeKemendagri($data, $riwayat);        

        // dd(htmlspecialchars($simpan['message']));
        if ($simpan['status'] == 'success') {
            return response()->json([
                'success' => true,
                'nopengajuan' => Crypt::encrypt($nopengajuan)
            ]);
        } else {
            return response()->json([
                'message' => 'Data gagal disimpan! Error: ' . $simpan['message'],
            ]);
        }
    }


    public function simpanSkKemendagri(Request $request)
    {
        $nopengajuan = $request->get('nopengajuan');
        $nomorskkemendagri = $request->get('nomorskkemendagri');
        $tglskkemendagri = $request->get('tglskkemendagri');

        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');
        $idstatuspengajuan = '030';

        if ($this->pembentukankecamatan->tanggalStatusInvalid($nopengajuan, $tglskkemendagri)) {
            return response()->json([
                'message' => 'Tanggal rekomendasi gubernur tidak boleh lebih kecil dari tanggal permohonan kode!'
            ]);
        }

        
        
        $idstatuspengajuanterakhir = $idstatuspengajuan;
        $idstatuspengajuannext = $this->pembentukankecamatan->createStatusPembentukan($idstatuspengajuan);

        //upload sk kemendagri
        $fileskkemendagri = $request->file('fileskkemendagri');
        $fileskkemendagri_lama = $request->get('fileskkemendagri_lama');
        $uploads = Uploads::startUpload('uploads/pengajuan', $fileskkemendagri, $fileskkemendagri_lama, 1000);
        if ($uploads['status'] == 'success') {
            $fileskkemendagri = $uploads['file_name'];
        } else {
            return response()->json([
                'message' => 'File sk kemendagri gagal disimpan! Error: ' . $uploads['message']
            ]);
        }
        
        $data = array(
            'nopengajuan' => $nopengajuan,
            'idstatuspengajuanterakhir' => $idstatuspengajuanterakhir,
            'nomorskkemendagri' => $nomorskkemendagri,
            'tglskkemendagri' => $tglskkemendagri,
            'fileskkemendagri' => $fileskkemendagri,
        );

        $idriwayat = $this->pembentukankecamatan->createIDRiwayat($nopengajuan);
        $riwayat = array(
                'idriwayat' => $idriwayat,
                'nopengajuan' => $nopengajuan,
                'idstatuspengajuan' => $idstatuspengajuan,
                'tglstatuspengajuan' => $tglskkemendagri,
                'deskripsi' => null,
                'idstatuspengajuannext' => $idstatuspengajuannext,
                'statusapprove' => '1',
                'idpengguna' => session('idpengguna'),
                'inserted_date' => date('Y-m-d H:i:s'),
            );

        $simpan = $this->pembentukankecamatan->simpanRekomendasiGubernur($data, $riwayat);        

        // dd(htmlspecialchars($simpan['message']));
        if ($simpan['status'] == 'success') {
            return response()->json([
                'success' => true,
                'nopengajuan' => Crypt::encrypt($nopengajuan)
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

        //untuk hapus file di dari hosting
        $rsPembentukanPersyaratanDasar = $this->pembentukankecamatan->getPersyaratanDasar($nopengajuan);
        $rsPembentukanPersyaratanAdministratif = $this->pembentukankecamatan->getPersyaratanAdministratif($nopengajuan);
        $rsPembentukanPersyaratanTeknis = $this->pembentukankecamatan->getPersyaratanTeknis($nopengajuan);

        $hapus = $this->pembentukankecamatan->hapusData($nopengajuan, $rsPembentukanKecamatan);
        if ($hapus['status'] == 'success') {

            if (!empty($rsPembentukanKecamatan->filesuratpengantar)) {
                Uploads::hapusFile('uploads/pengajuan', $rsPembentukanKecamatan->filesuratpengantar);
            }

            foreach ($rsPembentukanPersyaratanDasar as $row) {
                if (!empty($row->filepersyaratan)) {
                    Uploads::hapusFile('uploads/pengajuan', $row->filepersyaratan);                                    
                }
            }

            foreach ($rsPembentukanPersyaratanAdministratif as $row) {
                if (!empty($row->filesuratkesepakatan)) {
                    Uploads::hapusFile('uploads/pengajuan', $row->filesuratkesepakatan);                                    
                }
            }

            foreach ($rsPembentukanPersyaratanTeknis as $row) {
                if (!empty($row->filekemampuankeuangan)) {
                    Uploads::hapusFile('uploads/pengajuan', $row->filekemampuankeuangan);                                    
                }
                if (!empty($row->filesaranadanprasarana)) {
                    Uploads::hapusFile('uploads/pengajuan', $row->filesaranadanprasarana);                                    
                }
                if (!empty($row->bataswilayah)) {
                    Uploads::hapusFile('uploads/pengajuan', $row->bataswilayah);
                }
                if (!empty($row->lokasicalonibukota)) {
                    Uploads::hapusFile('uploads/pengajuan', $row->lokasicalonibukota);
                }
                if (!empty($row->kesesuaiantataruang)) {
                    Uploads::hapusFile('uploads/pengajuan', $row->kesesuaiantataruang);
                }
                if (!empty($row->perbupbataswilayah)) {
                    Uploads::hapusFile('uploads/pengajuan', $row->perbupbataswilayah);
                }
            }

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


    public function getKelurahan(Request $request)
    {
        $kodekecamatan = $request->input('kodekecamatan');
        $rsKelurahan = Kelurahan::where('kodekecamatan', $kodekecamatan)->get();
        return response()->json($rsKelurahan);
    }

    public function getPengajuanPembentukan(Request $request)
    {
        $nopengajuan = $request->input('nopengajuan');
        $rsPembentukanKecamatan = Pembentukankecamatan::find($nopengajuan);
        $rsDesaTerpilih = $this->pembentukankecamatan->getDesaTerpilih($nopengajuan);
        $rsPersyaratanDasar = $this->pembentukankecamatan->getPersyaratanDasar($nopengajuan);
        $rsPersyaratanAdministratif = $this->pembentukankecamatan->getPersyaratanAdministratif($nopengajuan);
        $rsPersyaratanTeknis = $this->pembentukankecamatan->getPersyaratanTeknis($nopengajuan);

        return response()->json(array('rsPembentukanKecamatan' => $rsPembentukanKecamatan, 'rsDesaTerpilih' => $rsDesaTerpilih, 'rsPersyaratanDasar' => $rsPersyaratanDasar, 'rsPersyaratanAdministratif' => $rsPersyaratanAdministratif, 'rsPersyaratanTeknis' => $rsPersyaratanTeknis));
    }
}
