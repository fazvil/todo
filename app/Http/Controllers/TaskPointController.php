<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskPoint;
use Illuminate\Http\Request;

class TaskPointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function index(Task $task)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function create(Task $task)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Task $task)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @param  \App\Models\TaskPoint  $taskPoint
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task, TaskPoint $taskPoint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @param  \App\Models\TaskPoint  $taskPoint
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task, TaskPoint $taskPoint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @param  \App\Models\TaskPoint  $taskPoint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task, TaskPoint $taskPoint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @param  \App\Models\TaskPoint  $taskPoint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task, TaskPoint $taskPoint)
    {
        //
    }
}
