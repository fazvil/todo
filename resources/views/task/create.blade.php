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

@section('header', 'Создание задачи')

@section('action')
    <a href="{{ route('tasks.index') }}">Список задач</a>
@endsection

@section('content')
{{ Form::model($task, ['url' => route('tasks.store')]) }}
    {{ Form::label('name', 'Содержимое') }}
    {{ Form::text('body') }}<br>

    {{ Form::submit('Создать') }}
{{ Form::close() }}
@endsection
