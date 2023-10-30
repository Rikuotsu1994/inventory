<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\InventoryController;
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

Route::get('/', function () { return view('login');})->name('login');

Route::post('/login', [LoginController::class, 'postLoginInventory']);

Route::get('/logout', [LoginController::class, 'getLogoutInventory'])->name('logout');

Route::get('/inventory', [InventoryController::class, 'getSeasoningsInventory'])
->middleware(['auth', 'verified'])->name('index');

Route::post('/create', [InventoryController::class, 'postSeasoningsCreate'])
->middleware(['auth', 'verified'])->name('create');

Route::post('/delete', [InventoryController::class, 'postSeasoningsDelete'])
->middleware(['auth', 'verified'])->name('delete');

Route::post('/seasoning/update', [InventoryController::class, 'postSeasoningsUpdate'])
->middleware(['auth', 'verified'])->name('/seasoning/update');

Route::post('amount/upsert', [InventoryController::class, 'postAmountUpsert'])
->middleware(['auth', 'verified'])->name('amount/upsert');

Route::get('/market', [InventoryController::class, 'getMarket'])
->middleware(['auth', 'verified'])->name('market');