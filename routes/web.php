<?php

use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\categoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/dashboard', function () {
 //  return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

//Route::get('/dashboard', [DashboardController::class,'index'])->middleware('auth')->name('dashboard');

Route::group([
   'middleware' => 'auth',
    'prefix' => 'dashboard',
    'as'=> 'dashboard.'
], function(){
    Route::get('/', [DashboardController::class,'index'])->name('home');
    Route::get('/table', [DashboardController::class,'table'])->name('table');

    //Route::get('/categories',[categoryController::class,'index'])->name('categories.index');

    Route::resource('categories',categoryController::class);
    Route::resource('products',ProductController::class);


});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
