<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemMutationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('items/ajax', [ItemController::class,'ajax'])->name('items.ajax');
    Route::resource('items', ItemController::class);
    Route::resource('users', UserController::class);
    Route::get('item-mutations/form', [ItemMutationController::class,'form'])->name('item-mutations.form');
    Route::get('item-mutations/{type?}', [ItemMutationController::class,'index'])->name('item-mutations.type');
    Route::get('item-mutations/{type?}/create', [ItemMutationController::class,'create'])->name('item-mutations.type.create');
    Route::get('item-mutations/{type?}/{itemMutation}/edit', [ItemMutationController::class,'edit'])->name('item-mutations.type.edit');
    Route::get('item-mutations/{type?}/{itemMutation}/show', [ItemMutationController::class,'show'])->name('item-mutations.type.show');
    Route::resource('item-mutations', ItemMutationController::class);
    Route::get('report/export',[ReportController::class,'export'])->name('report.export');
    Route::get('report/{type?}',[ReportController::class,'index'])->name('report');

    Route::get('information/{type?}', [InformationController::class,'warehouse'])->name('information');
});





