<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /**
     * @return mixed
     */
    public function login()
    {
        return Socialite::driver('google')
                        ->scopes(config('google.scopes'))
                        ->with([
                            'access_type'     => config('google.access_type'),
                            'approval_prompt' => config('google.approval_prompt'),
                        ])
                        ->redirect();
    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function callback(Request $request)
    {
        if (! $request->has('code')) {
            return redirect('/');
        }

        $loginUser = $this->user();

        auth()->login($loginUser, true);

        return redirect()->route('home');
    }

    /**
     * @return User
     */
    protected function user()
    {
        /**
         * @var \Laravel\Socialite\Two\User $user
         */
        $user = Socialite::driver('google')->user();

        return User::updateOrCreate([
            'google_id' => $user->id,
        ], [
            'name'          => $user->name,
            'access_token'  => $user->token,
            'refresh_token' => $user->refreshToken,
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        auth()->logout();

        return redirect('/');
    }
}
