@extends('layouts.root')

@section('header', 'Просмотр задачи')

@section('action')
    <a href="{{ route('tasks.index') }}">Список задач</a>
@endsection

@section('content')
    <b>{{ $task->body }}</b><br>
    <br>
    <table>
        @foreach ($points as $point)
            <tr>
                <td width=400>
                    {{Str::limit($point->body, 200)}}
                </td>
                <td>
                    @if ($point->done)
                        |DONE|
                    @else
                    <a href="{{ route('tasks.points.done', [$task, $point]) }}">Отметить как выполненная</a>
                    @endif
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
        {{ Form::submit('Добавить подзадачу') }}
    {{ Form::close() }}
@endsection
