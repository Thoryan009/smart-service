<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ServiceCategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');





Route::prefix('auth')->group(function (){

    //public
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);


    // Protected (need token)
    Route::middleware('auth:sanctum')->group(function (){
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });


});

Route::middleware(['auth:sanctum', 'role:admin'])->group(function(){
   Route::get('/admin-only', function(){
     return response()->json(['message' => 'Admin login only']);
   });
});

Route::middleware(['auth:sanctum', 'role:customer'])->group(function() {
    Route::get('/customer-only', function () {
        return response()->json(['message' => 'This is a customer.']);
    });
});

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/all', [ServiceCategoryController::class, 'index'])->name('category.all');
    Route::post('/store', [ServiceCategoryController::class, 'store'])->name('category.store');
    Route::get('/show/{id}', [ServiceCategoryController::class, 'show'])->name('category.show');
    Route::post('/update/{id}', [ServiceCategoryController::class, 'update'])->name('category.update');
    Route::get('/destroy/{id}', [ServiceCategoryController::class, 'destroy'])->name('category.destroy');
});