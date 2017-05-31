@extends('layout')
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Thêm thủ công</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {{ Form::open(['route' => 'postInstructorAdd', 'method' => 'POST']) }}
                <div class="box-body">
                    <div class="form-group">
                        <label for="id">Mã giảng viên</label>
                        <input type="text" class="form-control" id="id" name="id" placeholder="Thêm mã giảng viên"
                               value="{{ old('id') }}">
                        <span class="help-block" id="id-help-block"></span>
                    </div>
                    <div class="form-group">
                        <label for="name">Tên giảng viên</label>
                        <input type="text" class="form-control" id="name" name="name"
                               placeholder="Thêm tên giảng viên" value="{{ old('name')  }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email"
                               placeholder="Thêm email" value="{{  old('email')  }}">
                    </div>
                    <div class="form-group">
                        <label>Khoa</label>
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
                        <label>Đơn vị</label>
                        <select class="form-control" id="unit" name="unit">
                            <option value="">Chọn Đơn Vị</option>
                            {{--@foreach($units as $unit)--}}
                                {{--<option value="{{ $unit['id'] }}">{{ $unit['name'] }}</option>--}}
                            {{--@endforeach--}}
                        </select>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
                {{ Form::close() }}
            </div>
            <!-- /.box -->
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Thêm bằng file</h3>
                </div>
                {{ Form::open(['route' => 'postInstructorAdd', 'files' => true]) }}
                {{ Form::hidden('byFile', 'true') }}
                <div class="box-body">
                    <div class="form-group">
                        <label for="file">Định dạng hỗ trợ: xls, xlsx</label>
                        <input id="file" name="file" type="file">
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            idCheck();
            // ajax
            $.ajax({
                type: 'POST',
                url: '{{ route('postUnitByFaculty') }}',
                data: {
                    id: $("#faculty").val()
                },
                success:function(data){
                    for(i = 0; i < data.length; i++) {
                        $("#unit").append("<option value ='" + data[i].id + "' >" + data[i].name + "</option>");
                    }
                    $("#unit option").each(function () {
                        if($(this).val() == "{{old('unit')}}") {
                            $(this).attr('selected', 'selected');
                        }
                    });
                }
            });
            $("#faculty").change(function () {
                //delete all old option
                $("#unit option").each(function () {
                    if($(this).val() != "") {
                        $(this).remove();
                    }
                });
                unitCheck();
            });
            // id ajax
            var timer;
            $("#id").keyup(function (e) {
                clearTimeout(timer);  //clear any running timeout on key up
                timer = setTimeout(function() {
                    idCheck();
                }, 100);
            });

            function unitCheck() {
                // ajax
                $.ajax({
                    type: 'POST',
                    url: '{{ route('postUnitByFaculty') }}',
                    data: {
                        id: $("#faculty").val()
                    },
                    success:function(data){
                        for(i = 0; i < data.length; i++) {
                            $("#unit").append("<option value ='" + data[i].id + "' >" + data[i].name + "</option>");
                        }
                    }
                });
            }

            function idCheck() {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('postIdCheck') }}',
                    data: {
                        id: $("#id").val()
                    },
                    success:function(data){
                        if(data.exist == "true") {
                            $("#id-help-block").html("Mã giảng viên đã tồn tại");
                            $("#id-help-block").parent().attr("class", "form-group has-error");
                        } else {
                            $("#id-help-block").html("");
                            $("#id-help-block").parent().attr("class", "form-group");
                        }
                    }
                });
            }
        });
    </script>
@endsection