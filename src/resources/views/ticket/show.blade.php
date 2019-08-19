@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-10 offset-1">
        <div class="card card-default">

            <h3 class="card-header">Tickets - #{{ $ticket->id }}</h3>


            <div class="card-body">
                <form class="form" method="post" action="{{url('/ticket/add')}}">
                    {{ csrf_field() }}


                    <div class="container">

                        <div class="form-group">
                            <label>
                                Order #
                            </label>
                            <input type="text" name="orderId" placeholder="" class="form-control col-md-3"  value="{{ $ticket->order->number }}" readonly>
                        </div>

                        <div class="form-group  ">
                            <label>
                                Customer Name
                            </label>
                            <input type="text" name="customerName" placeholder="" class="form-control col-md-6 " value="{{ $ticket->customerName }}"  readonly>
                        </div>
                        <div class="form-group ">
                            <label>
                                Customer E-mail
                            </label>
                            <input type="text" name="customerEmail" placeholder="" class="form-control col-md-6" value="{{ $ticket->order->customer->email }}"  readonly>
                        </div>

                        <div class="form-group">
                            <label>
                                Subject
                            </label>
                            <input type="text" name="subject" placeholder="" class="form-control col-md-6" value="{{ $ticket->subject }}"  readonly>
                        </div>
                        <div class="form-group">
                            <label>
                                Message
                            </label>
                            <textarea type="text" name="message" placeholder="" class="form-control col-md-6" readonly
                                rows="3">{{ $ticket->message }}</textarea>
                        </div>
                        <a href="{{ route('tickets.index') }}" class="btn btn-primary btn-lg  col-lg-2" role="button">Back</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection