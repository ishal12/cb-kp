<?php

namespace App\Http\Middleware;

use Closure;

use App\User;

class CheckHRD
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
        if (!auth()->check()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }

        switch ($request->user()->role()) {
            case '1': // Dirut
                if ($request->ajax()) {
                return response('Unauthorized.', 401);
                } else {
                    session()->flash('error', 'You are not authorised to access this route.');
                    return redirect('home');
                }
                break;
            case '2': // kepala cabang/bagian
                if ($request->ajax()) {
                return response('Unauthorized.', 401);
                } else {
                    session()->flash('error', 'You are not authorised to access this route.');
                    return redirect('home');
                }
                break;
            case '3': // hrd
                return $next($request);
                break;
            case '4': // karyawan biasa
                if ($request->ajax()) {
                return response('Unauthorized.', 401);
                } else {
                    session()->flash('error', 'You are not authorised to access this route.');
                    return redirect('home');
                }
                break;
            
            default:
                if ($request->ajax()) {
                return response('Unauthorized.', 401);
                } else {
                    session()->flash('error', 'You are not authorised to access this route.');
                    return redirect('home');
                }
                break;
        }

        return $next($request);
    }
}
