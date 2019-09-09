<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}" />

@include('includes.navigation')

<main>
    <form>
        <div class="form-row">
            <div class="form-group col">
                <label for="email">E-mail</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" />
            </div>

            <div class="form-group col">
                <label for="email">Order #</label>
                <input type="text" name="order_id" class="form-control" value="{{ old('order_id') }}" />
            </div>

            <input type="submit" style="display: none;" />
        </div>
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
                    <td>
                        <a href="{{ route('tickets.show', $ticket->ticket_id) }}">{{ $ticket->ticket_id }}</a>
                    </td>
                    <td>{{ $ticket->order_id }}</td>
                    <td>{{ $ticket->subject }}</td>
                    <td>{{ $ticket->user_email }}</td>
                    <td>{{ $ticket->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $tickets->links() }}

</main>
