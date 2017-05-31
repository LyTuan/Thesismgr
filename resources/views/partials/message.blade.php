@if(Session::has('success'))
    <div class="alert alert-success">
        <h4><i class="icon fa fa-check"></i> Thành công!</h4>
        {{ Session::get('success') }}.
    </div>
@endif

@if(count($errors) > 0)
    <div class="alert alert-danger">
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif