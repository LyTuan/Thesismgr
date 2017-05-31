@extends('layout')
@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Lịch phân công bảo vệ</h3>
				</div>
				<div class="box-body">
					<div class="col-md-12">
						<a href="{{route('assignReview_export')}}"><button type="" class="btn btn-primary">Tạo lịch phân công bảo vệ</button></a>
					</div>
				</div>
				<!-- /.box-body -->

			</div>
		</div>
	</div>
@endsection
