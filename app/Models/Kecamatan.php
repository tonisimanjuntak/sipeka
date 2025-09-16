<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'v_kecamatan';
    protected $primaryKey = 'kodekecamatan';
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
            DB::table('kecamatan')
                ->insert($data);

            $this->App->riwayatAktifitas($data, 'kecamatan', 'simpanDataKecamatan');

            return ['status' => 'success', 'message' => "Data berhasil disimpan"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function updateData($data, $kodekecamatan)
    {
        try {
            DB::beginTransaction();
            DB::table('kecamatan')
                ->where('kodekecamatan', $kodekecamatan)
                ->update($data);
            $this->App->riwayatAktifitas($data, 'kecamatan', 'updateDataKecamatan');

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

    public function hapusData($kodekecamatan, $rskecamatan)
    {
        try {
            DB::beginTransaction();

            DB::table('kecamatan')
                ->where('kodekecamatan', $kodekecamatan)
                ->delete();

            $this->App->riwayatAktifitas($rskecamatan, 'kecamatan', 'hapusDataKecamatan');

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
        return DB::select("SELECT create_kodekecamatan() AS id")[0]->id;
    }
}
