<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class Pembentukankecamatan extends Model
{
    use HasFactory;

    protected $table = 'v_pembentukankecamatan';
    protected $primaryKey = 'idpengajuan';
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

    public function simpanData($data)
    {
        try {
            DB::table('pembentukankecamatan')
                ->insert($data);

            $this->App->riwayatAktifitas($data, 'pembentukankecamatan', 'simpanDatapembentukankecamatan');

            return ['status' => 'success', 'message' => "Data berhasil disimpan"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function updateData($data, $idpengajuan)
    {
        try {
            DB::beginTransaction();
            DB::table('pembentukankecamatan')
                ->where('idpengajuan', $idpengajuan)
                ->update($data);
            $this->App->riwayatAktifitas($data, 'pembentukankecamatan', 'updateDatapembentukankecamatan');

            DB::commit();
            return ['status' => 'success', 'message' => "Data berhasil disimpan"];
        } catch (QueryException $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function hapusData($idpengajuan, $rspengajuan)
    {
        try {
            DB::beginTransaction();

            DB::table('pembentukankecamatan')
                ->where('idpengajuan', $idpengajuan)
                ->delete();

            $this->App->riwayatAktifitas($rspengajuan, 'pembentukankecamatan', 'hapusDatapembentukankecamatan');

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
        return DB::select("SELECT create_idpengajuan() AS id")[0]->id;
    }

    public function getPersyaratanDasar()
    {
        return DB::table('persyaratandasar')
            ->where('statusaktif', 'Aktif')
            ->orderBy('idpersyaratandasar', 'asc')
            ->get();
    }


    public function getPersyaratanAdministratif()
    {
        return DB::table('persyaratanadministratif')
            ->where('statusaktif', 'Aktif')
            ->orderBy('idpersyaratanadministratif', 'asc')
            ->get();
    }

    public function getPersyaratanTeknis()
    {
        return DB::table('persyaratanteknis')
            ->where('statusaktif', 'Aktif')
            ->orderBy('idpersyaratanteknis', 'asc')
            ->get();
    }
}
