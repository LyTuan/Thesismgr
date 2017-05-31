@extends('layout')
@section('page_title', 'Quản lý danh mục khoa')
@section('breadcrumb')
    <li><a href="{{ route('getSuperAdminDash') }}"><i class="fa fa-dashboard"></i>Dash</a></li>
    <li>Faculty</li>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Danh sách khoa &nbsp;
                    <button type="button" class="btn btn-primary btn-md" data-target="#addModal" data-toggle="modal">Thêm bản ghi</button>
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="faculty" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Mã khoa</th>
                        <th>Tên khoa</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Mã khoa</th>
                        <th>Tên khoa</th>
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
                {{ Form::open(['route' => 'postFacultyAdd', 'method' => 'POST']) }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="faculty">Tên khoa</label>
                        <input type="text" class="form-control" id="faculty" name="faculty" placeholder="Thêm tên khoa">
                    </div>
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
                {{ Form::open(['route' => 'postFacultyEdit', 'method' => 'POST']) }}
                {{ Form::hidden('id', '', ['id' => 'editId']) }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="faculty">Tên khoa</label>
                        <input id="editName" type="text" class="form-control" name="faculty" placeholder="Thêm tên khoa">
                    </div>
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
                {{ Form::open(['route' => 'postFacultyDelete', 'method' => 'POST']) }}
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
            $('#faculty').DataTable({
                processing: true,
                serverSide: true,
                "ajax": {
                    "url": "{!! route('apiFaculty') !!}",
                    "type": "POST"
                },
                columns: [
                    { data: 'id', name: 'id'},
                    { data: 'name', name: 'name' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
            });
        });

        function editModal(id) {
            edit = $("#edit" + id);
            id = edit.parent().parent().children()[0].innerText;
            facultyName = edit.parent().parent().children()[1].innerText;

            $("#editName").val(facultyName);
            $("#editId").val(id);
            $("#editModal").modal();
        }

        function deleteModal(id) {
            edit = $("#delete" + id);
            id = edit.parent().parent().children()[0].innerText;
            facultyName = edit.parent().parent().children()[1].innerText;

            $("#deleteId").val(id);
            $("#deleteModal").modal();
        }
    </script>
@endsection

@section('stylesheets')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
@endsection