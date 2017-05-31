@extends('layout')
@section('content')
<div class="row">
    {{ Form::open(['route' => 'postInstructorProfile', 'method' => 'POST']) }}
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Chỉnh sửa thông tin</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                <div class="form-group">
                    <label for="name">Tên giảng viên</label>
                    <input type="text" class="form-control" id="name" name="name"
                           placeholder="Thêm tên" value="{{ $instructor->name  }}">
                </div>
                <div class="form-group">
                    <label for="academic_title">Học hàm</label>
                    <input type="text" class="form-control" id="academic_title" name="academic_title"
                           placeholder="Thêm học hàm" value="{{  $instructor->academic_title  }}">
                </div>
                <div class="form-group">
                    <label for="degree">Học vị</label>
                    <input type="text" class="form-control" id="degree" name="degree"
                           placeholder="Thêm học vị" value="{{  $instructor->degree  }}">
                </div>
                <div class="form-group">
                    <label for="research_domain">Hướng nghiên cứu</label>
                    <textarea class="form-control" rows="3" id="research_domain" name="research_domain">{{ $instructor->research_domain }}</textarea>
                </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </div>
        <!-- /.box -->
        </div>
    </div>
    <div class="col-md-6">
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
                                    <input id="{{ 'scope'.$child['id'] }}" type="checkbox" name="scopes[]" value="{{ $child['id'] }}">{!! " ".$child['name']."<br/>" !!}
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
    {{ Form::close() }}
</div>
@endsection

@section('scripts')
    <script>
        @foreach($scopes as $scope)
            $('{{ "#scope".$scope->id }}').prop("checked", true);
        @endforeach
    </script>
@endsection