@extends('layout')
@section('page_title')
    Khoa {{ $faculty_name or '' }}
@endsection
@section('breadcrumb')
    <li><a href="{{ redirect('admin') }}"><i class="fa fa-dashboard"></i>Dash</a></li>
    <li>Instructor</li>
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
                            <th>Mã giảng viên</th>
                            <th>Tên giảng viên</th>
                            <th>Email</th>
                            <th>Đơn vị</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Mã giảng viên</th>
                            <th>Tên giảng viên</th>
                            <th>Email</th>
                            <th>Đơn vị</th>
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
                {{ Form::open(['route' => 'postInstructorAdd', 'method' => 'POST', 'data-parsley-validate' => '']) }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id">Mã giảng viên</label>
                        <input type="text" class="form-control" id="id" name="id" placeholder="Thêm mã giảng viên"
                               value="{{ old('id') }}" data-parsley-required="true">
                        <span class="help-block" id="id-help-block"></span>
                    </div>
                    <div class="form-group">
                        <label for="name">Tên giảng viên</label>
                        <input type="text" class="form-control" id="name" name="name"
                               placeholder="Thêm tên giảng viên" value="{{ old('name')  }}"
                               data-parsley-required="true">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email"
                               placeholder="Thêm email" value="{{  old('email')  }}"
                               data-parsley-required="true">
                    </div>
                    <div class="form-group">
                        <label>Khoa</label>
                        <p>{{ $faculty_name }}</p>
                    </div>
                    <div class="form-group">
                        <label>Đơn vị</label>
                        <select class="form-control" id="unit" name="unit" data-parsley-required="true">
                            <option value="">Chọn Đơn Vị</option>
                            @foreach($units as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
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
                {{ Form::open(['route' => 'postInstructorAdd', 'files' => true]) }}
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
                {{ Form::open(['route' => 'postAdminInstructorEdit', 'method' => 'POST']) }}
                {{ Form::hidden('id', '', ['id' => 'editId']) }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Tên giảng viên</label>
                        <input type="text" class="form-control" id="editName" name="name"
                               placeholder="Thêm tên giảng viên" value="{{ old('name')  }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="editEmail" name="email"
                               placeholder="Thêm email" value="{{  old('email')  }}">
                    </div>
                    <div class="form-group">
                        <label>Đơn vị</label>
                        <select class="form-control" id="unit" name="unit">
                            <option value="">Chọn Đơn Vị</option>
                            @foreach($units as $unit)
                                <option id="{{ 'u'.$unit->id }}" value="{{ $unit->id }}">{{ $unit->name }}</option>
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
                {{ Form::open(['route' => 'postInstructorDelete', 'method' => 'POST']) }}
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
                    "url": "{!! route('apiInstructor') !!}",
                    "type": "POST"
                },
                columns: [
                    { data: 'id', name: 'id'},
                    { data: 'name', name: 'name'},
                    { data: 'email', name: 'email'},
                    { data: 'unitName', name: 'unitName' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });

        function editModal(parent_id, id) {
            edit = $("#edit" + id);
            name = edit.parent().parent().children()[1].innerText;
            email = edit.parent().parent().children()[2].innerText;

            $("#editName").val(name);
            $("#editEmail").val(email);
            $("#editId").val(id);
            $("#u" + parent_id).attr('selected','selected');
            $("#editModal").modal();
        }

        function deleteModal(id) {
            edit = $("#delete" + id);
            id = edit.parent().parent().children()[0].innerText;
            facultyName = edit.parent().parent().children()[1].innerText;
            unitName = edit.parent().parent().children()[2].innerText;

            $("#deleteId").val(id);
            $("#deleteModal").modal();
        }
    </script>
@endsection

@section('stylesheets')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
@endsection