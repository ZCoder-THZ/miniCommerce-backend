<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;

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
   return Redirect::to('/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::prefix('items')->group(function(){

        Route::get('/itemList',[ItemController::class,'getItemList'])->name('itemList');
        Route::get('/itemCreatePage',[ItemController::class,'createItemPage'])->name('createItemPage');
        Route::post('/itemCreate',[ItemController::class,'createItem'])->name('createItem');
        Route::get('/categoryList',[SubCategoryController::class,'getSubCategoryList'])->name('category#getSubCategoryList');

     Route::get('/itemList/limit',[ItemController::class,'getItemLimit']);


        Route::get('/deleteItem/{id}',[ItemController::class,'deleteItem'])->name('deleteItem');
        Route::get('/editPage/{id}',[ItemController::class,'editPage'])->name('editPage');
        Route::post('/{id}/edit',[ItemController::class,'editItem'])->name('editItem');


    });
    Route::prefix('profile')->group(function (){
      Route::get('/detail',[ProfileController::class,'getProfile'])->name('getProfile');
      Route::post('/detail',[ProfileController::class ,'updateProfile'])->name('updateProfile');
    });

    Route::prefix('categories')->group(function(){
    Route::get('/categoryList',[CategoryController::class,'getCategoryList'])->name('category#getCategoryList');
    Route::get('/createPage',[CategoryController::class,'createPage'])->name('category#createPage');
    Route::post('/create',[CategoryController::class,'createCategory'])->name('category#create');
    Route::get('/editPage/{id}',[CategoryController::class,'editCategoryPage'])->name('category#editPage');
    Route::get('/deletCategory/{id}',[CategoryController::class,'deleteCategory'])->name('category#deleteCategory');
    Route::post('/{id}/edit',[CategoryController::class,'editCategory'])->name('category#edit');

});

});

Route::put('/items/{id}/status', [ItemController::class,'updateStatus'])->name('items.updateStatus');
