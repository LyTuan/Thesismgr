@extends('layout')
@section('page_title')
    Khoa {{ $faculty_name or '' }}
@endsection
@section('breadcrumb')
    <li><a href="{{ route('student.scopes.index') }}"><i class="fa fa-dashboard"></i>Dash</a></li>
    <li>Search</li>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách giảng viên</h3>
                </div>
                <div class="box-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Tên giảng viên</th>
                            <th>Đơn vị</th>
                            <th>Hướng nghiên cứu</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Tên giảng viên</th>
                            <th>Đơn vị</th>
                            <th>Hướng nghiên cứu</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- DataTables -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <!-- page script -->
    <script>
        $(function () {
            var table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{!! route('student.search.apiInstructor') !!}",
                    "type": "POST",
                    "data": function (d) {
                        d.scope_id = $('#scope_id').val();
                    }
                },
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'unit_name', name: 'unit_name' },
                    { data: 'research_domain', name: 'research_domain' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                initComplete: function () {
                    this.api().columns().every(function () {
                        var column = this;
                        var input = document.createElement("input");
                        $(input).appendTo($(column.footer()).empty())
                                .on('change', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                    });
                }
            });
        });
    </script>
@endsection

@section('stylesheets')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
@endsection