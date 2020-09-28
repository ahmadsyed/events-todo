<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('add-event', [EventController::class, 'addEvent']);
Route::put('update-event', [EventController::class, 'updateEvent']);
Route::get('get-event', [EventController::class, 'getEvent']);
Route::delete('delete-event', [EventController::class, 'deleteEvent']);


