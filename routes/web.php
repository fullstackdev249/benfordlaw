<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\conformLawController;

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

Route::get('/', [conformLawController::class, 'index']);

Route::post('/conformLaw', [conformLawController::class, 'conformLaw'])->name('conformLaw');
