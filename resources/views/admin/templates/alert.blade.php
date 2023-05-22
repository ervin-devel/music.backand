@if($errors->any())
    <div class="alert alert-danger" role="alert">
        @foreach($errors->all() AS $error)
            {{ $error }}<br/>
        @endforeach
    </div>
@endif
@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif



