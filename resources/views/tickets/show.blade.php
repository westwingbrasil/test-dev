<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}" />

<nav class="nav">
    <a class="nav-link" href="{{ action('TicketsController@index') }}">All tickets</a>
</nav>

<main>
    <table class="table table-sm table-borderless ticket-details">
        <tbody>
            <tr>
                <th scope="row">Ticket #</th>
                <td>{{ $ticket->ticket_id }}</td>
            </tr>
            <tr>
                <th scope="row">Order #</th>
                <td>{{ $ticket->order_id }}</td>
            </tr>
            <tr>
                <th scope="row">Created at</th>
                <td>{{ $ticket->created_at }}</td>
            </tr>
            <tr>
                <th scope="row">User</th>
                <td>{{ $ticket->user_name }}</td>
            </tr>
            <tr>
                <th scope="row">E-mail</th>
                <td>{{ $ticket->user_email }}</td>
            </tr>
            <tr>
                <th scope="row">Subject</th>
                <td>{{ $ticket->subject }}</td>
            </tr>
            <tr>
                <th scope="row">Body</th>
                <td>{{ $ticket->body }}</td>
            </tr>
        </tbody>
</main>
