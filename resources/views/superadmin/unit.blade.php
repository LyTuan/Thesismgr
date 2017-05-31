@extends('layout')
@section('page_title', 'Quản lý danh mục đơn vị')
@section('breadcrumb')
    <li><a href="{{ route('getSuperAdminDash') }}"><i class="fa fa-dashboard"></i>Dash</a></li>
    <li>Unit</li>
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
                    <table id="unit" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Mã đơn vị</th>
                            <th>Tên khoa</th>
                            <th>Tên đơn vị</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Mã đơn vị</th>
                            <th>Tên khoa</th>
                            <th>Tên đơn vị</th>
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
                    {{ Form::open(['route' => 'postUnitAdd', 'method' => 'POST']) }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="faculty">Tên khoa</label>
                            <select class="form-control" id="faculty" name="faculty">
                                <option value="">Chọn Khoa</option>
                                @foreach($faculties as $faculty)
                                    <option value="{{ $faculty['id'] }}"
                                            @if($faculty['id'] == old('faculty'))
                                            selected = "selected"
                                            @endif
                                    >{{ $faculty['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="unit">Tên đơn vị</label>
                            <input type="text" class="form-control" id="unit" name="unit" placeholder="Thêm tên đơn vị">
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
                    {{ Form::open(['route' => 'postUnitEdit', 'method' => 'POST']) }}
                    {{ Form::hidden('id', '', ['id' => 'editId']) }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="faculty">Tên khoa</label>
                            <select class="form-control" id="faculty" name="faculty">
                                <option value="">Chọn Khoa</option>
                                @foreach($faculties as $faculty)
                                    <option id="{{ 'f'.$faculty['id'] }}" value="{{ $faculty['id'] }}"
                                    >{{ $faculty['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="unit">Tên đơn vị</label>
                            <input type="text" class="form-control" id="editUnitName" name="unit" placeholder="Thêm tên đơn vị">
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
                    {{ Form::open(['route' => 'postUnitDelete', 'method' => 'POST']) }}
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
            $('#unit').DataTable({
                processing: true,
                serverSide: true,
                "ajax": {
                    "url": "{!! route('apiUnit') !!}",
                    "type": "POST"
                },
                columns: [
                    { data: 'id', name: 'id'},
                    { data: 'facultyName', name: 'facultyName' },
                    { data: 'unitName', name: 'unitName' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });

        function editModal(parent_id, id) {
            edit = $("#edit" + id);
            id = edit.parent().parent().children()[0].innerText;
            facultyName = edit.parent().parent().children()[1].innerText;
            unitName = edit.parent().parent().children()[2].innerText;

            $("#editUnitName").val(unitName);
            $("#editId").val(id);
            $("#f" + parent_id).attr('selected','selected');
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