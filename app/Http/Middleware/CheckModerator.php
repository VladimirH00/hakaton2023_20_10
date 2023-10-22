<?php

namespace App\Http\Middleware;

use App\Exceptions\PermissionDeniedException;
use App\Models\User\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Проверка на то что пользователь является модератором
 */
class CheckModerator
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(Request): (Response) $next
     * @return Response
     * @throws \Exception
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var User $user */
        $user = Auth::user();

        $profile = $user->profile;
        if ($profile->code != 'moderator') {
            throw new PermissionDeniedException('У вас нет прав на выполнение данного действия');
        }

        return $next($request);
    }
}
