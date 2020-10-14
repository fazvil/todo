<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\File;
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
        $files = $task->files;
        foreach ($files as $file) {
            $this->file_delete($file->id);
        }
        $task->delete();

        return redirect()->route('tasks.index');
    }

    public function file_upload(Request $request, $task_id)
    {
        if (!$request->hasFile('file')) {
            return redirect()->back();
        }
        $fileName = $request->file('file')->getClientOriginalName();
        $pathToFile = $request->file('file')->storeAs('uploads', $fileName);
        $task = Task::find($task_id);
        $file = $task->files()->make();
        $file->fileName = $fileName;
        $file->pathToFile = $pathToFile;
        $file->save();
        return redirect()->back();
    }

    public function file_download($file_id)
    {
        $file = File::find($file_id);
        return Storage::download($file->pathToFile);
        //Storage::setVisibility($path, 'public');
        //$v = Storage::getVisibility($path);
    }

    public function file_delete($file_id)
    {
        $file = File::find($file_id);
        Storage::delete($file->pathToFile);
        $file->delete();
        return redirect()->back();
    }
}
