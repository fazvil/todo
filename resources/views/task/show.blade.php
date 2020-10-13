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
                <td>
                    {{Str::limit($point->body, 200)}}
                </td>
                <td>
                    <a data="{{ $point->body }}" name="edit" href="">Редактировать</a>
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

    <script>
    $(() => {
        $("a[name='edit']").click(function() {
            const data = $(this).attr('data');
            
        });
    });
    </script>
@endsection
