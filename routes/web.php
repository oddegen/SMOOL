<?php

use Illuminate\Support\Facades\Route;

use Spatie\WelcomeNotification\WelcomesNewUsers;
use App\Http\Controllers\Auth\LoginController;
use Filament\Facades\Filament;
use Filament\Pages\Auth\Login;

Route::get('/', function () {
    return redirect('/admin');
});

Route::get('/login', function () {
    return redirect(route('filament.admin.auth.login'));
})->name('login');

Route::group(['middleware' => ['web', WelcomesNewUsers::class,]], function () {
    Route::get('welcome/{user}', [LoginController::class, 'showWelcomeForm'])->name('welcome');
    Route::post('welcome/{user}', [LoginController::class, 'savePassword']);
});

Route::post('pay', 'App\Http\Controllers\ChapaController@initialize')->name('pay');

// The callback url after a payment
Route::get('callback/{reference}', 'App\Http\Controllers\ChapaController@callback')->name('callback');

Route::view('/welcome', 'welcome');
