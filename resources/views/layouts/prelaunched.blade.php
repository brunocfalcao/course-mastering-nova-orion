<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap');
    </style>
    @vite('resources/css/app.css')
</head>

<body class="antialiased">
    @yield('content')

    <!-- Scripts -->
    @yield('scripts')
</body>

</html>
