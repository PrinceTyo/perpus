<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(Auth::user()->usertype == 'author' && Auth::user()->is_approved == false){
            return redirect('/login')->withErrors(['message' => 'Akun Anda belum disetujui oleh admin.']);
        } elseif(Auth::user()->usertype == 'author' && Auth::user()->is_approved == true){
            return $next($request);
        }

        return redirect()->back();
    }
}
