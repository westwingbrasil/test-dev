<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Test</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .nav-item{
                padding: 0 10px;

            }
        </style>
    </head>
    <body>
        <header class="navbar bg-info text-light">
            <a class="navbar-brand mr-0 mr-md-2 mt-2 text-light" href="/" aria-label="Tickets">
                Tickets
            </a>
            <div class="navbar-nav-scroll">
                <ul class="navbar-nav bd-navbar-nav flex-row">
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('tickets.create') }}">Cadastrar tickets</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('tickets.index') }}">Lista de tickets</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('tickets.report') }}">Relatório de tickets</a>
                    </li>
                    
                </ul>
            </div>
        </header>
        <div class="container">
              
            @if ($message = Session::get('success'))
                <div class="alert alert-success text-center">
                    <p>{{ $message }}</p>
                </div>
            @endif
            @if ($message = Session::get('error'))
                <div class="alert alert-danger text-center">
                    <p>{{ $message }}</p>
                </div>
            @endif
            @yield('content')
        </div>
        
        <footer class="bd-footer text-muted bg-light mt-4">
            <div class="container-fluid p-md-4">
                <p>Teste de desenvolvimento</p>
            </div>
        </footer>
    </body>
</html>