<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class Persyaratandasar extends Model
{
    use HasFactory;

    protected $table = 'persyaratandasar';
    protected $primaryKey = 'idpersyaratandasar';
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
            DB::table('persyaratandasar')
                ->insert($data);

            $this->App->riwayatAktifitas($data, 'persyaratandasar', 'simpanDataPersyaratandasar');

            return ['status' => 'success', 'message' => "Data berhasil disimpan"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function updateData($data, $idpersyaratandasar)
    {
        try {
            DB::beginTransaction();
            DB::table('persyaratandasar')
                ->where('idpersyaratandasar', $idpersyaratandasar)
                ->update($data);
            $this->App->riwayatAktifitas($data, 'persyaratandasar', 'updateDataPersyaratandasar');

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

    public function hapusData($idpersyaratandasar, $rspersyaratandasar)
    {
        try {
            DB::beginTransaction();

            DB::table('persyaratandasar')
                ->where('idpersyaratandasar', $idpersyaratandasar)
                ->delete();

            $this->App->riwayatAktifitas($rspersyaratandasar, 'persyaratandasar', 'hapusDataPersyaratandasar');

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
        return DB::select("SELECT create_idpersyaratandasar() AS id")[0]->id;
    }
}
