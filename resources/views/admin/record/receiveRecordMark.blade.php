@extends('layout')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Danh sách sinh viên chưa nộp đăng ký bảo vệ đề tài
                </h3><br/><br/>
                @if(Session::has('flash-message'))
                <div class="alert alert-{!!Session::get('flash-level')!!}">
                    {!!Session::get('flash-message')!!}
                </div>
                @endif
                <a href="{{route('resendMailNoti')}}">
                    <button type="button" class="btn btn-primary btn-md">Gửi lại email thông báo</button>
                </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="student" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Mã sinh viên</th>
                        <th>Họ và tên</th>
                        <th>Khóa học</th>
                        <th>Chương trình đào tạo</th>
                        <th>Tên đề tài đăng ký</th>
                        <th>Giáo viên hướng dẫn</th>
                        <th>KHoa id: {{Auth::user()->faculty_id}}</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>

    <div class="modal modal-primary fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Xác nhận sinh viên đã nộp</h4>
                </div>
                {{ Form::open(['route' => 'postRecordCheckDelete', 'method' => 'POST']) }}
                {{ Form::hidden('id', '', ['id' => 'deleteId']) }}
                <div class="modal-body">
                    <p>Xác nhận chắc chắn sinh viên đã nộp hồ sơ đăng ký bảo vệ</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-outline">Xác nhận</button>
                </div>
                {{ Form::close() }}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
@endsection

@section('scripts')
    <!-- DataTables -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('https://cdn.datatables.net/buttons/1.2.3/js/dataTables.buttons.min.js') }}"></script>
    <!-- page script -->
    <script>
        $(function () {
            $('#student').DataTable({
                processing: true,
                serverSide: true,
                "ajax": {
                    "url": "{!! route('apiStudent') !!}",
                    "type": "POST"
                },
                columns: [
                    { data: 'student_id', name: 'student_id'},
                    { data: 'student_name', name: 'student_name' },
                    { data: 'course_name', name: 'course_name' },
                    { data: 'branch_name', name: 'branch_name'},
                    { data: 'topic_name', name: 'topic_name'},
                    { data: 'instructor_name', name: 'instructor_name'},
                    { data: 'action', name: 'action', orderable: false, searchable: false}
                ],
            });
        });

        function deleteModal(id) {
            edit = $("#delete" + id);
            id = edit.parent().parent().children()[0].innerText;
            student_name = edit.parent().parent().children()[1].innerText;

            $("#deleteId").val(id);
            $("#deleteModal").modal();
        }
    </script>
@endsection

@section('stylesheets')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
