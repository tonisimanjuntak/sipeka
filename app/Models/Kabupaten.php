<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;

    protected $table = 'kabupaten';
    protected $primaryKey = 'kodekabupaten';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['namakabupaten'];
}
