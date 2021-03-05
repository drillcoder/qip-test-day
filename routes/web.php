<?php

use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\ProxyCheckerController;
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

Route::get('/', [ProxyCheckerController::class, 'form']);
Route::post('/', [ProxyCheckerController::class, 'check']);

Route::get('/archive', [ArchiveController::class, 'all']);
Route::get('/archive/{id}', [ArchiveController::class, 'one']);
