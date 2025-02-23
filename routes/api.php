<?php

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\InvoicesController;
use App\Http\Controllers\Api\UserController;
use App\Models\Invoices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\Metadata\Uses;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::group(['namespace' => 'App\Http\Controllers\Api'], function () {
    Route::post('/users/signup', [UserController::class, 'register']);
    Route::post('/users/login', [UserController::class, 'login']);

    Route::post('/users/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

});

// {{url}}/api/v1/.....
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api'], function () {
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('invoices', InvoicesController::class);
});
