<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ItemController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/v1/products',[ItemController::class,'getItems']);
Route::post('/v1/products/search',[ItemController::class,'searchItems']);
Route::get('/v1/detail/{id}', [ItemController::class, 'getItemDetail']);
Route::get('/v1/categories/{id}', [ItemController::class, 'getItemsByCategory']);
Route::post('/v1/products/filter', [ItemController::class, 'filterProducts']);
Route::get('/products/{id}/views', [ItemController::class,'updateViews']);


