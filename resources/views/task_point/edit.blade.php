@extends('layouts.root')

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@section('header', 'Редактирование подзадачи')

@section('action')
    <a href="{{ route('tasks.points.index', $task) }}">Назад к задаче</a>
@endsection

@section('content')
{{ Form::model($point, ['url' => route('tasks.points.update', [$task, $point]), 'method' => 'PATCH']) }}
    {{ Form::label('name', 'Содержимое') }}
    {{ Form::text('body') }}<br>
    {{ Form::submit('Обновить') }}
{{ Form::close() }}
@endsection
