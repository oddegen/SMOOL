<?php

use App\Http\Controllers\ChapaController;
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

Route::get('/chapa/callback/{reference}', ChapaController::class)->name('chapa.callback');

Route::view('/welcome', 'welcome');
