<?php

namespace App\Http\Controllers\Invokes;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * @param string $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(string $token): RedirectResponse
    {
        if ($user = User::whereToken($token)->first()) {
            $user->update(['token' => null]);

            return redirect("/users/$user->username")
                ->withSuccess(trans('settings.email_verified'));
        }
        return redirect('/');
    }
}
