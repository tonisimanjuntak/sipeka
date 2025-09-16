<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
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
        $data['menu'] = 'dashboard';
        return view('dashboard', $data);
    }
}
