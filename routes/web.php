<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskPointController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::post('/tasks/file/{id}/upload', [TaskController::class, 'file_upload'])
    ->name('tasks.file.upload');

Route::post('/tasks/file/{id}/download', [TaskController::class, 'file_download'])
    ->name('tasks.file.download');

Route::delete('/tasks/files/{id}/delete', [TaskController::class, 'file_delete'])
    ->name('tasks.file.delete');

Route::resource('tasks', TaskController::class);

Route::get('/tasks/{task}/points/{point}/done', [TaskPointController::class, 'done'])
    ->name('tasks.points.done');

Route::resource('tasks.points', TaskPointController::class);
