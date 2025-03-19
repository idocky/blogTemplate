<?php

namespace App\Services;

use App\Contracts\SocialService;
use App\Models\User;
use Google_Client;
use Google_Service_Gmail;
use Google_Service_Oauth2;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class GoogleService implements SocialService
{

    public function getGoogleAccessToken(): string
    {
        $accessToken = session('google_access_token');
        if(!$accessToken) {
            /**
             * @var User $user
             */
            if($user = Auth::user()) {
                Session::put('google_access_token', $user->google_access_token);
                return $user->google_access_token;
            } else {
                return redirect()->route('youtube.login');
            }
        }

        return $accessToken;
    }

    public function getAuthLink(): string
    {
        $client = new Google_Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(config('services.google.redirect_uri'));
        $client->setAccessType('offline');
        $client->setPrompt('consent');

        // Добавьте необходимый scope
        $client->setScopes([
            Google_Service_Oauth2::USERINFO_EMAIL,
            Google_Service_Oauth2::USERINFO_PROFILE,
        ]);

        return $client->createAuthUrl();
    }

    public function handleSocialCallback($code)
    {
        $client = new Google_Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(config('services.google.redirect_uri'));

        $accessToken = $client->fetchAccessTokenWithAuthCode($code);

        if (isset($accessToken['error'])) {
            return redirect()->route('temp-dashboard')->with('error', 'Error while authenticating with Google');
        }

        // Сохраняем токен в клиенте для будущих запросов
        $client->setAccessToken($accessToken);

        Session::put('google_access_token', $accessToken['access_token']);

        $oauth2 = new Google_Service_Oauth2($client);
        $userInfo = $oauth2->userinfo->get();

        if (!$userInfo) {
            return redirect()->route('temp-dashboard')->with('error', 'Unable to fetch user data from Google');
        }

        if($user = Auth::user()) {
            $user->update([
                'google_id' => $userInfo->id,
                'first_name' => $userInfo->name,
                'email' => $userInfo->email,
            ]);
            Session::put('user_id', $user->id);
            Session::put('name', $user->first_name);
            Session::put('email', $user->email);
        } else {
            $user = User::updateOrCreate(
                [
                    'email' => $userInfo->email,
                ],
                [
                    'first_name' => $userInfo->name,
                    'email' => $userInfo->email,
                    'google_id' => $userInfo->id,
                    'active_client' => 1,
                    'photo' => $userInfo->picture,
                    'verified' => 1,
                ]
            );

            Auth::login($user);
            Session::put('user_id', $user->id);
            Session::put('name', $user->first_name);
            Session::put('email', $user->email);
        }
    }


}
