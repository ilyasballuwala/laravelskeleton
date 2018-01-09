<?php
// Added Amit on 01-03-2017
// New middleware class for 'Admin' section login check

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdmin {
	
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
	 
    public function handle($request,Closure $next,$guard = 'admin') {
		if(!Auth::guard($guard)->check()){
			return redirect('/admin/login');
		}
		return $next($request);
	}
}