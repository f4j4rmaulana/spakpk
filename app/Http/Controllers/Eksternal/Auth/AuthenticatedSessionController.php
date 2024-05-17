<?php

namespace App\Http\Controllers\Eksternal\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('eksternal.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // dd('Access Admin Login Granted');
        $request->authenticate('ekt');

        $request->session()->regenerate();

        toast("Anda berhasil login",'success');

        return redirect()->intended(RouteServiceProvider::EKSTERNAL_DASHBOARD);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('ekt')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        toast('Anda berhasil logout','success');

        return redirect('/eksternal/login');


    }
}
