<?php

namespace App\Http\Controllers\Social;

use App\Http\Controllers\Controller;
use App\Repositories\TrUserRepository;
use Auth;
use Session;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{

    /**
     * @var TrUserRepository
     */
    private TrUserRepository $trUserRepository;

    function __construct(TrUserRepository $trUserRepository)
    {
        $this->trUserRepository = $trUserRepository;
    }

    /**
     * @param $tr_user_id
     */
    public function login(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider)
    {
        $socialUser = Socialite::driver($provider)->user();
        $user = $this->trUserRepository->findBySocialId($socialUser->getId(), $provider);

        if ($user !== null) {
            //DB登録済み
            Auth::login($user, true);
            return redirect()->route('top');
        } else {
            //DB未登録。プロフィール設定へ
            Session::put([
                    'socialUser' => [
                        'social_id' => $socialUser->getId(),
                        'provider' => $provider
                    ]
                ]
            );
            return redirect()->route('user.edit');
        }
    }
}
