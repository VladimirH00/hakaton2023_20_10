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
    /**
     * Осуществяется логин на сайт
     * Если верный google код то создает токен записывает
     * его в бд и отдает на клиент
     *
     * @param LoginUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
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

        header("Set-Cookie: token={$token->token}");

        return response()->json([
            'msg' => 'token',
            'token' => $token->token
        ]);
    }

    /**
     * Возвращаем информацию о текущем залогиненом пользователе
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInfoForUser()
    {
        /** @var User $user */
        $user = auth()->user();

        $beautyData = [
            'fio' => "{$user->surname} {$user->firstname} {$user->patronymic}",
            'surname' => $user->surname,
            'firstname' => $user->firstname,
            'patronymic' => $user->surname,
            'email' => $user->email,
            'avatar' => $user->image_path,
        ];

        return response()->json($beautyData);
    }
}
