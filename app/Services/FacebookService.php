<?php

namespace App\Services;

use App\Contracts\SocialService;
use App\Models\User;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FacebookService implements SocialService
{

    public function getFacebookAccessToken(): string
    {
        $accessToken = session('facebook_access_token');
        if(!$accessToken) {
            /**
             * @var User $user
             */
            if($user = Auth::user()) {
                Session::put('facebook_access_token', $user->facebook_access_token);
                return $user->facebook_access_token;
            } else {
                return redirect()->route('youtube.login');
            }
        }

        return $accessToken;
    }

    /**
     * @throws FacebookSDKException
     */
    public function getAuthLink(): string
    {
        $fb = new Facebook([
            'app_id' => config('services.facebook.client_id'),
            'app_secret' => config('services.facebook.client_secret'),
            'default_graph_version' => 'v16.0',
        ]);

        $helper = $fb->getRedirectLoginHelper();

        $permissions = ['email', 'public_profile'];

        return $helper->getLoginUrl(config('services.facebook.redirect_uri'), $permissions);
    }

    public function handleSocialCallback($code)
    {
        $fb = new \Facebook\Facebook([
            'app_id' => config('services.facebook.client_id'),
            'app_secret' => config('services.facebook.client_secret'),
            'default_graph_version' => 'v16.0',
        ]);

        $helper = $fb->getRedirectLoginHelper();

        try {
            // Получаем токен доступа
            $accessToken = $helper->getAccessToken(config('services.facebook.redirect_uri'));
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            return redirect()->route('home')->with('error', 'Error while authenticating with Facebook: ' . $e->getMessage());
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            return redirect()->route('home')->with('error', 'Facebook SDK error: ' . $e->getMessage());
        }

        if (!isset($accessToken)) {
            return redirect()->route('home')->with('error', 'Unable to get access token from Facebook');
        }

        // Сохраняем токен в сессии
        Session::put('facebook_access_token', (string) $accessToken);

        // Получаем информацию о пользователе
        try {
            $response = $fb->get('/me?fields=id,name,email', $accessToken);
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            return redirect()->route('home')->with('error', 'Error fetching user data: ' . $e->getMessage());
        }

        $userInfo = $response->getGraphUser();

        if ($user = Auth::user()) {
            $user->update([
                'facebook_id' => $userInfo->getId(),
                'name' => $userInfo->getName(),
                'email' => $userInfo->getEmail(),
                'facebook_access_token' => (string) $accessToken,
            ]);
        } else {
            $user = User::updateOrCreate(
                [
                    'email' => $userInfo->getEmail(),
                ],
                [
                    'name' => $userInfo->getName(),
                    'email' => $userInfo->getEmail(),
                    'facebook_id' => $userInfo->getId(),
                    'facebook_access_token' => (string) $accessToken,
                ]
            );

            Auth::login($user);
        }

        return redirect()->route('dashboard')->with('success', 'Successfully authenticated with Facebook');
    }



}
