<?php

use App\Http\Controllers\Admin\Contact\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\Home\HomeController;
use App\Http\Controllers\Front\Home\HomeController as HomeHomeController;
use App\Http\Controllers\Front\Auth\LoginController;
use App\Http\Controllers\Admin\Major\MajorController;
use App\Http\Controllers\Admin\Doctor\DoctorController;
use App\Http\Controllers\Front\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::group([
    'middleware' => ['auth', 'check.role']
], function () {
    Route::resource('/home', HomeController::class)
        ->only('index');

    Route::resource('/majors', MajorController::class);
    Route::resource('/doctors', DoctorController::class);
    Route::controller(ContactController::class)
        ->group(function () {
            Route::get('/contact-us', 'index')
                ->name('contact-us.index');
            Route::get('/contact-us/{contact}', 'show')
                ->name('contact-us.show');
            Route::post('/contact-us', 'store')
                ->name('contact-us.store');
        });
});


Route::resource('/clinic', HomeHomeController::class);
Route::resource('/clinic-doctors', DoctorController::class);
Route::resource('/login', LoginController::class);
Route::resource('/register', RegisterController::class);

require __DIR__ . '/auth.php';
