<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\AlternatifValueController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalculationController;
use App\Http\Controllers\CriteriaController;
use Illuminate\Support\Facades\Route;

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
    return view('home');
});

Route::get('/login', [AuthController::class, 'login_index'])->name('login');
Route::post('/login', [AuthController::class, 'login_store'])->name('login.store');

Route::middleware(['auth'])->group(function(){

    Route::resource('alternatifs', AlternatifController::class);
    Route::resource('criterias', CriteriaController::class);

    Route::get('/alternatif/values', [AlternatifValueController::class, 'index'])->name('alternatif.values.index');
    Route::get('/alternatif/values/{alternatif_criteria}', [AlternatifValueController::class, 'edit'])->name('alternatif.values.edit');
    Route::put('/alternatif/values/{alternatif_criteria}', [AlternatifValueController::class, 'update'])->name('alternatif.values.update');

    Route::get('/calculations', [CalculationController::class, 'index'])->name('calculations.index');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});

