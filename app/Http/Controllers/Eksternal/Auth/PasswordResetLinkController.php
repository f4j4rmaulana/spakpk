<?php

namespace App\Http\Controllers\Eksternal\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Notifications\ResetPassword;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        $title = 'Eksternal Lupa Password';
        return view('eksternal.auth.forgot-password', compact('title'));
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::broker('ekts')->sendResetLink(
            $request->only('email'),
            function($user, $token) {
                $notification = new ResetPassword($token);
                $notification->createUrlUsing(function() use ($user, $token) {
                    return route('eksternal.password.reset', ['token' => $token, 'email' => $user->email]);
                });
                $user->notify($notification);
            }
        );

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }
}
