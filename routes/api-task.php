<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TaskController;

Route::get('/tasks', [TaskController::class, 'index']);
Route::post('/add-task', [TaskController::class, 'store']);
Route::delete('/delete-task/{id}', [TaskController::class, 'destroy']);
Route::get('/edit-task/{id}', [TaskController::class, 'edit']);
Route::put('/update-task/{id}', [TaskController::class, 'update']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
