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
    <a href="/archive" type="button" class="btn btn-outline-primary">Архив</a>
    <div class="row"><br></div>
    <h1>Проверка прокси</h1>
    <form method="post" action="">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Прокси в формате ip:port</label>
            <textarea class="form-control" name="proxy" id="exampleFormControlTextarea1" rows="5"></textarea>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Список прокси файлом</label>
            <input class="form-control" type="file" id="formFile">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Проверить</button>
        </div>
    </form>

</div>
</body>
</html>
