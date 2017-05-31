@extends('layout')
@section('page_title')
    Khoa {{ $faculty_name or '' }}
@endsection
@section('breadcrumb')
    <li><a href="{{ redirect('admin') }}"><i class="fa fa-dashboard"></i>Dash</a></li>
    <li>Student</li>
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Danh sách đơn vị &nbsp;
                        <button type="button" class="btn btn-primary btn-md" data-target="#addModal" data-toggle="modal">Thêm thủ công</button>
                        <button type="button" class="btn btn-primary btn-md" data-target="#addModalByFile" data-toggle="modal">Thêm bằng file</button>
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Mã sinh viên</th>
                            <th>Tên sinh viên</th>
                            <th>Email</th>
                            <th>Khóa</th>
                            <th>Chương trình đào tạo</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Mã sinh viên</th>
                            <th>Tên sinh viên</th>
                            <th>Email</th>
                            <th>Khóa</th>
                            <th>Chương trình đào tạo</th>
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
                {{ Form::open(['route' => 'postStudentAdd', 'method' => 'POST', 'name' => 'addForm']) }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id">Mã sinh viên</label>
                        <input type="text" class="form-control" id="id" name="id" placeholder="Thêm mã sinh viên">
                    </div>
                    <div class="form-group">
                        <label for="name">Tên sinh viên</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Thêm tên sinh viên">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Thêm email">
                    </div>
                    <div class="form-group">
                        <label>Tên khoa</label>
                        <p>{{ $faculty_name }}</p>
                    </div>
                    <div class="form-group">
                        <label for="course">Khóa học</label>
                        <select class="form-control" id="course" name="course">
                            <option value="">Chọn Khóa học</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->year }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="branch">Ngành học</label>
                        <select class="form-control" id="branch" name="branch">
                            <option value="">Chọn Ngành học</option>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endforeach
                        </select>
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
    <div class="modal modal-primary fade" id="addModalByFile">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Thêm bản ghi</h4>
                </div>
                {{ Form::open(['route' => 'postStudentAdd', 'files' => true]) }}
                {{ Form::hidden('byFile', 'true') }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file">Định dạng hỗ trợ: xls, xlsx</label>
                        <input id="file" name="file" type="file">
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
                {{ Form::open(['route' => 'postStudentEdit', 'method' => 'POST']) }}
                {{ Form::hidden('id', '', ['id' => 'editId']) }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Tên sinh viên</label>
                        <input type="text" class="form-control" id="editName" name="name" placeholder="Thêm tên sinh viên">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="editEmail" name="email" placeholder="Thêm email">
                    </div>
                    <div class="form-group">
                        <label>Tên khoa</label>
                        <p>{{ $faculty_name }}</p>
                    </div>
                    <div class="form-group">
                        <label for="editCourse">Khóa học</label>
                        <select class="form-control" id="editCourse" name="course">
                            <option value="">Chọn Khóa học</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->year }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editBranch">Ngành học</label>
                        <select class="form-control" id="editBranch" name="branch">
                            <option value="">Chọn Ngành học</option>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endforeach
                        </select>
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
                {{ Form::open(['route' => 'postStudentDelete', 'method' => 'POST']) }}
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
                    "url": "{!! route('admin.apiStudent') !!}",
                    "type": "POST"
                },
                columns: [
                    { data: 'id', name: 'id'},
                    { data: 'name', name: 'name'},
                    { data: 'email', name: 'email'},
                    { data: 'courseName', name: 'courseName' },
                    { data: 'branchName', name: 'branchName' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });

        function editModal(id) {
            edit = $("#edit" + id);
            name = edit.parent().parent().children()[1].innerText;
            email = edit.parent().parent().children()[2].innerText;
            course = edit.parent().parent().children()[3].innerText;
            branch = edit.parent().parent().children()[4].innerText;

            console.log(course);

            $("#editName").val(name);
            $("#editEmail").val(email);
            $("#editId").val(id);

            $("#editCourse option").each(function () {
                if($(this).html() == course) {
                    $(this).attr("selected", "selected");
                }
            });

            $("#editBranch option").each(function () {
                if($(this).html() == branch) {
                    $(this).attr("selected", "selected");
                }
            });

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