<?php
use App\Http\Controllers\Meeting\MeetingController;
use App\Http\Controllers\Specialist\SpecialistController;
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

Route::apiResource('specialist', SpecialistController::class);
Route::apiResource('user', UserController::class);
Route::apiResource('meeting', MeetingController::class);
