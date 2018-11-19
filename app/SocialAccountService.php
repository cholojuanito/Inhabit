<?php

namespace App;

use Laravel\Socialite\Contracts\User as ProviderUser;
use App\SocialAccount;

class SocialAccountService
{
    public function findOrCreate(ProviderUser $providerUser, $provider)
    {
        $providerName = 'unknown';
        switch ($provider) {
            case 'facebook':
                $providerName = 'facebook';
                break;
        }
        // See if the user has logged in with another service before
        $account = SocialAccount::where('provider_name', $provider)
            ->where('provider_id', $providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {
            // See if the users email from the provider matches any user in the database
            $user = User::where('email', $providerUser->getEmail())->first();

            // New user
            if (!$user) {
                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                    'confirmed' => 1
                ]);
            }
            // Link their account
            $user->accounts()->create([
                'provider_id' => $providerUser->getId(),
                'provider_name' => $providerName,
            ]);

            return $user;

        }
    }
}