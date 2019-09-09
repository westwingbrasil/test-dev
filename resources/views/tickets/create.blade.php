<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}" />

@include('includes.navigation')

<main>
    @if(Session::has('alert-success'))
        <div class="alert alert-success">
            {{ Session::get('alert-success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul class="my-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ action('TicketsController@store') }}">
        @csrf

        <div class="form-row">
            <div class="form-group col">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" required value="{{ old('name') }}" />
            </div>

            <div class="form-group col">
                <label for="email">E-mail</label>
                <input type="email" name="email" class="form-control" required value="{{ old('email') }}" />
            </div>

            <div class="form-group col-3">
                <label for="order">Order #</label>
                <input type="text" name="order" class="form-control" required value="{{ old('order') }}" />
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col">
                <label for="subject">Subject</label>
                <input type="text" name="subject" class="form-control" required value="{{ old('subject') }}" />
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col">
                <label for="body">Body</label>
                <textarea name="body" class="form-control" required>{{ old('body') }}</textarea>
            </div>
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-primary">Create ticket</button>
        </div>
    </form>
</main>
