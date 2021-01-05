<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;

Route::get('/ping',function(){
    return [
        'pong'=> true
    ];
});

Route::get('/unauthenticated', function(){
    return ['error' => 'Usuário não logado.'];
})->name('login');

Route::middleware('auth:sanctum')->post('/todo',[ApiController::class,'createTodo']);
Route::get('/todos',[ApiController::class,'readAllTodos']);
Route::get('/todo/{id}',[ApiController::class,'readTodo']);
Route::put('/todo/{id}',[ApiController::class,'updateTodo']);
Route::delete('/todo/{id}',[ApiController::class,'deleteTodo']);

Route::post('/user',[AuthController::class,'create']);
Route::post('/auth',[AuthController::class, 'login']);
