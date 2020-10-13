@extends('layouts.root')

@section('header', 'Просмотр задачи')

@section('action')
    <a href="{{ route('tasks.index') }}">Список задач</a>
@endsection

@section('content')
    <b>{{ $task->body }}</b>

    <table id="points"></table>

    <script>
    $(() => {
        $.get("{{ route('tasks.points.index', $task) }}", function(data) {
            data.forEach((point) => {
                const tr = document.createElement('tr');
                const td = document.createElement('td');
                td.innerText = point.body;
                tr.appendChild(td);

                $('#points').append(tr);
            });
        });
    });
    </script>
@endsection
