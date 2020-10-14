@extends('layouts.root')

@section('header', 'Просмотр задачи')

@section('action')
    <a href="{{ route('tasks.index') }}">Список задач</a>
    <a href="{{ route('tasks.edit', $task) }}">Редактировать задачу</a>
@endsection

@section('content')
    <h4>{{ $task->body }}</h4>
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
                        {{ Form::open(['url' => route('tasks.points.done', [$task, $point]), 'method' => 'GET']) }}
                            {{ Form::submit('Отметить как выполненная') }}
                        {{ Form::close() }}
                    @endif
                </td>
                <td>
                {{ Form::open(['url' => route('tasks.points.edit', [$task, $point]), 'method' => 'GET']) }}
                    {{ Form::submit('Редактировать') }}
                {{ Form::close() }}
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
        {{ Form::text('body') }}
        {{ Form::submit('Добавить подзадачу') }}
    {{ Form::close() }}
    <br>
    <table>
        @foreach ($task->files as $file)
            <tr>
                <td>
                {{ Form::open(['url' => route('tasks.file.download', $file)]) }}
                    {{ Form::label('name', $file->fileName) }}
                    {{ Form::submit('Скачать') }}
                {{ Form::close() }}
                </td>
                <td>
                {{ Form::open(['url' => route('tasks.file.delete', $file), 'method' => 'DELETE']) }}
                    {{ Form::submit('Удалить') }}
                {{ Form::close() }}
                </td>
            </tr>
        @endforeach
    </table>
    
    {{ Form::open(['url' => route('tasks.file.upload', $task), 'files' => true]) }}
        {{ Form::file('file') }}
        {{ Form::submit('Загрузить') }}
    {{ Form::close() }}
@endsection
