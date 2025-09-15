<?php



namespace App\Http\Controllers\admin;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    protected function isLogin()
    {
        $this->middleware(function ($request, Closure $next) {
            if (!Session::has('idpengguna')) {
                return redirect('login');
            }
            return $next($request);
        });
    }
}
