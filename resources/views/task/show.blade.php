@extends('layouts.root')

@section('header', 'Просмотр задачи')

@section('action')
    <a href="{{ route('tasks.index') }}">Список задач</a>
@endsection

@section('content')
    <b>{{ $task->body }}</b>

    <table>
        <tr id="add_point">
            <td>
            {{ Form::model($point, ['url' => route('tasks.points.store', $task)]) }}
                {{ Form::text('body') }}<br>
                {{ Form::submit('Добавить') }}
            {{ Form::close() }}
            </td>
        </tr>
    </table>

    <script>
    $(() => {
        $.get("{{ route('tasks.points.index', $task) }}", function(data) {
            data.forEach((point) => {
                const tr = document.createElement('tr');
                const td = document.createElement('td');
                td.innerText = point.body;
                tr.appendChild(td);
                $('#add_point').before(tr);
            });
        });
    });
    </script>
@endsection
