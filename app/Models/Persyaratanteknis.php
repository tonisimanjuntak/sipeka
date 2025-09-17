<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class Persyaratanteknis extends Model
{
    use HasFactory;

    protected $table = 'persyaratanteknis';
    protected $primaryKey = 'idpersyaratanteknis';
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
            DB::table('persyaratanteknis')
                ->insert($data);

            $this->App->riwayatAktifitas($data, 'persyaratanteknis', 'simpanDataPersyaratanteknis');

            return ['status' => 'success', 'message' => "Data berhasil disimpan"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function updateData($data, $idpersyaratanteknis)
    {
        try {
            DB::beginTransaction();
            DB::table('persyaratanteknis')
                ->where('idpersyaratanteknis', $idpersyaratanteknis)
                ->update($data);
            $this->App->riwayatAktifitas($data, 'persyaratanteknis', 'updateDataPersyaratanteknis');

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

    public function hapusData($idpersyaratanteknis, $rspersyaratanteknis)
    {
        try {
            DB::beginTransaction();

            DB::table('persyaratanteknis')
                ->where('idpersyaratanteknis', $idpersyaratanteknis)
                ->delete();

            $this->App->riwayatAktifitas($rspersyaratanteknis, 'persyaratanteknis', 'hapusDataPersyaratanteknis');

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
        return DB::select("SELECT create_idpersyaratanteknis() AS id")[0]->id;
    }
}
