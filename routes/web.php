<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SellingController;

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
    return view('welcome');
});

Route::get('/PosItem', [ItemController::class, 'index' ]);
Route::post('/PosItem', [ItemController::class, 'additem' ]);
Route::match (['get', 'post'], '/PosItem{item:id}', [ItemController::class, 'edititem']);
Route::delete('/PosItem{item:id}', [ItemController::class, 'deleteitem' ]);

Route::get('/PosSelling', [SellingController::class, 'index']);
Route::post('/PosSelling', [SellingController::class, 'neworder']);
Route::match (['get', 'post'], '/PosSelling{selling:id}', [SellingController::class, 'editorder']);
Route::delete('/PosSelling{selling:id}', [SellingController::class, 'deleteorder' ]);


