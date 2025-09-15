<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class Login extends Model
{
    public function cekEmail($email)
    {
        return DB::table('admin')
            ->where('email', $email)
            ->first();
    }


    public function cekEmailPengguna($email)
    {
        return DB::table('pengguna')
            ->where('email', $email)
            ->first();
    }

    public function updateData($data, $idadmin)
    {
        DB::table('admin')
            ->where('idadmin', $idadmin)
            ->update($data);
    }

    public function updateDataPengguna($data, $idpengguna)
    {
        DB::table('pengguna')
            ->where('idpengguna', $idpengguna)
            ->update($data);
    }
}
