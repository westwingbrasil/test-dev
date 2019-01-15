@extends('layouts.app')

@section('content')
<div class="container">
    @if ($msg)
    <div class="row justify-content-center">
      <div class="col-auto">
        <div class="alert alert-{{ $type }}" role="alert">
          {{ $msg }}
        </div>
      </div>
    </div>
    @endif
    <div class="row justify-content-center">
      <register-component url="{{ url('/salvarTicket') }}"></register-component>
    </div>
</div>
@endsection
