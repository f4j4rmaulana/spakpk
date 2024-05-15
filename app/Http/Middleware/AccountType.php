<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AccountType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$accountTypes): Response
    {
        $guard = Auth::guard(); // Menggunakan guard default (web) jika tidak disetel secara eksplisit

        if ($guard->name === 'ekt') {
            $user = $guard->user();
            if ($user && in_array($user->account_type, $accountTypes)) {
                return $next($request);
            }
        } elseif ($guard->name === 'web') {
            // Logika untuk guard 'web' jika diperlukan
            // Misalnya, tidak memerlukan pengecekan jenis akun
            return $next($request);
        }

        return redirect()->back(); // Arahkan ke halaman login yang sesuai dengan guard
    }
}
