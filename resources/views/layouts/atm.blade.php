<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/atm/style.css')}}">
    <link href="{{ asset('node_modules/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    @yield('css')
    <link rel="icon" href="{{asset('img/atm.png')}}">
    <title>ATM - @yield('title')</title>
</head>

<body>
    <div class="insert h-100 d-flex flex-column align-items-center justify-content-center">
        @yield('content')
    </div>

    @yield('after_content')

    <script src="{{ asset('node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script>
        AOS.init();
    </script>
    <script src="https://kit.fontawesome.com/e4374ef880.js" crossorigin="anonymous"></script>
    @yield('js')
</body>
</html>
