<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class Persyaratanadministratif extends Model
{
    use HasFactory;

    protected $table = 'persyaratanadministratif';
    protected $primaryKey = 'idpersyaratanadministratif';
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
            DB::table('persyaratanadministratif')
                ->insert($data);

            $this->App->riwayatAktifitas($data, 'persyaratanadministratif', 'simpanDataPersyaratanadministratif');

            return ['status' => 'success', 'message' => "Data berhasil disimpan"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function updateData($data, $idpersyaratanadministratif)
    {
        try {
            DB::beginTransaction();
            DB::table('persyaratanadministratif')
                ->where('idpersyaratanadministratif', $idpersyaratanadministratif)
                ->update($data);
            $this->App->riwayatAktifitas($data, 'persyaratanadministratif', 'updateDataPersyaratanadministratif');

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

    public function hapusData($idpersyaratanadministratif, $rspersyaratanadministratif)
    {
        try {
            DB::beginTransaction();

            DB::table('persyaratanadministratif')
                ->where('idpersyaratanadministratif', $idpersyaratanadministratif)
                ->delete();

            $this->App->riwayatAktifitas($rspersyaratanadministratif, 'persyaratanadministratif', 'hapusDataPersyaratanadministratif');

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
        return DB::select("SELECT create_idpersyaratanadministratif() AS id")[0]->id;
    }
}
