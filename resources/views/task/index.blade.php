@extends('layouts.root')

@section('header', 'Список задач')

@section('action')
    <a href="{{ route('tasks.create') }}">Создать новую задачу</a>
@endsection

@section('content')
    @if ($tasks->count() === 0)
        Список задач пуст
    @endif
    <table>
        @foreach ($tasks as $task)
            <tr>
                <td width=400>
                    {{Str::limit($task->body, 200)}}
                </td>
                <td>
                {{ Form::open(['url' => route('tasks.show', $task), 'method' => 'GET']) }}
                    {{ Form::submit('Подробнее') }}
                {{ Form::close() }}
                </td>
                <td>
                {{ Form::open(['url' => route('tasks.edit', $task), 'method' => 'GET']) }}
                    {{ Form::submit('Редактировать') }}
                {{ Form::close() }}
                </td>
                <td>
                {{ Form::open(['url' => route('tasks.destroy', $task), 'method' => 'DELETE']) }}
                    {{ Form::submit('Удалить') }}
                {{ Form::close() }}
                </td>
            </tr>  
        @endforeach
    </table>
    {{ $tasks->links() }}
@endsection