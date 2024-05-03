<?php

namespace App\Http\Controllers\Auth;

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
        return view('auth.register');
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
            'idnumber' => ['required', 'string', 'max:20'],
            'unit_kerja' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
        ]);


        $user = User::create([
            'name' => ucwords(strtolower(strip_tags($request->name))),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'idnumber' => ucwords(strtolower(strip_tags($request->idnumber))),
            'instansi' => ucwords(strtolower(strip_tags($request->instansi))),
            'unit_kerja' => ucwords(strtolower(strip_tags($request->unit_kerja))),
            'jabatan' => ucwords(strtolower(strip_tags($request->jabatan))),
            'username' => preg_replace('/[^a-zA-Z0-9]/', '', strstr($request->email, '@', true)),
        ]);

        event(new Registered($user));

        // Auth::login($user);

        return redirect()->route('login');
    }
}
