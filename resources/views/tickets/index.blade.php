<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}" />

<form>
    <input type="email" name="email" />
    <input type="text" name="order_id" />

    <input type="submit" />
</form>

<table class="table tickets">
    <thead>
        <tr>
            <th>Ticket #</th>
            <th>Order #</th>
            <th>Subject</th>
            <th>User e-mail</th>
            <th>Created at</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tickets as $ticket)
            <tr>
                <td>{{ $ticket->ticket_id }}</td>
                <td>{{ $ticket->order_id }}</td>
                <td>{{ $ticket->subject }}</td>
                <td>{{ $ticket->user_email }}</td>
                <td>{{ $ticket->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $tickets->links() }}
