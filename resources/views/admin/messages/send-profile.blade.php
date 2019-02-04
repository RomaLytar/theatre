<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<h1>Имя: {{ $name }}</h1>
<h1>E-mail: {{ strip_tags($email) }}</h1>
<h1>Phone: {{ strip_tags($phone) }}</h1>
<h1>File: {{ strip_tags($file) }}</h1>
</body>
</html>