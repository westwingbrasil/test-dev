@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <detail-component :id="{{ $id }}"></detail-component>
    </div>
</div>
@endsection
