<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        /** Check akses jika user mengakses dari halaman admin maka input username pasti kosong dan menjadikan email yang divalidasi dan sebaliknya */
        if (!isset($this->username)) {
            return [
                'email' => ['required', 'string'],
                'password' => ['required', 'string'],
            ];
        } else {
            return [
                'username' => ['required', 'string'],
                'password' => ['required', 'string'],
            ];
        }
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate($guard = null): void
    {
        $this->ensureIsNotRateLimited();

        /** Jika sudah sampai sini maka bisa menggunakan validasi guard = admin, sehingga credential menggunakan email */
        if ($guard) {
            $credentials = [
                'email' => $this->email,
                'password' => $this->password,
            ];
        } else {
            $credentials = [
                'uid' => $this->username,
                'password' => $this->password,
                'fallback' => [
                    'username' => $this->username,
                    'password' => $this->password,
                ],
            ];
        }

        // $check_ldap = check_nip_by_ldap($this->username, $this->password);

        // if(!$check_ldap) {
        //     throw ValidationException::withMessages([
        //         'username' => trans('akun ldap anda tidak valid'),
        //     ]);
        // }

        // $credentials = [
        //     'username' => $check_ldap[0]['uid'][0],
        //     'password' => $check_ldap[0]['userpassword'][0],
        // ];

        // Jika remember checkbox dicentang, atur remember sebagai true
        $remember = $this->input('remember') ?? false;

        if (!Auth::guard($guard)->attempt($credentials, $remember)) {
            RateLimiter::hit($this->throttleKey());

            if ($guard) {
                throw ValidationException::withMessages([
                    'email' => trans('auth.failed'),
                ]);
            } else {
                throw ValidationException::withMessages([
                    'username' => trans('auth.failed'),
                ]);
            }
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        if (!isset($this->username)) {
            throw ValidationException::withMessages([
                'email' => trans('auth.throttle', [
                    'seconds' => $seconds,
                    'minutes' => ceil($seconds / 60),
                ]),
            ]);
        } else {
            throw ValidationException::withMessages([
                'username' => trans('auth.throttle', [
                    'seconds' => $seconds,
                    'minutes' => ceil($seconds / 60),
                ]),
            ]);
        }
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        if (!isset($this->username)) {
            return Str::transliterate(Str::lower($this->string('email')) . '|' . $this->ip());
        } else {
            return Str::transliterate(Str::lower($this->string('username')) . '|' . $this->ip());
        }
    }
}
