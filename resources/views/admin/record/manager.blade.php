@extends('layout')
@section('content')
	{{--@if(Session::has('flash-message'))--}}
		{{--<div class="alert alert-{!!Session::get('flash-level')!!}">--}}
			{{--{!!Session::get('flash-message')!!}--}}
		{{--</div>--}}
	{{--@endif--}}

	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Quản lý việc nộp</h3>
				</div>
				<div class="box-body">
					@if($stt)
						<h1 class="lead "> Đang trong thời gian nộp hồ sơ bảo vệ</h1>
					@else
						<h1 class="lead"> Đã hết thời gian nộp hồ sơ bảo vệ</h1>
					@endif
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
					<a href="{{route('turnOnRecordRegister')}}"><button type="" class="btn btn-primary">Mở nộp và chỉnh sửa hồ sơ bảo vệ</button></a>
					<a href="{{route('sendMailStudentHasTopic')}}"><button type="" class="btn btn-primary">Gửi mail nhắc nhở sinh viên nộp hồ sơ bảo vệ</button></a>
					<a href="{{route('turnOffRecordRegister')}}"><button type="hidden" class="btn btn-primary">Kết thúc hạn nộp </button></a>
				</div>
			</div>
		</div>
	</div>
@endsection

