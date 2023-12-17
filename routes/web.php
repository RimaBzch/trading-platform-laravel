<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndicatorAnalysisController;
use App\Http\Controllers\PairController;
use App\Http\Controllers\CalculatorController;

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
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/calculator', [PairController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('calculator');

Route::post('/calculator', [CalculatorController::class, 'calculate'])->name('calculate');

Route::post('/dashboard/{tool_id}', [\App\Http\Controllers\IndicatorAnalysisController::class, 'index'])->name('datatable.index');
//Route::get('/dashboard/{tool_id}', [\App\Http\Controllers\IndicatorAnalysisController::class, 'index'])->name('datatable.index');
Route::get('/dashboard/{tool_id}', [IndicatorAnalysisController::class, 'index'])->middleware(['auth', 'verified'])->name('datatable.index');
Route::put('/indicator_analyses/{indicatorAnalysisId}', [IndicatorAnalysisController::class, 'update'])->name('indicator_analyses.update');


Route::get('/vwap', [\App\Http\Controllers\VwapController::class, 'index'])->name('vwap.index');
Route::post('/vwap', [\App\Http\Controllers\VWAPController::class, 'calculateVWAP'])->name('vwap.calculate');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/user/notification-preferences', [ProfileController::class, 'updateNotificationPreferences'])
        ->name('update-notification-preferences');
    //Route::put('/indicator_analyses/{indicatorAnalysisId}', [\App\Http\Controllers\IndicatorAnalysisController::class, 'update'])->name('indicator_analyses.update');

});

require __DIR__.'/auth.php';
