<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'My Drive' }}</title>

        <link rel="stylesheet" href="/build/assets/app.css">
    </head>
    <body>

        {{ $slot }}

        <script src="/build/assets/app2.js"></script>
    </body>
</html>
