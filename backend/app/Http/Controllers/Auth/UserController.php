<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\UserProfileRequest;
use App\Models\TrUser;
use App\Models\TrUserProfile;
use App\Services\AuthUserService;
use Auth;
use App\Http\Controllers\Controller;
use Session;

class UserController extends Controller
{

    public function edit()
    {
        $trUser = Auth::user() ?? new TrUser;
        return view('auth.user.edit', compact('trUser'));
    }

    public function store(UserProfileRequest $request, AuthUserService $authUserService)
    {
        $trUser = $authUserService->saveUserProfile(
            $request->validated(),
            Auth::user() ?? new TrUser,
            Session::get('socialUser') ?? []);

        Auth::login($trUser, true);

        return redirect()->route('user.complete');
    }

    public function complete()
    {
        return view('auth.user.complete');
    }
}
