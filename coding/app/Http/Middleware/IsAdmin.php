<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //bisa guest, bisa check, kalau cek itu true bila belum login, klo guest true bila sudah login
        if (auth()->guest() || !auth()->user()->is_admin) {
            abort(403); //bila belum login kasih forbidden
        }
        return $next($request);
    }
}
