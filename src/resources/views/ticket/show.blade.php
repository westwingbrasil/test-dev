@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-10 offset-1">
        <div class="card card-default">

            <h3 class="card-header">Tickets - Add</h3>


            <div class="card-body">
                <form class="form" method="post" action="{{url('/ticket/add')}}">
                    {{ csrf_field() }}


                    <div class="container">

                        <div class="form-group">
                            <label>
                                Order #
                            </label>
                            <input type="text" name="orderId" placeholder="" class="form-control col-md-3" required>
                        </div>

                        <div class="form-group  ">
                            <label>
                                Customer Name
                            </label>
                            <input type="text" name="customerName" placeholder="" class="form-control col-md-6 " required>
                        </div>
                        <div class="form-group ">
                            <label>
                                Customer E-mail
                            </label>
                            <input type="text" name="customerEmail" placeholder="" class="form-control col-md-6" required>
                        </div>

                        <div class="form-group">
                            <label>
                                Subject
                            </label>
                            <input type="text" name="subject" placeholder="" class="form-control col-md-6" required>
                        </div>
                        <div class="form-group">
                            <label>
                                Message
                            </label>
                            <textarea type="text" name="message" placeholder="" class="form-control col-md-6" required
                                rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Save" class="btn btn-success btn-lg  col-md-2">
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection