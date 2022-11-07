<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('auth', [AuthController::class, 'authFlow'])->name('auth');
Route::get('auth', [AuthController::class, 'checkLogin'])->name('check-login')->middleware('auth');

Route::get('events', [EventController::class, 'get'])->name('get-event')->middleware('auth');
Route::post('events', [EventController::class, 'add'])->name('add-event')->middleware('auth');
Route::patch('events', [EventController::class, 'edit'])->name('edit-event')->middleware('auth');
Route::delete('events', [EventController::class, 'delete'])->name('delete-event')->middleware('auth');


