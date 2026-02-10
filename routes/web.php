<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\WhatsAppController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [OrderController::class, 'index']);
Route::post('/checkout', [OrderController::class, 'checkout']);

Route::get('/test-pdf', [OrderController::class, 'testPdf']);




