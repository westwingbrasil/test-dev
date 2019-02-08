<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script>
            window.Laravel = {!! json_encode([
                'apiBaseUri' => env('API_BASE_URI'),
                'locale' => \App::getLocale()
            ]) !!};
        </script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div id="app">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light"></nav>
                    <br>
                    <west-app></west-app>
                </div>
            </div>
        </div>
    </body>
    <script src="{{ asset('js/app.js') }}"></script>
</html>
