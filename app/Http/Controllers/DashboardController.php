<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DashboardController extends Controller
{

    var $Dashboard;

    public function __construct()
    {
        $this->Dashboard = new Dashboard;
        $this->isLogin();
    }

    public function index()
    {
        $data['jumlahKabupaten'] = Kabupaten::count();
        $data['jumlahKecamatan'] = Kecamatan::count();
        $data['jumlahKelurahan'] = Kelurahan::count();
        $data['menu'] = 'dashboard';
        return view('dashboard', $data);
    }
}
