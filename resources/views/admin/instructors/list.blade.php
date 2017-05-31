@extends('layout')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Giảng viên</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="instructor" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Mã giảng viên</th>
                        <th>Tên giảng viên</th>
                        <th>Đơn vị</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Mã giảng viên</th>
                        <th>Tên giảng viên</th>
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
    <!-- /.col -->
</div>
@endsection

@section('scripts')
    <!-- DataTables -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <!-- page script -->
    <script>
        $(function () {
            $('#instructor').DataTable({
                processing: true,
                serverSide: true,
                "ajax": {
                    "url": "{!! route('apiInstructor') !!}",
                    "type": "POST"
                },
                columns: [
                    { data: 'id', name: '.id'},
                    { data: 'name', name: 'name' },
                    { data: 'unit_name', name: 'unit_name' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });
    </script>
@endsection

@section('stylesheets')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
@endsection