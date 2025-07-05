<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventRegistrationApiController;
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

// This is a default route often included with Laravel Sanctum/Breeze for
// checking the authenticated user. You can keep or remove it.
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Your new API endpoint for event registrations
// The middleware 'auth:sanctum' and 'role:admin' are applied in the controller's constructor.
Route::get('/events/{event}/registrations', [EventRegistrationApiController::class, 'registrations']);
