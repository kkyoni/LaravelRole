<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated{
    public function handle($request, Closure $next, $guard = null){
        if(Auth::guard($guard)->check()) {
            if (in_array(Auth::user()->user_type,['superadmin'])){
                return redirect()->route('admin.dashboard');
            }else{
                return redirect()->route('front.login');
            }
        }
        return $next($request);
    }
}