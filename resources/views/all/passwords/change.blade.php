@extends('layout')
@section('content')
<div class="row">
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Đổi mật khẩu</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {{ Form::open(['route' => 'postInstructorPasswordChange', 'method' => 'POST']) }}
            <div class="box-body">
                <div class="form-group">
                    <label for="username">Tên đăng nhập</label>
                    <input type="text" class="form-control" id="username" name="username"
                           value="{{ Auth::user()->username }}" disabled="disabled">
                </div>
                <div class="form-group">
                    <label for="oldpass">Mật khẩu cũ</label>
                    <input type="password" class="form-control" id="oldpass" name="oldpass"
                           placeholder="Điền mật khẩu cũ">
                </div>
                <div class="form-group">
                    <label for="newpass">Mật khẩu mới</label>
                    <input type="password" class="form-control" id="newpass" name="newpass"
                           placeholder="Điền mật khẩu mới">
                </div>
                <div class="form-group">
                    <label for="repass">Nhập lại mật khẩu mới</label>
                    <input type="password" class="form-control" id="repass" name="repass"
                           placeholder="Điền lại mật khẩu mới">
                    <span class="help-block" id="repass-help-block"></span>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Xác Nhận</button>
            </div>
            {{ Form::close() }}
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection