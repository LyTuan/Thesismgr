@extends('layout')
@section('page_title')
    Khoa {{ $faculty_name or '' }}
@endsection
@section('breadcrumb')
    <li><a href="{{ route('student.scopes.index') }}"><i class="fa fa-dashboard"></i>Dash</a></li>
    <li>Unit</li>
@endsection
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Lĩnh vực</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    @php
                        $count = 0;
                    @endphp
                    @foreach($tree as $parent)
                        <div class="panel box box-primary">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="{!! "#collapse".$count !!}" aria-expanded="false" class="collapsed">
                                        {!! $parent["name"] !!}
                                    </a>
                                </h4>
                            </div>
                            <div id="{!! "collapse".$count !!}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                <div class="box-body">
                                    @php
                                        $children = $parent["children"];
                                    @endphp
                                    @foreach($children as $child)
                                        <button type="button" id="{{ $child['id'] }}">{{ $child['name'] }}</button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @php
                            $count++;
                        @endphp
                    @endforeach
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
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
                        <th>Tên giảng viên</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                {{ Form::hidden('scope_id', '', ['id' => 'scope_id']) }}
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
                    "url": "{!! route('student.scopes.apiInstructor') !!}",
                    "type": "POST",
                    "data": function (d) {
                        d.scope_id = $('#scope_id').val();
                    }
                },
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            $('button').click(function () {
                $('#scope_id').val($(this).attr('id'));
                table.ajax.reload();
            });
        });
    </script>
@endsection

@section('stylesheets')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
@endsection