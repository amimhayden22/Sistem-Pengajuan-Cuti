<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{EmployeeController, HomeController, PositionController, UserController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false, // Registration Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('/employees/send/information-account/{id}', [EmployeeController::class, 'sendEmail'])->name('employees.send-email');
    Route::resource('/positions', PositionController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/employees', EmployeeController::class);

});

