<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class Kelurahan extends Model
{
    use HasFactory;

    protected $table = 'v_kelurahan';
    protected $primaryKey = 'kodekelurahan';
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
            DB::table('kelurahan')
                ->insert($data);

            $this->App->riwayatAktifitas($data, 'kelurahan', 'simpanDatakelurahan');

            return ['status' => 'success', 'message' => "Data berhasil disimpan"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function updateData($data, $kodekelurahan)
    {
        try {
            DB::beginTransaction();
            DB::table('kelurahan')
                ->where('kodekelurahan', $kodekelurahan)
                ->update($data);
            $this->App->riwayatAktifitas($data, 'kelurahan', 'updateDatakelurahan');

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

    public function hapusData($kodekelurahan, $rskelurahan)
    {
        try {
            DB::beginTransaction();

            DB::table('kelurahan')
                ->where('kodekelurahan', $kodekelurahan)
                ->delete();

            $this->App->riwayatAktifitas($rskelurahan, 'kelurahan', 'hapusDatakelurahan');

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
        return DB::select("SELECT create_kodekelurahan() AS id")[0]->id;
    }
}
