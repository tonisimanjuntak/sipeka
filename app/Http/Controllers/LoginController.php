<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    var $LoginModel;

    public function __construct()
    {
        $this->LoginModel = new Login;
    }

    public function index()
    {

        $nama_aplikasi = Pengaturan::getValues('nama_aplikasi');
        $data['nama_aplikasi'] = $nama_aplikasi;
        return view('login', $data);
    }

    public function login(Request $request)
    {
        $user = $this->LoginModel->cekEmail($request->email);

        if ($user && Hash::check($request->password, $user->password)) {
            Session::put('idpengguna', $user->idpengguna);
            Session::put('namalengkap', $user->namalengkap);
            Session::put('email', $user->email);
            Session::put('kodekabupaten', $user->kodekabupaten);

            if (!empty($user->foto)) {
                $foto = asset('uploads/pengguna/' . $user->foto);
                Session::put('foto', $foto);
            } else {
                $foto = asset('images/users.png');
                Session::put('foto', $foto);
            }

            $rsPengaturan = Pengaturan::all();
            foreach ($rsPengaturan as $rowPengaturan) {
                Session::put($rowPengaturan->prefix, $rowPengaturan->values);
            }

            $dataLogin = array(
                'lastlogin' => date('Y-m-d H:i:s'),
            );
            $this->LoginModel->updateData($dataLogin, $user->idpengguna);

            return redirect('dashboard');
        } else {
            return back()->with(['message' => 'email atau password salah']);
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('login');
    }
}
