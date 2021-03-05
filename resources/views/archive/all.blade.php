<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h2>Архив проверок</h2>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Дата и время проверки</th>
            <th scope="col">Количество проксей</th>
            <th scope="col">Количество живых прокси</th>
            <th scope="col">Время проверки</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($checks as $check)
            <tr>
                <td>{{$check->date_time}}</td>
                <td>{{$check->count_proxy_checks}}</td>
                <td>{{$check->count_working_proxy}}</td>
                <td>{{$check->time}} мс</td>
                <td><a href="/archive/{{$check->id}}">Подробней</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
