@extends('layout')
@section('title','Thêm sinh viên đủ điều kiện')
@section('content')
    <div class="row">
        {{-- Notification for user --}}
        <div class="col-md-12">
         @if(Session::has('flash-message'))
            <div class="alert alert-{!!Session::get('flash-level')!!}">
                    {!!Session::get('flash-message')!!}
            </div>
        @endif
        </div>

        <!-- left column -->
        <div class="col-md-6">

            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Thêm thủ công</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {{ Form::open(['route' => 'postStudentCanAdd', 'method' => 'POST']) }}
                <div class="box-body">
                    <div class="form-group">
                        <label for="id">Mã sinh viên</label>
                        <input type="text" class="form-control" id="id" name="id" placeholder="Thêm mã sinh viên"
                               value="{{ old('id') }}">
                    </div>
                    
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
                {{ Form::close() }}
            </div>
            <!-- /.box -->
        </div>
        <div class="col-md-6">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Thêm bằng file</h3>
                </div>
                {{ Form::open(['route' => 'postStudentCanAdd', 'files' => true]) }}
                {{ Form::hidden('byFile', 'true') }}
                <div class="box-body">
                    <div class="form-group">
                        <label for="file">Định dạng hỗ trợ: xls, xlsx</label>
                        <input id="file" name="file" type="file">
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
