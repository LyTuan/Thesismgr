@extends('layout')
@section('page_title')
    Khoa {{ $faculty_name or '' }}
@endsection
@section('breadcrumb')
    <li><a href="{{ route('student.units.index') }}"><i class="fa fa-dashboard"></i>Dash</a></li>
    <li>Unit</li>
@endsection
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Danh sách đơn vị</h3>
            </div>
            <div class="box-body">
                <ul>
                    @foreach($units as $unit)
                        <li><button type="button" id="{{ $unit->id }}">{{ $unit->name }}</button></li>
                    @endforeach
                </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                {{ Form::hidden('unit_id', '', ['id' => 'unit_id']) }}
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Danh sách giảng viên</h3>
            </div>
            <div class="box-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        {{--<th></th>--}}
                        <th>Tên giảng viên</th>
                        <th>Action</th>
                    </tr>
                    </thead>
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
    <script src="{{ asset('js/handlebars-v4.0.5.js') }}"></script>
    <!-- page script -->
    <script>
        $(function () {
            var template = Handlebars.compile($("#details-template").html());

            var table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{!! route('student.units.apiInstructor') !!}",
                    "type": "POST",
                    "data": function (d) {
                        d.unit_id = $('#unit_id').val();
                    }
                },
                columns: [
//                    {
//                        "className":      'details-control',
//                        "orderable":      false,
//                        "searchable":     false,
//                        "data":           null,
//                        "defaultContent": ''
//                    },
                    { data: 'name', name: 'name' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                "order": [[1, 'asc']]
            });

//            // Add event listener for opening and closing details
//            $('#table tbody').on('click', 'td.details-control', function () {
//                var tr = $(this).closest('tr');
//                var row = table.row( tr );
//                console.log(tr);
//
//                if ( row.child.isShown() ) {
//                    // This row is already open - close it
//                    row.child.hide();
//                    tr.removeClass('shown');
//                }
//                else {
//                    // Open this row
//                    row.child( template(row.data()) ).show();
//                    tr.addClass('shown');
//                }
//            });
//
            // button for reload datatable with new unit_id
            $('button').click(function () {
                $('#unit_id').val($(this).attr('id'));
                table.ajax.reload();
            });
        });
    </script>

    <script id="details-template" type="text/x-handlebars-template">
        <table class="table">
            <tr>
                <td>Full name:</td>
                <td>@{{ name }}</td>
            </tr>
            <tr>
                <td>Extra info:</td>
                <td>And any further details here (images etc)...</td>
            </tr>
        </table>
    </script>
@endsection

@section('stylesheets')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
@endsection