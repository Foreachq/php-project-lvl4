@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">Статусы</h1>
        <a href="https://php-task-manager-ru.hexlet.app/task_statuses/create" class="btn btn-primary">Создать статус</a>
        <table class="table mt-2">
            <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Дата создания</th>
            </tr>
            </thead>
            <tbody>
            @foreach($statuses as $status)
            <tr>
                <td>{{ $status->id }}</td>
                <td>{{ $status->name }}</td>
                <td>{{ $status->created_at }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
