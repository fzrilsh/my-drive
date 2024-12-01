<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'My Drive' }}</title>

        <link rel="stylesheet" href="/build/assets/app.css">
    </head>
    <body>
        <a href="{{ route('dashboard') }}" class="flex justify-center items-center bg-white p-4 shadow-md border-b px-10">
            <img src="{{ asset('imgs/drive.png') }}" alt="Spreadsheet Icon" class="w-6 h-6 mr-2">
            <span class="text-lg font-bold text-gray-800">My Drive - Upload</span>
        </a>

        {{ $slot }}

        <script src="/build/assets/app2.js"></script>
    </body>
</html>
