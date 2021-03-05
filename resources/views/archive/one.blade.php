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
    <h2>Проверка</h2>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ip:port</th>
            <th scope="col">Тип</th>
            <th scope="col">Локация</th>
            <th scope="col">Статус</th>
            <th scope="col">Таймаут</th>
            <th scope="col">Реальный ip</th>
            <th scope="col">Время проверки</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($proxy_checks as $proxy)
            <tr>
                <td>{{$proxy->proxy}}</td>
                <td>{{$proxy->type}}</td>
                <td>{{$proxy->location}}</td>
                <td>{{$proxy->status}}</td>
                <td>{{$proxy->timeout}} мс</td>
                <td>{{$proxy->real_ip}}</td>
                <td>{{$proxy->time_checked}} мс</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
