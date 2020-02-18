<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\User\UserService;
use Illuminate\Http\RedirectResponse;
use Socialite;

class SocialController extends Controller
{
    /**
     * @var UserService
     */
    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * Create a redirect method to facebook api.
     *
     * @param string $provider
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirect($provider)
    {
        return \Laravel\Socialite\Facades\Socialite::driver($provider)->redirect();
    }

    /**
     * @param string $provider
     *
     * @return RedirectResponse
     */
    public function callback($provider)
    {
        $userSocial =   \Laravel\Socialite\Facades\Socialite::driver($provider)->user();
        $user = $this->service->getOrCreate($userSocial);
        auth()->login($user);

        return redirect()->to('/home');
    }
}
