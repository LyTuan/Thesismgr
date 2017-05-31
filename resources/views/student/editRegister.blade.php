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
        @if($topic_status == 1)
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sửa đề tài</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    {{ Form::open(['route' => 'postTopicEdit', 'method' => 'POST']) }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="id">Tên đề tài</label>
                            <input type="text" class="form-control" id="topic" name="topic" placeholder="Thêm đề tài"
                                   value="{{$topic->name}}">
                        </div>
                        <div class="form-group ">
                            <select name="instructor" class="form-control"  >
                                @foreach($list_instructor as $instructor)
                                    <option value="{{$instructor->id}}">{{ $instructor->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Sửa</button>
                    </div>
                    {{ Form::close() }}

                    <p></p>

                </div>
                <!-- /.box -->
            </div>
        @else
            <div class="col-md-12">
                <div class="box box-primary">
                    <h3>Hết hạn đăng ký</h3>
                </div>
            </div>
        @endif
</div>
@endsection

