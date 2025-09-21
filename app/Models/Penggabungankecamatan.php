<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class Penggabungankecamatan extends Model
{
    use HasFactory;

    protected $table = 'v_penggabungankecamatan';
    protected $primaryKey = 'nopengajuan';
    protected $keyType = 'char';

    public $timestamps = false; // Menonaktifkan timestamps
    public $incrementing = false;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = [];
    protected $hidden = [];
    var $App;

    public function __construct()
    {
        $this->App = new App;
    }

    public function simpanPengajuan($data, $persyaratanDasar, $persyaratanAdministratif, $persyaratanTeknis, $dataKelurahan)
    {

        try {
            DB::beginTransaction();
            DB::table('penggabungankecamatan')
                ->insert($data);

            DB::table('pembentukanpersyaratandasar')
                ->insert($persyaratanDasar);

            DB::table('pembentukanpersyaratanadministratif')
                ->insert($persyaratanAdministratif);

            DB::table('pembentukanpersyaratanteknis')
                ->insert($persyaratanTeknis);

            DB::table('pembentukankelurahanterpilih')
                ->insert($dataKelurahan);

            // Buat ID status berikutnya
            $idstatuspengajuannext = $this->createStatusPembentukan($data['idstatuspengajuanterakhir']);
            if (!$idstatuspengajuannext) {
                throw new \Exception("Gagal generate ID status selanjutnya.");
            }

            // Buat ID riwayat — PERBAIKAN: gunakan $data['nopengajuan']
            $idriwayat = $this->createIDRiwayat($data['nopengajuan']);
            if (!$idriwayat) {
                throw new \Exception("Gagal generate ID riwayat.");
            }


            $riwayat = array(
                'idriwayat' => $idriwayat,
                'nopengajuan' => $data['nopengajuan'],
                'idstatuspengajuan' => $data['idstatuspengajuanterakhir'],
                'tglstatuspengajuan' => $data['tglpengajuan'],
                'deskripsi' => '',
                'idstatuspengajuannext' => $idstatuspengajuannext,
                'statusapprove' => '1',
                'idpengguna' => session('idpengguna'),
                'inserted_date' => date('Y-m-d H:i:s'),
            );
            DB::table('pembentukanriwayat')
                ->insert($riwayat);
                

            $this->App->riwayatAktifitas($data, 'penggabungankecamatan', 'simpanPengajuanPembentukan');
        
            DB::commit();
            return ['status' => 'success', 'message' => 'Data berhasil'];
        } catch (QueryException $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (xception $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }

    }


    public function simpanVerifikasiPropinsi($data, $riwayat)
    {

        try {
            DB::beginTransaction();

            DB::table('penggabungankecamatan')
                ->where('nopengajuan', $data['nopengajuan'])
                ->update($data);
            
            DB::table('pembentukanriwayat')
                ->insert($riwayat);
                

            $this->App->riwayatAktifitas($data, 'penggabungankecamatan', 'simpanVerifikasiPropinsi');
        
            DB::commit();
            return ['status' => 'success', 'message' => 'Data berhasil'];
        } catch (QueryException $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (xception $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }

    }

    public function simpanRaperda($data, $riwayat)
    {

        try {
            DB::beginTransaction();

            DB::table('penggabungankecamatan')
                ->where('nopengajuan', $data['nopengajuan'])
                ->update($data);
            
            DB::table('pembentukanriwayat')
                ->insert($riwayat);
                

            $this->App->riwayatAktifitas($data, 'penggabungankecamatan', 'simpanRaperda');
        
            DB::commit();
            return ['status' => 'success', 'message' => 'Data berhasil'];
        } catch (QueryException $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (xception $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }

    }


    public function simpanTelaahan($data, $riwayat)
    {

        try {
            DB::beginTransaction();

            DB::table('penggabungankecamatan')
                ->where('nopengajuan', $data['nopengajuan'])
                ->update($data);
            
            DB::table('pembentukanriwayat')
                ->insert($riwayat);
                

            $this->App->riwayatAktifitas($data, 'penggabungankecamatan', 'simpanTelaahan');
        
            DB::commit();
            return ['status' => 'success', 'message' => 'Data berhasil'];
        } catch (QueryException $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (xception $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }

    }


    public function simpanPermohonanKode($data, $riwayat)
    {

        try {
            DB::beginTransaction();

            DB::table('penggabungankecamatan')
                ->where('nopengajuan', $data['nopengajuan'])
                ->update($data);
            
            DB::table('pembentukanriwayat')
                ->insert($riwayat);
                

            $this->App->riwayatAktifitas($data, 'penggabungankecamatan', 'simpanPermohonanKode');
        
            DB::commit();
            return ['status' => 'success', 'message' => 'Data berhasil'];
        } catch (QueryException $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (xception $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }

    }

    public function simpanRekomendasiGubernur($data, $riwayat)
    {

        try {
            DB::beginTransaction();

            DB::table('penggabungankecamatan')
                ->where('nopengajuan', $data['nopengajuan'])
                ->update($data);
            
            DB::table('pembentukanriwayat')
                ->insert($riwayat);
                

            $this->App->riwayatAktifitas($data, 'penggabungankecamatan', 'simpanRekomendasiGubernur');
        
            DB::commit();
            return ['status' => 'success', 'message' => 'Data berhasil'];
        } catch (QueryException $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (xception $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }

    }

    public function simpanKirimSuratKeKemendagri($data, $riwayat)
    {

        try {
            DB::beginTransaction();

            DB::table('penggabungankecamatan')
                ->where('nopengajuan', $data['nopengajuan'])
                ->update($data);
            
            DB::table('pembentukanriwayat')
                ->insert($riwayat);
                

            $this->App->riwayatAktifitas($data, 'penggabungankecamatan', 'simpanKirimSuratKeKemendagri');
        
            DB::commit();
            return ['status' => 'success', 'message' => 'Data berhasil'];
        } catch (QueryException $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (xception $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }

    }

    public function hapusData($nopengajuan, $rspengajuan)
    {
        try {
            DB::beginTransaction();
            
            DB::table('pembentukanriwayat')
                ->where('nopengajuan', $nopengajuan)
                ->delete();

            DB::table('pembentukanpersyaratandasar')
                ->where('nopengajuan', $nopengajuan)
                ->delete();

            DB::table('pembentukanpersyaratanadministratif')
                ->where('nopengajuan', $nopengajuan)
                ->delete();

            DB::table('pembentukanpersyaratanteknis')
                ->where('nopengajuan', $nopengajuan)
                ->delete();

            DB::table('pembentukankelurahanterpilih')
                ->where('nopengajuan', $nopengajuan)
                ->delete();            

            DB::table('penggabungankecamatan')
                ->where('nopengajuan', $nopengajuan)
                ->delete();

            $this->App->riwayatAktifitas($rspengajuan, 'penggabungankecamatan', 'hapusPengajuanPembentukan');

            DB::commit();
            return ['status' => 'success', 'message' => "Data berhasil dihapus"];
        } catch (QueryException $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    

    public function createID()
    {
        return DB::select("SELECT create_nopengajuan_pembentukan() AS id")[0]->id;
    }

    public function createIDRiwayat($nopengajuan)
    {
        return DB::select("SELECT create_noriwayat_pembentukan('$nopengajuan') AS id")[0]->id;
    }

    public function createStatusPembentukan($idstatuspengajuan)
    {
        return DB::select("SELECT createStatusPembentukan('$idstatuspengajuan') AS id")[0]->id;        
    }

    public function getPersyaratanTeknis($nopengajuan)
    {
        return DB::table('pembentukanpersyaratanteknis')
            ->where('nopengajuan', $nopengajuan)
            ->get();
    }

    public function getPersyaratanAdministratif($nopengajuan)
    {
        return DB::table('pembentukanpersyaratanadministratif')
            ->where('nopengajuan', $nopengajuan)
            ->get();
    }

    public function getPersyaratanDasar($nopengajuan)
    {
        return DB::table('pembentukanpersyaratandasar')
            ->where('nopengajuan', $nopengajuan)
            ->get();
    }

    public function getDesaTerpilih($nopengajuan)
    {
        return DB::table('v_pembentukankelurahanterpilih')
            ->orderBy('kelurahanterpilihid', 'asc')
            ->where('nopengajuan', $nopengajuan)
            ->get();
    }

    public function tanggalStatusInvalid($nopengajuan, $tglverifikasipropinsi)
    {
        $rsPengajuan = DB::table('pembentukanriwayat')
            ->where('nopengajuan', $nopengajuan)
            ->orderBy('tglstatuspengajuan', 'desc')
            ->limit(1)
            ->get();

        if (count($rsPengajuan) > 0) {
            if ($rsPengajuan[0]->tglstatuspengajuan > $tglverifikasipropinsi) {
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}
