    @extends('layouts.app')

    @section('content')

    <div class="row">
        <div class="col-md-10 offset-1">
            <div class="card card-default">

                <h3 class="card-header">Tickets - Report</h3>


                <div class="card-body">

                    <div class="container">
                        <div class="row justify-content-between mb-20">


                            <div class="col-md-10">
                                <form class="form-inline" action="{{ route('tickets.filter') }}" method="POST">
                                    {!! csrf_field() !!}
                                    <div class="form-row col-md-12">
                                        <label class="mr-20  col-md-1"> Email: </label>
                                        <div class="form-group col-md-3">
                                            <input type="text" name="customerEmail" class="form-control" placeholder="E-mail" value="@if(isset($filterData)){{$filterData->customerEmail}}@endif">
                                        </div>
                                        <label class="mr-20 col-md-1"> Order #: </label>
                                        <div class="form-group col-md-3">

                                            <input type="text" name="orderNumber" class="form-control" value="@if(isset($filterData)){{$filterData->orderNumber}}@endif"   placeholder="Order #">
                                        </div>

                                        <div class="form-group col-md-2">
                                            <input type="submit" class="btn btn-primary btn-md" value="Search">
                                        </div>
                                    </div>
                                </form>
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
                                        {{ $ticket->order->number }}
                                    </td>
                                    <td>
                                        {{ $ticket->subject }}
                                    </td>
                                    <td>
                                        {{ $ticket->order->customer->email }}
                                    </td>
                                    <td>
                                        {{ $ticket->created_at->format('Y-m-d') }}
                                    </td>
                                    <td>
                                        <a href="{{action('TicketController@show',['id'=>$ticket->id])}}"
                                            class="btn btn-primary btn-sm" role="button">See</a>
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