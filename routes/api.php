<?php

use App\Http\Controllers\Meeting\MeetingController;
use App\Http\Controllers\Specialist\SpecialistController;
use App\Http\Controllers\User\UserAuthController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('user/login', [UserAuthController::class, 'login']);

Route::apiResource('specialist', SpecialistController::class)->except([
    'create',
    'update',
    'destroy',
])->missing(function () {
    throw new HttpResponseException(response()->json('Not found', 404));
});

Route::apiResource('meeting', MeetingController::class)->except([
    'create',
    'update',
    'destroy',
])->missing(function () {
    throw new HttpResponseException(response()->json('Not found', 404));
});

Route::middleware('user.auth')->group(function () {
    Route::get('personal-info', [UserAuthController::class, 'getInfoForUser'])->only([
        'store',
        'update',
        'destroy',
    ])->middleware('check.moderator');

    Route::apiResource('specialist', SpecialistController::class)->only([
        'store',
        'update',
        'destroy',
    ])->middleware('check.moderator');

    Route::apiResource('user', UserController::class)->middleware('check.moderator');

    Route::apiResource('meeting', MeetingController::class)->only([
        'store',
        'update',
        'destroy',
    ])->middleware('check.moderator');
});

