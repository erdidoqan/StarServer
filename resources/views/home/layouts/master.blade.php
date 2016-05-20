<!DOCTYPE html>
<html lang="en">
    <head>
        @include('home.partials.header')
    </head>

    <body class="hold-transition login-page" style="margin-top: 20px;">

        <div class="page-container">
            @yield('content')
        </div>

        <footer>
            @include('home.partials.footer')
        </footer>

    </body>
</html>