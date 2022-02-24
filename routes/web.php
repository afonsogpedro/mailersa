<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
Use App\Http\Controllers\DropCscController;

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

Route::middleware('loggedin')->group(function() {
    Route::get('login', [AuthController::class, 'loginView'])->name('login-view');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/', [PrincipalController::class, 'index'])->name('principal');

    // Usuarios, Roles y Permisos
    Route::resource('roles', RoleController::class);
    Route::get('users/getusers', [UserController::class, 'getUsers'])->name('users.getusers');
    Route::resource('users', UserController::class, ['names' => [
        'index' => 'users.index',
        'create' => 'users.create',
        'store' => 'users.store',
        'show' => 'users.show',
        'edit' => 'users.edit',
        'update' => 'users.update',
        'destroy' => 'users.destroy'
    ]]);
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('dependent-dropdown', [DropCscController::class, 'index']);
    Route::post('api/fetch-states', [DropCscController::class, 'fetchState']);
    Route::post('api/fetch-cities', [DropCscController::class, 'fetchCity']);
});





