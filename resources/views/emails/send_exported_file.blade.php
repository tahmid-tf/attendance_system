<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div>
    <p>Attached is the attendance report file</p>

    @component('mail::button', ['url' => url('/')])
        Visit our website
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}

</div>
</body>
</html>

