<?php

namespace App\Http\Middleware;
use Session;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            switch ($guard) {
                case 'customer':
                    if (Auth::guard($guard)->check()) {
                        return redirect('/stylist/customer/info');
                    }
                    break;
            }

            if (Auth::guard($guard)->check()) {
                // dd('AUthed');
                return redirect(RouteServiceProvider::DASHBOARD);
            }
        }

        return $next($request);
    }
}
