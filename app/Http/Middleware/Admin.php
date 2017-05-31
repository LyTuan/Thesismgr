<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() || Auth::viaRemember())
        {
            if(Auth::user()->isAdmin()) {
                return $next($request);
            }
            else if(Auth::user()->isSuperadmin()) {
                return redirect('superadmin');
            }
            else if(Auth::user()->isInstructor()) {
                return redirect('instructor');
            }
            else if(Auth::user()->isStudent()) {
                return redirect('student');
            }
        }

        return redirect('login');
    }
}
