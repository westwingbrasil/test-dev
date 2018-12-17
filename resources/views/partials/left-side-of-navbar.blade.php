<ul class="navbar-nav mr-auto">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
           aria-haspopup="true" aria-expanded="false">Clientes</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ url('/clients/new') }}">Cadastrar</a>
            <a class="dropdown-item" href="{{ url('/clients') }}">Listar</a>
        </div>
    </li>

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
           aria-haspopup="true" aria-expanded="false">Tickets</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ url('/tickets/new') }}">Cadastrar</a>
            <a class="dropdown-item" href="{{ url('/tickets') }}">Listar</a>
        </div>
    </li>
</ul>