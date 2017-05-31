@extends('layout')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="form-group">
                        <label for="name">Tên giảng viên</label>
                        <p>{{  $instructor->name == '' || null ? "Chưa cập nhật" : $instructor->name  }}</p>
                    </div>
                    <div class="form-group">
                        <label for="academic_title">Học hàm</label>
                        <p>{{  $instructor->academic_title == '' || null ? "Chưa cập nhật" : $instructor->academic_title  }}</p>
                    </div>
                    <div class="form-group">
                        <label for="degree">Học vị</label>
                        <p>{{  $instructor->degree == '' || null ? "Chưa cập nhật" : $instructor->degree  }}</p>
                    </div>
                    <div class="form-group">
                        <label for="scope">Lĩnh vực</label>
                        <ul>
                            @foreach($instructor->scopes as $scope)
                                <li>{{ $scope->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="research_domain">Hướng nghiên cứu</label>
                        <pre>{{  $instructor->research_domain == '' || null ? "Chưa cập nhật" : $instructor->research_domain  }}</pre>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection