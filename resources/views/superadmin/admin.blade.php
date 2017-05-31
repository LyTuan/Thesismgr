@extends('layout')
@section('page_title', 'Quản lý tài khoản admin')
@section('breadcrumb')
    <li><a href="{{ route('getSuperAdminDash') }}"><i class="fa fa-dashboard"></i>Dash</a></li>
    <li>Admin</li>
@endsection
@section('content')
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Danh sách quản trị &nbsp;
                    <button type="button" class="btn btn-primary btn-md" data-target="#addModal" data-toggle="modal">Thêm bản ghi</button>
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Mã tài khoản</th>
                        <th>Email</th>
                        <th>Tên đăng nhập</th>
                        <th>Khoa</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Mã tài khoản</th>
                        <th>Email</th>
                        <th>Tên đăng nhập</th>
                        <th>Khoa</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <div class="modal modal-primary fade" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Thêm bản ghi</h4>
                </div>
                {{ Form::open(['route' => 'postAdminAdd', 'method' => 'POST']) }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Thêm email">
                    </div>
                    <div class="form-group">
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Thêm tên đăng nhập">
                    </div>
                    <label for="faculty">Tên khoa</label>
                    <select class="form-control" id="faculty" name="faculty">
                        <option value="">Chọn Khoa</option>
                        @foreach($faculties as $faculty)
                            <option value="{{ $faculty['id'] }}"
                            >{{ $faculty['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-outline">Thêm</button>
                </div>
                {{ Form::close() }}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal modal-primary fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Sửa bản ghi</h4>
                </div>
                {{ Form::open(['route' => 'postAdminEdit', 'method' => 'POST']) }}
                {{ Form::hidden('id', '', ['id' => 'editId']) }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="editEmail" name="email" placeholder="Thêm email">
                    </div>
                    <div class="form-group">
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" class="form-control" id="editUsername" name="username" placeholder="Thêm tên đăng nhập">
                    </div>
                    <div class="form-group">
                        <label for="password">Thay mật khẩu</label>
                        <input type="text" class="form-control" id="password" name="password" placeholder="Thêm mật khẩu">
                    </div>
                    <label for="faculty">Tên khoa</label>
                    <select class="form-control" id="faculty" name="faculty">
                        <option value="">Chọn Khoa</option>
                        @foreach($faculties as $faculty)
                            <option id="{{ 'f'.$faculty['id'] }}" value="{{ $faculty['id'] }}"
                            >{{ $faculty['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-outline">Lưu</button>
                </div>
                {{ Form::close() }}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal modal-danger fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Xoá bản ghi</h4>
                </div>
                {{ Form::open(['route' => 'postAdminDelete', 'method' => 'POST']) }}
                {{ Form::hidden('id', '', ['id' => 'deleteId']) }}
                <div class="modal-body">
                    <p>Bản ghi đã xóa không thể hoàn lại. Vẫn tiếp tục</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-outline">Xóa</button>
                </div>
                {{ Form::close() }}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                "ajax": {
                    "url": "{!! route('apiAdmin') !!}",
                    "type": "POST"
                },
                columns: [
                    { data: 'id', name: 'id'},
                    { data: 'email', name: 'email' },
                    { data: 'username', name: 'username' },
                    { data: 'faculty_name', name: 'faculty_name' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });

        function editModal(faculty_id, id) {
            edit = $("#edit" + id);
            email = edit.parent().parent().children()[1].innerText;
            username = edit.parent().parent().children()[2].innerText;

            $("#editId").val(id);
            $("#f" + faculty_id).attr('selected','selected');
            $("#editEmail").val(email);
            $("#editUsername").val(username);

            $("#editModal").modal();
        }

        function deleteModal(id) {
            edit = $("#delete" + id);
            id = edit.parent().parent().children()[0].innerText;

            $("#deleteId").val(id);
            $("#deleteModal").modal();
        }
    </script>
@endsection

@section('stylesheets')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
@endsection