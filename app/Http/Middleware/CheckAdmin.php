<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Usamos el helper session() que es el más confiable
        if (!session()->has('admin_logged') || session('admin_logged') !== true) {
            return redirect('/login');
        }
        return $next($request);
    }
}