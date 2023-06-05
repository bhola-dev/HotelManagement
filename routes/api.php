<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoomController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);

Route::prefix('v1')->group(function () {
    Route::get('/room', [RoomController::class, 'index']);

    Route::group(['middleware' => ["auth:sanctum"]], function () {
        Route::post('logout', [AuthController::class, 'logout']);

        Route::post('/room', [RoomController::class, 'store']);
        Route::patch('/room', [RoomController::class, 'update']);
        Route::delete('/room', [RoomController::class, 'destroy']);
    
        Route::post('/room/book', [RoomController::class, 'bookRoom']);

        Route::post('/room/book/cancel', [RoomController::class, 'cancelBooking']);
    });
    Route::get('/room/avail', [RoomController::class, 'checkRoomAvail']);
    Route::get('/room/list/avail', [RoomController::class, 'availRoomList']);
});
