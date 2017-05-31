@extends('layout')
@section('content')
    <div class="row">
        <!-- left column -->
        {{-- @if($status_on_off==true) --}}
         @if(Session::has('flash-message'))
                <div class="alert alert-{!!Session::get("flash-level")!!}">
                    {!!Session::get('flash-message')!!}
                </div>
        @endif
        <div class="col-md-12">
            <!-- general form elements -->
            <table class="table">
            <thead>   
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Last Name</th>
              <th>Username</th>
              <th>Option</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>Otto</td>
              <td>@mdo</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Jacob</td>
              <td>Thornton</td>
              <td>@fat</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>Larry</td>
              <td>the Bird</td>
              <td>@twitter</td>
            </tr>
          </tbody>
        </table>
         
            <!-- /.box -->
        </div>
        
        
@endsection