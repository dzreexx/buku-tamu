<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class isInside
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $sessionIni = Session::get('guest_id');
        if ($sessionIni) {
            // dd($sessionIni);
            return redirect()->route('guest.ticket', $sessionIni);
        }
        return $next($request);
    }
}
