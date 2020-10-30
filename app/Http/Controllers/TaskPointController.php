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
        return $task->points;
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
        $data = $this->validate($request, [
            'body' => 'required',
        ]);
        
        $point = $task->points()->make();
        $point->fill($data);
        $point->save();
        
        return redirect()
            ->route('tasks.show', $task);
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
    public function edit(Task $task, TaskPoint $point)
    {
        return view('task_point.edit', compact('task', 'point'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @param  \App\Models\TaskPoint  $taskPoint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task, TaskPoint $point)
    {
        $point->body = $request->input('body');
        $point->save();
        return redirect()->route('tasks.show', $task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @param  \App\Models\TaskPoint  $taskPoint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task, TaskPoint $point)
    {
        $point->delete();
        return redirect()->route('tasks.show', $task);
    }

    public function done(Task $task, TaskPoint $point)
    {
        $point->done = true;
        $point->save();
        return redirect()->back();
    }
}
