<html>
    <head>
        <title>Customer support - @yield('title')</title>

        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}" />
    </head>
    <body>
        @include('includes.navigation')

        <main>
            @yield('content')
        </main>
    </body>
</html>
