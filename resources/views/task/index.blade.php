@extends('layouts.root')

@section('header', 'Список задач')

@section('action')
    <a href="{{ route('tasks.create') }}">Создать новую задачу</a>
@endsection

@section('content')
    <table>
        @foreach ($tasks as $task)
            <tr>
                <td>
                    {{Str::limit($task->body, 200)}}
                </td>
                <td>
                    <a href="{{ route('tasks.show', $task) }}">Подробнее</a>
                </td>
            </tr>  
        @endforeach
    </table>

    {{ $tasks->links() }}
@endsection