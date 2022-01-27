<?php

use App\Http\Controllers\API\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/searchCustomer', [CustomerController::class, 'searchCustomer']);
Route::post('/cari', [CustomerController::class, 'cari']);
Route::post('pagination', [CustomerController::class , 'nexthalaman']);
Route::resource('/customers', CustomerController::class)->except(['create', 'edit']);