<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class Penataan extends Model
{
    use HasFactory;

    protected $table = 'v_penataan';
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
            DB::table('penataan')
                ->insert($data);

            DB::table('penataanpersyaratandasar')
                ->insert($persyaratanDasar);

            DB::table('penataanpersyaratanadministratif')
                ->insert($persyaratanAdministratif);

            DB::table('penataanpersyaratanteknis')
                ->insert($persyaratanTeknis);

            DB::table('penataankelurahanterpilih')
                ->insert($dataKelurahan);

            // Buat ID status berikutnya
            $idstatuspengajuannext = $this->createStatusPenataan($data['idstatuspengajuanterakhir']);
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
            DB::table('penataanriwayat')
                ->insert($riwayat);
                

            $this->App->riwayatAktifitas($data, 'penataan', 'simpanPengajuanPenataan');
        
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

            DB::table('penataan')
                ->where('nopengajuan', $data['nopengajuan'])
                ->update($data);
            
            DB::table('penataanriwayat')
                ->insert($riwayat);
                

            $this->App->riwayatAktifitas($data, 'penataan', 'simpanVerifikasiPropinsi');
        
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

            DB::table('penataan')
                ->where('nopengajuan', $data['nopengajuan'])
                ->update($data);
            
            DB::table('penataanriwayat')
                ->insert($riwayat);
                

            $this->App->riwayatAktifitas($data, 'penataan', 'simpanRaperda');
        
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

            DB::table('penataan')
                ->where('nopengajuan', $data['nopengajuan'])
                ->update($data);
            
            DB::table('penataanriwayat')
                ->insert($riwayat);
                

            $this->App->riwayatAktifitas($data, 'penataan', 'simpanTelaahan');
        
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

            DB::table('penataan')
                ->where('nopengajuan', $data['nopengajuan'])
                ->update($data);
            
            DB::table('penataanriwayat')
                ->insert($riwayat);
                

            $this->App->riwayatAktifitas($data, 'penataan', 'simpanPermohonanKode');
        
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

            DB::table('penataan')
                ->where('nopengajuan', $data['nopengajuan'])
                ->update($data);
            
            DB::table('penataanriwayat')
                ->insert($riwayat);
                

            $this->App->riwayatAktifitas($data, 'penataan', 'simpanRekomendasiGubernur');
        
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

            DB::table('penataan')
                ->where('nopengajuan', $data['nopengajuan'])
                ->update($data);
            
            DB::table('penataanriwayat')
                ->insert($riwayat);
                

            $this->App->riwayatAktifitas($data, 'penataan', 'simpanKirimSuratKeKemendagri');
        
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
            
            DB::table('penataanriwayat')
                ->where('nopengajuan', $nopengajuan)
                ->delete();

            DB::table('penataanpersyaratandasar')
                ->where('nopengajuan', $nopengajuan)
                ->delete();

            DB::table('penataanpersyaratanadministratif')
                ->where('nopengajuan', $nopengajuan)
                ->delete();

            DB::table('penataanpersyaratanteknis')
                ->where('nopengajuan', $nopengajuan)
                ->delete();

            DB::table('penataankelurahanterpilih')
                ->where('nopengajuan', $nopengajuan)
                ->delete();            

            DB::table('penataan')
                ->where('nopengajuan', $nopengajuan)
                ->delete();

            $this->App->riwayatAktifitas($rspengajuan, 'penataan', 'hapusPengajuanPenataan');

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
        return DB::select("SELECT create_nopengajuan_penataan() AS id")[0]->id;
    }

    public function createIDRiwayat($nopengajuan)
    {
        return DB::select("SELECT create_noriwayat_penataan('$nopengajuan') AS id")[0]->id;
    }

    public function createStatusPenataan($idstatuspengajuan)
    {
        return DB::select("SELECT createStatusPenataan('$idstatuspengajuan') AS id")[0]->id;        
    }

    public function getPersyaratanTeknis($nopengajuan)
    {
        return DB::table('penataanpersyaratanteknis')
            ->where('nopengajuan', $nopengajuan)
            ->get();
    }

    public function getPersyaratanAdministratif($nopengajuan)
    {
        return DB::table('penataanpersyaratanadministratif')
            ->where('nopengajuan', $nopengajuan)
            ->get();
    }

    public function getPersyaratanDasar($nopengajuan)
    {
        return DB::table('penataanpersyaratandasar')
            ->where('nopengajuan', $nopengajuan)
            ->get();
    }

    public function getDesaTerpilih($nopengajuan)
    {
        return DB::table('v_penataankelurahanterpilih')
            ->orderBy('kelurahanterpilihid', 'asc')
            ->where('nopengajuan', $nopengajuan)
            ->get();
    }

    public function tanggalStatusInvalid($nopengajuan, $tglverifikasipropinsi)
    {
        $rsPengajuan = DB::table('penataanriwayat')
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
