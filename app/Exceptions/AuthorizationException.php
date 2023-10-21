<?php

namespace App\Exceptions;

use App\Http\Requests\AbstractBaseApiRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthorizationException extends AbstractBaseException
{

    /**
     * Преобразовать исключение в HTTP-ответ.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function render(Request $request)
    {
        return response()->json(['msg' => $this->message], 401);
    }
}
