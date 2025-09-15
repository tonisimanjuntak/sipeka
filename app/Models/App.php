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

    public static function getKategori($idkategori = '')
    {
        $rsTemp = DB::table('kategori');
        if (!empty($idkategori)) {
            $rsTemp->where('idkategori', $idkategori);
        }
        return $rsTemp->get();
    }

    public static function getJenisPendidikan($idjenispendidikan = '')
    {
        $rsTemp = DB::table('jenispendidikan');
        if (!empty($idjenispendidikan)) {
            $rsTemp->where('idjenispendidikan', $idjenispendidikan);
        }
        return $rsTemp->get();
    }

    public static function getJenisTryOut()
    {
        return DB::table('jenistryout')
            ->where('statusaktif', 'Aktif')
            ->orderBy('idjenistryout', 'Asc')
            ->get();
    }

    public static function getFormasiAsn()
    {
        return DB::table('formasiasn')
            ->where('statusaktif', 'Aktif')
            ->orderBy('idformasibidang', 'Asc')
            ->orderBy('namaformasiasn', 'Asc')
            ->get();
    }

    public static function getBank()
    {
        return DB::table('bank')
            ->where('idbank', 'B01')
            ->first();
    }

    public static function getPaket($idjenispaket = '')
    {
        $query = DB::table('jenispaket');
        if (!empty($idjenispaket)) {
            $query->where('idjenispaket', $idjenispaket);
        }
        $query->orderBy('idjenispaket', 'Asc');

        return $query->get();
    }
    
}
