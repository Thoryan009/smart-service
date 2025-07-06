<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

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

Route::middleware(['auth:sanctum', 'role:admin '])->group(function(){
   Route::get('/admin-only', function(){
     return response()->json(['message' => 'Admin login only']);
   });
});