@extends('layouts.root')

@section('header', 'Создать задачу')

@section('action')
@endsection

@section('content')
{{ Form::model($task, ['url' => route('tasks.store')]) }}
    {{ Form::label('name', 'Содержимое') }}
    {{ Form::text('body') }}<br>
    {{ Form::submit('Создать') }}
{{ Form::close() }}
@endsection
