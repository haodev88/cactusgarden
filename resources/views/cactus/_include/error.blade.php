@if (count($errors) > 0)
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{!! $error !!}</li>
        @endforeach
    </ul>
@endif

@if(Session::has('Error'))
    <div class="alert alert-danger">
        {!! Session::get('Error') !!}
    </div>
@endif
