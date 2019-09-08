@if($errors->any())
   @foreach ($errors->all() as $error)
      <div>{{ $error }}</div>
  @endforeach
@endif

<form method="post" action="{{ action('TicketsController@store') }}">
    @csrf

    <input type="text" name="name" value="{{ old('name') }}" />
    <input type="text" name="email" value="{{ old('email') }}" />
    <input type="text" name="order" value="{{ old('order') }}" />
    <input type="text" name="subject" value="{{ old('subject') }}" />
    <textarea name="body">{{ old('body') }}</textarea>
    <input type="submit" />
</form>
