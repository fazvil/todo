<?php

use Illuminate\Support\Facades\Route;
use App\Models\Task;
use App\Models\TaskPoint;
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

Route::resource('/tasks', 'App\Http\Controllers\TaskController');

//Route::delete('/tasks/{task}/points/{point}', 'App\Http\Controllers\TaskPointController\ArticleController@destroy')
//  ->name('tasks.points.destroy');

Route::delete('/tasks/{task_id}/points/{point_id}', function ($task_id, $point_id) {
    $task = Task::find($task_id);
    $point = TaskPoint::find($point_id);
    $point->delete();
    return redirect()->route('tasks.show', $task);
})->name('tasks.points.destroy');


Route::resource('/tasks.points', 'App\Http\Controllers\TaskPointController');