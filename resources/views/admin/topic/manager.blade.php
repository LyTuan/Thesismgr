@extends('layout')
@section('title','Quản lý đăng ký đề tài')
@section('content')
	@if(Session::has('flash-message'))
		<div class="alert alert-{!!Session::get('flash-level')!!}">
			{!!Session::get('flash-message')!!}
		</div>
	@endif
	<div class="row">
		<div class="col-md-12">
			<a href="{{route('turnOnRegister')}}"><button type="" class="btn btn-primary">Mở đăng ký</button></a>
			<a href="{{route('turnOffRegister')}}"><button type="hidden" class="btn btn-primary">Đóng đăng ký</button></a>
			<a href="{{route('exportWordFile')}}"><button type="hidden" class="btn btn-primary">Xuất đăng ký</button></a>
			<a href="{{route('exportWordFileEditTopic')}}"><button type="hidden" class="btn btn-primary">Xuất DS Chỉnh sửa</button></a>
			<a href="{{route('exportWordFileCancelTopic')}}"><button type="hidden" class="btn btn-primary">Xuất DS Hủy Đề tài</button></a>
			<a href="{{route('sendMailStudentCan')}}"><button type="" class="btn btn-primary">Gửi mail cho sinh viên</button></a>

		</div>


	</div>
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Danh sách đề tài của sinh viên</h3>
				</div>
				<div class="box-body">
					<table class="table">
						<thead>
						<tr>
							<th>STT</th>
							<th>Tên sinh viên</th>
							<th>Tên giảng viên hướng dẫn</th>
							<th>Đề tài</th>
							{{-- <th>Sửa đề tài</th> --}}
							{{-- <th>Hủy đăng ký</th> --}}
						</tr>
						</thead>
						<tbody>
						<?php $id=0;?>
						@foreach($student_array as $student)

							<tr>
								<td><?php echo $id; ?></td>
								<td>{{ $student->name}}</td>
								<td>{{$instructor_array[$id]->name}}</td>
								<td>{{$topic_array[$id]->name}}</td>
								{{-- <td> <a href=""><button type="" class="btn btn-primary">Sửa</button></a> </td> --}}
								{{-- <td><a href=""><button type="" class="btn btn-danger">Hủy</button></a> </td> --}}
							</tr>
							<?php $id++; ?>

						@endforeach
						</tbody>
					</table>
				</div>
			</div>


		</div>
	</div>
@endsection