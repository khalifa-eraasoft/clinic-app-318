<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Contact\ContactController;
use App\Http\Controllers\Api\Major\MajorController;
use App\Http\Controllers\Api\Profile\ProfileController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::controller(AuthController::class)
    ->group(function () {
        Route::post('/register',  'register');
        Route::post('/login',  'login');
        Route::post('/logout',  'logout')
            ->middleware('auth:api');
    });
Route::middleware('auth:api')
    ->controller(ProfileController::class)
    ->group(function () {
        Route::post('/update-profile', 'updateProfile');
        Route::post('/update-password', 'updatePassword');
    });
Route::controller(MajorController::class)
    ->group(function () {
        Route::get('/majors', 'index');
        Route::get('/majors/{major}', 'show');
    });
Route::post('/contact-us', [ContactController::class, 'store']);
