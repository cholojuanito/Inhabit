<?php

namespace App\Http\Controllers\Auth;

use App\SocialAccount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use Illuminate\Support\Facades\Auth;
use App\SocialAccountService;

class SocialAccountsController extends Controller
{
    /**
     * Redirect the user to the specified authentication page.
     *
     * @param $provider Social auth provider
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Gathers the users credentials from the social media
     * provider.
     *
     * @param $accountService SocialAccountService that either finds or creates the user
     * @param $provider Social auth provider
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(SocialAccountService $accountService, $provider)
    {

        try {
            $user = Socialite::with($provider)->user();
        } catch (\Exception $e) {
            return redirect()->to('/login');
        }

        $authUser = $accountService->findOrCreate($user, $provider);

        auth()->login($authUser, true);

        return redirect()->to('/home');
    }
}
