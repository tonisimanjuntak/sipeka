<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class App extends Model
{
    use HasFactory;

    public static function riwayatAktifitas($data, $namatabel, $namafunction)
    {
        $dataRiwayat = array(
            'deskripsi' => json_encode($data),
            'namapengguna' => session()->get('namapengguna'),
            'inserted_date' => date('Y-m-d H:i:s'),
            'namatabel' => $namatabel,
            'namafunction' => $namafunction,
        );
        DB::table('riwayataktifitas')
            ->insert($dataRiwayat);
        return true;
    }

    public static function getPangkat($idpangkat = '')
    {
        $rsTemp = DB::table('refpangkat');
        if (!empty($idpangkat)) {
            $rsTemp->where('idpangkat', $idpangkat);
        }
        return $rsTemp->get();
    }

    public static function getKabupaten($kodekabupaten = '')
    {
        $rsTemp = DB::table('kabupaten');
        if (!empty($kodekabupaten)) {
            $rsTemp->where('kodekabupaten', $kodekabupaten);
        }
        return $rsTemp->get();
    }

    public static function getStepNumber($idstatuspengajuanterakhir = "")
    {
        if (empty($idstatuspengajuanterakhir)) {
            $stepNumber = 0;
        }else{
            $rsStatusPengajuan = DB::table('statuspengajuan')
                ->where('statusaktif', 'Aktif')
                ->orderBy('urut', 'asc')
                ->get();
            $stepNumber = 1; //dimulai dari 1 karena ambil step nextnya
            foreach ($rsStatusPengajuan as $row) {
                if ($row->idstatuspengajuan == $idstatuspengajuanterakhir) {
                    break; // Keluar dari loop foreach
                }
                $stepNumber++;
            }
        }

        return $stepNumber;
    }
    
}
