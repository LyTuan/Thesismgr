@extends('layout')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Thêm bằng file</h3>
                </div>
                {{ Form::open(['route' => 'postStudentAdd', 'files' => true]) }}
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