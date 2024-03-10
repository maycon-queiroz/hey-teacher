<?php

namespace App\Http\Controllers\Github;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CallbackController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        /** @var \Laravel\Socialite\One\User $githubUser */
        $githubUser = Socialite::driver('github')->user();

        $user = User::updateOrCreate([
            'email' => $githubUser->email,
        ], [
            'name'              => $githubUser->name,
            'email_verified_at' => now(),
            'password'          => Str::random(40),
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }
}
