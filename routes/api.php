<?php

use App\Http\Controllers\Specialist\SpecialistController;
use App\Http\Controllers\User\UserAuthController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('user/login', [UserAuthController::class, 'login']);

Route::apiResource('/months', SpecialistController::class)->except([
    'create',
    'update',
    'destroy',
])->missing(function () {
    throw new HttpResponseException(response()->json('Not found', 404));
});

Route::apiResource('user', UserController::class);
Route::middleware('user.auth')->group(function () {

    Route::apiResource('specialist', SpecialistController::class);
//    Route::apiResource('user', UserController::class);

});
