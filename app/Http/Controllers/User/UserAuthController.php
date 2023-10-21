<?php

namespace App\Http\Controllers\User;

use App\Extensions\GoogleAuth\WrapperGoogleAuth;
use App\Http\Requests\User\LoginUserRequest;
use App\Models\User\User;
use App\Models\User\UserAuth;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Str;


class UserAuthController
{
    public function login(LoginUserRequest $request)
    {
        $email = $request->get('email');

        /** @var User $user */
        $user = User::query()->where('email', $email)->first();
        if (!$user) {
            throw new HttpResponseException(response()->json(['msg' => 'Данный пользователь не найден'], 400));
        }

        $google = new WrapperGoogleAuth($email, $user->google_secret_key);
        if (!$google->checkAuth($request->get('code'))) {
            throw new HttpResponseException(response()->json(['msg' => 'Неверный код'], 400));
        }

        $token = new UserAuth();
        $token->user_id = $user->id;
        $token->token = Str::random(60);
        $token->expires_at = date("Y-m-d H:i:s", strtotime("+1 month"));
        $token->save();

        return response()->json([
            'msg' => 'token',
            'token' => $token->token
        ]);
    }
}
