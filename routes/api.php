<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/', [UserController::class, 'showDepositBalance']);
    Route::post('/deposit', [TransactionController::class, 'DepositStore']);
    Route::post('/withdrawal', [TransactionController::class, 'WithdrawalStore']);
    Route::get('/withdrawal', [UserController::class, 'showWithdrawalBalance']);
});

Route::get('/hello', function() {
    dd('hello');
});

Route::post('/users',[UserController::class , 'store']);

Route::post('/login',[UserController::class,'login']);
