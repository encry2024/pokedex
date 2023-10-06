<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <script type="text/javascript" defer></script>
    <script type="text/javascript" src="{{ asset('dist/index.js') }}" defer></script>
</head>
<body class="antialiased">
    <div class="container">
        <div id="root"></div>
    </div>
</body>
</html>
