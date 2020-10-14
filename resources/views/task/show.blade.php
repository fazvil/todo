@extends('layouts.root')

@section('header', 'Просмотр задачи')

@section('action')
    <a href="{{ route('tasks.index') }}">Список задач</a>
@endsection

@section('content')
    <b>{{ $task->body }}</b>
    <table>
        @foreach ($points as $point)
            <tr>
                <td width=500>
                    {{Str::limit($point->body, 200)}}
                </td>
                <td>
                    <a href="{{ route('tasks.points.edit', [$task, $point]) }}">Редактировать</a>
                </td>
                <td>
                {{ Form::open(['url' => route('tasks.points.destroy', [$task, $point]), 'method' => 'DELETE']) }}
                    {{ Form::submit('Удалить') }}
                {{ Form::close() }}
                </td>
            </tr>  
        @endforeach
    </table>
    {{ Form::model($new_point, ['url' => route('tasks.points.store', $task)]) }}
        {{ Form::text('body') }}<br>
        {{ Form::submit('Добавить') }}
    {{ Form::close() }}
@endsection
