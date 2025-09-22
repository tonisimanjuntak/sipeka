<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class Lappenyesuaian extends Model
{
    var $App;

    public function __construct()
    {
        $this->App = new App;
    }

    public function getPembentukan($tglawal, $tglakhir)
    {
        $where = " where tglpengajuan between '$tglawal' and '$tglakhir' ";
        return DB::select("select * from v_pembentukankecamatan_alljoin" . $where);

    }

}
