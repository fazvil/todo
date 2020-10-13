@extends('layouts.root')

@section('header', 'Список задач')

@section('action')
    <a href="{{ route('tasks.create') }}">Создать новую задачу</a>
@endsection

@section('content')
    @foreach ($tasks as $task)    
        <div>{{Str::limit($task->body, 200)}}</div>
    @endforeach
    {{ $tasks->links() }}
@endsection