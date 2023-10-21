<?php

namespace App\Http\Middleware;

use App\Exceptions\AuthorizationException;
use App\Models\User\User;
use App\Models\User\UserAuth;
use Closure;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserTokenAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $authorization = explode(' ', $request->header('Authorization'));
        $token = '';
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
