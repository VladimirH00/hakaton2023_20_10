<?php

namespace App\Http\Middleware;

use App\Exceptions\AuthorizationException;
use App\Models\User\User;
use App\Models\User\UserAuth;
use Closure;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class UserTokenAuth
{
    /**
     * Проходит проверка аутентификации пользователя
     *
     * @param Request $request
     * @param \Closure(Request): (Response) $next
     * @return Response
     * @throws AuthorizationException
     */
    public function handle(Request $request, Closure $next): Response
    {
        $authorization = explode(' ', trim($request->header('Authorization')));

        if (is_array($authorization) && count($authorization) > 0) {
            $token = $authorization[1];
        }

        if (!$token) {
            throw new AuthorizationException('Неавторизированное действие');
        }

        /** @var UserAuth $userToken */
        $userToken = UserAuth::query()
            ->where('token', $token)
            ->whereNull('deleted_at')
            ->first();
        if (!$userToken) {
            throw new AuthorizationException('Неавторизированное действие');
        }

        $now = new DateTime("now");
        $expiresAt = new DateTime($userToken->expires_at);

        $user = User::query()
            ->find($userToken->user_id);

        if (!$user) {
            throw new AuthorizationException('Неавторизированное действие');
        }

        if ($now > $expiresAt) {
            $userToken->deleted_at = date('Y-m-d H:i:s');
            $userToken->save();

            throw new AuthorizationException('token_expires');
        }

        Auth::login($user);

        return $next($request);
    }
}
