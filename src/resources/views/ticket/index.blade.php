    @extends('layouts.app')

    @section('content')

    <div class="row">
        <div class="col-md-10 offset-1">
            <div class="card card-default">

                <h3 class="card-header">Tickets - Report</h3>


                <div class="card-body">

                    <div class="container">
                        <div class="row justify-content-between mb-20">


                            <div class="col-md-8">

                            </div>
                            <div class="col-md-2 ">
                                <a href="{{ route('tickets.create') }}" class="btn btn-primary btn-md" role="button">Add
                                    Ticket</a>
                            </div>
                        </div>


                        @if($tickets->isEmpty())
                        <p class="text-center">There are no registered tickets yet.</p>
                        @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Ticket #</th>
                                    <th>Order #</th>
                                    <th>Subject</th>
                                    <th>E-mail</th>
                                    <th>Created at</th>
                                    <th></th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tickets as $ticket)
                                <tr>
                                    <td>
                                        {{ $ticket->id }}
                                    </td>
                                    <td>
                                        {{ $ticket->orderId }}
                                    </td>
                                    <td>
                                        {{ $ticket->subject }}
                                    </td>
                                    <td>
                                        {{ $ticket->customer->email }}
                                    </td>
                                    <td>
                                        {{ $ticket->createDate }}
                                    </td>
                                    <td>
                                        <a href="{{action('TicketController@edit',['id'=>$ticket->id])}}"
                                            class="btn btn-primary btn-md" role="button">Edit</a>
                                    </td>
                                    <td>
                                        <a href="{{action('TicketController@show',['id'=>$ticket->id])}}"
                                            class="btn btn-primary btn-md" role="button">Edit</a>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $tickets->render() }}
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

    @endsection