@extends('layout')
@section('page_title')
    Khoa {{ $faculty_name or '' }}
@endsection
@section('breadcrumb')
    <li><a href="{{ redirect('admin') }}"><i class="fa fa-dashboard"></i>Dash</a></li>
    <li>Course</li>
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Danh sách đơn vị &nbsp;
                        <button type="button" class="btn btn-primary btn-md" data-target="#addModal" data-toggle="modal">Thêm bản ghi</button>
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Năm</th>
                            <th>Mã khóa học</th>
                            <th>Tên</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Năm</th>
                            <th>Mã khóa học</th>
                            <th>Tên</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <div class="modal modal-primary fade" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Thêm bản ghi</h4>
                </div>
                {{ Form::open(['route' => 'superadmin.postCourseAdd', 'method' => 'POST']) }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="year">Năm</label>
                        <input type="text" class="form-control" id="year" name="year"
                               placeholder="Thêm năm">
                    </div>
                    <div class="form-group">
                        <label for="name">Mã khóa học</label>
                        <input type="text" class="form-control" id="name" name="name"
                               placeholder="Thêm mã khóa học">
                    </div>
                    <div class="form-group">
                        <label for="alias">Tên</label>
                        <input type="text" class="form-control" id="alias" name="alias"
                               placeholder="Thêm tên">
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
                {{ Form::open(['route' => 'superadmin.postCourseEdit', 'method' => 'POST']) }}
                {{ Form::hidden('id', '', ['id' => 'editId']) }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Mã khóa học</label>
                        <input type="text" class="form-control" id="editName" name="name"
                               placeholder="Thêm mã khóa học">
                    </div>
                    <div class="form-group">
                        <label for="alias">Tên</label>
                        <input type="text" class="form-control" id="editAlias" name="alias"
                               placeholder="Thêm tên">
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
                {{ Form::open(['route' => 'superadmin.postCourseDelete', 'method' => 'POST']) }}
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
    <script src="{{ asset('dist/js/parsley.min.js') }}"></script>
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
                    "url": "{!! route('superadmin.apiCourse') !!}",
                    "type": "POST"
                },
                columns: [
                    { data: 'year', name: 'year'},
                    { data: 'name', name: 'name'},
                    { data: 'alias', name: 'alias'},
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });

        function editModal(id) {
            edit = $("#edit" + id);
            name = edit.parent().parent().children()[1].innerText;
            alias = edit.parent().parent().children()[2].innerText;

            $("#editYear").val(id);
            $("#editName").val(name);
            $("#editAlias").val(alias);
            $("#editId").val(id);
            $("#editModal").modal();
        }

        function deleteModal(id) {
            edit = $("#delete" + id);

            $("#deleteId").val(id);
            $("#deleteModal").modal();
        }
    </script>
@endsection

@section('stylesheets')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
@endsection