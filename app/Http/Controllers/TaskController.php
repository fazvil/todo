<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TaskPoint;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::where('creator_id', Auth::id())
            ->orderBy('created_at')    
            ->paginate();
        return view('task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task = new Task();
        return view('task.create', compact('task'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {              
        $data = $this->validate($request, [
            'body' => 'required',
        ]);
        $task = User::find(Auth::id())->tasks()->make();
        $task->fill($data);
        if ($request->hasFile('file')) {
            //$pathToFile = $request->file('file')->store('uploads');
            $fileName = $request->file('file')->getClientOriginalName();
            $pathToFile = $request->file('file')->storeAs(
                'uploads',
                $fileName
            );
            $task->fileName = $fileName;
            $task->pathToFile = $pathToFile;
        }
        $task->save();
        
        return redirect()
            ->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $new_point = $task->points()->make();
        $points = TaskPoint::where('task_id', $task->id)
            ->orderBy('created_at')
            ->get();

        
        return view('task.show', compact('task', 'new_point', 'points'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('task.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $data = $this->validate($request, [
            'body' => 'required'
        ]);

        $task->fill($data);
        $task->save();
        return redirect()
            ->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->points()->delete();
        $task->delete();

        return redirect()->route('tasks.index');
    }

    public function download($id)
    {
        $task = Task::find($id);
        return Storage::download($task->pathToFile);
        //Storage::setVisibility($path, 'public');
        //$v = Storage::getVisibility($path);
        //Storage::delete($path);
    }
}
