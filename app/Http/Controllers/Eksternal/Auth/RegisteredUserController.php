<?php

namespace App\Http\Controllers\Eksternal\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('eksternal.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:internal,eksternal'],
            'instansi' => ['required', 'string', 'max:255'],
            'nomor_id' => ['required', 'string', 'max:20','unique:users,nomor_id'],
            'unit_kerja' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name' => ucwords(strtolower(strip_tags($request->name))),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'nomor_id' => ucwords(strtolower(strip_tags($request->nomor_id))),
            'instansi' => ucwords(strtolower(strip_tags($request->instansi))),
            'unit_kerja' => ucwords(strtolower(strip_tags($request->unit_kerja))),
            'jabatan' => ucwords(strtolower(strip_tags($request->jabatan))),
        ]);

        event(new Registered($user));

        Auth::guard('ekt')->login($user);

        return redirect(RouteServiceProvider::EKSTERNAL_DASHBOARD);
    }
}
