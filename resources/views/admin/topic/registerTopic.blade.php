@extends('layout')
@section('title','Đăng ký đề tài')
@section('content')
    <div class="row">
        <!-- left column -->
        {{-- @if($status_on_off==true) --}}
         @if(Session::has('flash-message'))
                <div class="alert alert-{!!Session::get("flash-level")!!}">
                    {!!Session::get('flash-message')!!}
                </div>
        @endif
        @if($topic_status == 1)
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Thêm danh sách Đề tài</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {{ Form::open(['route' => 'postTopic', 'method' => 'POST']) }}
                <div class="box-body">
                    <div class="form-group">
                        <label for="id">Tên đề tài</label>
                        <input type="text" class="form-control" id="topic" name="topic" placeholder="Thêm đề tài"
                               value="{{ old('id') }}">
                    </div>
                      <div class="form-group ">
                        <select name="instructor" class="form-control"  >
                             @foreach($list_instructor as $instructor)
                                <option value="{{$instructor->id}}">{{ $instructor->name}}</option>
                            @endforeach
                        </select>
                      </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
                {{ Form::close() }}
               
                    <p></p>
                
            </div>
            <!-- /.box -->
        </div>
        @else
        <div class="col-md-12">
            <div class="box box-primary">
                <h3>Hết hạn đăng ký</h3>
            </div>
        </div>
        @endif
        
        
@endsection

@section('scripts')
    <script>
        $('div.alert').delay(3000).slideUp();
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
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
                        $(this).remove();0
                    }
                });
                // ajax
                $.ajax({
                    type: 'POST',
                    url: '{{ route('postUnitByFaculty') }}',
                    data: {
                        id: $(this).val()
                    },
                    success:function(data){
                        for(i = 0; i < data.length; i++) {
                            $("#unit").append("<option value ='" + data[i].id + "' >" + data[i].name + "</option>");
                        }
                    }
                });
            });
        });
    </script>
@endsection
@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
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
                // ajax
                $.ajax({
                    type: 'POST',
                    url: '{{ route('postUnitByFaculty') }}',
                    data: {
                        id: $(this).val()
                    },
                    success:function(data){
                        for(i = 0; i < data.length; i++) {
                            $("#unit").append("<option value ='" + data[i].id + "' >" + data[i].name + "</option>");
                        }
                    }
                });
            });
        });
    </script>
   
@endsection