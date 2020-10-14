<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\File;
use App\Models\TaskPoint;
use App\Http\Controllers\TaskPointController;
use Illuminate\Support\Facades\Storage;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::post('/tasks/file/{id}/upload', 'App\Http\Controllers\TaskController@file_upload')
    ->name('tasks.file.upload');

Route::post('/tasks/file/{id}/download', 'App\Http\Controllers\TaskController@file_download')
    ->name('tasks.file.download');

Route::delete('/tasks/files/{id}/delete', 'App\Http\Controllers\TaskController@file_delete')
    ->name('tasks.file.delete');

Route::resource('/tasks', 'App\Http\Controllers\TaskController');

Route::delete('/tasks/{task_id}/points/{point_id}', function ($task_id, $point_id) {
    $task = Task::find($task_id);
    $point = TaskPoint::find($point_id);
    $point->delete();
    return redirect()->route('tasks.show', $task);
})->name('tasks.points.destroy');

Route::get('/tasks/{task_id}/points/{point_id}/edit', function ($task_id, $point_id) {
    $task = Task::find($task_id);
    $point = TaskPoint::find($point_id);
    return view('task_point.edit', compact('task', 'point'));
})->name('tasks.points.edit');

Route::patch('/tasks/{task_id}/points/{point_id}', function (Request $request, $task_id, $point_id) {
    $task = Task::find($task_id);
    $point = TaskPoint::find($point_id);

    $point->body = $request->input('body');
    $point->save();
    return redirect()
        ->route('tasks.show', $task);
})->name('tasks.points.update');

Route::get('/tasks/{task_id}/points/{point_id}/done', function ($task_id, $point_id) {
    $task = Task::find($task_id);
    $point = TaskPoint::find($point_id);
    $point->done = true;
    $point->save();
    return redirect()
        ->route('tasks.show', $task);
})->name('tasks.points.done');

Route::resource('/tasks.points', 'App\Http\Controllers\TaskPointController');

Route::get('tasks/downdload/{id}', 'App\Http\Controllers\TaskController@download')
    ->name('tasks.download');
