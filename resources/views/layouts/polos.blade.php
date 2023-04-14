<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="author" content="vernandaspw" />

        <link rel="shortcut icon" href="{{ asset('img/logo/gl-bg-none.png') }}" type="image/x-icon">
        <title>GoLapang - Login</title>
        <link rel="stylesheet" href="{{ asset('bootstrap530/css/bootstrap.min.css') }}">
        <link href="{{ asset('sbadmin/css/styles.css') }}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        @livewireStyles
    </head>
    <body class="bg-success">
        @yield('content')

        @livewireScripts
        <script src="{{ asset('bootstrap530/js/bootstrap.bundle.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('sbadmin/js/scripts.js') }}"></script>
    </body>
</html>
