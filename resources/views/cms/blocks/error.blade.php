@if (count($errors) > 0)
    <ul class="error_msg">
        @foreach ($errors->all() as $error)
            <li>{!! $error !!}</li>
        @endforeach
    </ul>
@endif

@if(Session::has('Error'))
    <p class="bg-danger">{!! Session::get('Error') !!}</p>
@endif