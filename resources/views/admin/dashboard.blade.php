@extends('admin.layout.master')
@section('css')
	{!! Charts::styles() !!}
<style>
	.rank-image{
		border: 1px solid #E9ECEF;
	}
</style>
@endsection

@section('content')
	<div class="container">
		<div>
	      <ol class="breadcrumb">
	        <li class="breadcrumb-item">
	          <a href="{{route('admin.dashboard')}}">Trình quản trị</a>
	        </li>
	        <li class="breadcrumb-item active">Tổng quan</li>
	      </ol>
	    </div>

		<div class="row">
			<div class="col-xl-6 col-sm-6 mb-3">
				<div class="card o-hidden h-100">
		            <div class="card-body text-white bg-primary">
		              <div class="card-body-icon">
		                <i class="fa fa-fw fa-book"></i>
		              </div>
		              <div class="mr-5"><h3>{{$storyCount}} truyện</h3></div>
		              <div class="mr-5">{{$chapterCount}} chương</div>
		            </div>
		            <a class="card-footer clearfix small z-1" href="{{route('admin.story.index')}}">
		              <span class="float-left">Xem thêm</span>
		              <span class="float-right">
		                <i class="fa fa-angle-right"></i>
		              </span>
		            </a>
		        </div>
	    	</div>

	    	<div class="col-xl-6 col-sm-6 mb-3">
				<div class="card o-hidden h-100">
		            <div class="card-body text-white bg-success">
		              <div class="card-body-icon">
		                <i class="fa fa-fw fa-user"></i>
		              </div>
		              <div class="mr-5"><h3>{{$authorCount}} tác giả</h3></div>
		              <div class="mr-5">{{$totalStoryView}} lượt đọc</div>
		            </div>
		            <a class="card-footer clearfix small z-1" href="{{route('admin.author.index')}}">
		              <span class="float-left">Xem thêm</span>
		              <span class="float-right">
		                <i class="fa fa-angle-right"></i>
		              </span>
		            </a>
		        </div>
	    	</div>
		</div>

		<div class="card my-4">
			<div class="card-header"><i class="fa fa-bar-chart"></i> Chương truyện được cập nhật gần nhất</div>
			<div class="card-body">
				{!! $uploadChapterchart->html() !!}
			</div> 
		</div>

		<div class="row my-5">
			{{-- day --}}
			<div class="col-4">
				<h3 class="p-2 pb-3 font-weight-bold" style="border-bottom: 3px solid #F4645F">Top Ngày</h3>
				<ul class="list-unstyled">
					@foreach($topDayViewStories as $topDay)
						<li class="row p-2 border-bottom">
							<div class="col-2 d-flex align-items-center">
								@if($topDay->image)
									<img src="upload/{{$topDay->image}}" alt="" width="100%" class="rank-image">
								@else
									<img src="no_image_vertical.png" alt="" width="100%" class="rank-image">
								@endif
							</div>
							<div class="col-10 d-flex">
								<div class="p-2" style="white-space:nowrap; text-overflow: ellipsis; overflow:hidden">
									<div class="font-weight-bold">
										{{$topDay->name}}
									</div>
									
									<div class="text-muted">
										Số chương: {{$topDay->chapter->count()}}
									</div>
								</div>
								<div class="text-info ml-auto p-2 align-self-center" data-toggle="tooltip" title="{{$topDay->view}}" style="white-space:nowrap; text-overflow: ellipsis; overflow:hidden">
									<i class="fa fa-fw fa-eye"></i>{{$topDay->view}}
								</div>
							</div>
						</li>
					@endforeach
				</ul>
			</div>
			
			{{-- week --}}
			<div class="col-4 border-right border-left">
				<h3 class="p-2 pb-3 font-weight-bold" style="border-bottom: 3px solid #F4645F">Top Tuần</h3>
				<ul class="list-unstyled">
					@foreach($topWeekViewStories as $topWeek)
						<li class="row p-2 border-bottom">
							<div class="col-2 d-flex align-items-center">
								@if($topWeek->image)
									<img src="upload/{{$topWeek->image}}" alt="" width="100%" class="rank-image">
								@else
									<img src="no_image_vertical.png" alt="" width="100%" class="rank-image">
								@endif
							</div>
							<div class="col-10 d-flex">
								<div class="p-2" style="white-space:nowrap; text-overflow: ellipsis; overflow:hidden">
									<div class="font-weight-bold">
										{{$topWeek->name}}
									</div>
									
									<div class="text-muted">
										Số chương: {{$topWeek->chapter->count()}}
									</div>
								</div>
								<div class="text-info ml-auto p-2 align-self-center" data-toggle="tooltip" title="{{$topWeek->view}}" style="white-space:nowrap; text-overflow: ellipsis; overflow:hidden">
									<i class="fa fa-fw fa-eye"></i>{{$topWeek->view}}
								</div>
							</div>
						</li>
					@endforeach
				</ul>
			</div>

			{{-- month --}}
			<div class="col-4">
				<h3 class="p-2 pb-3 font-weight-bold" style="border-bottom: 3px solid #F4645F">Top Tháng</h3>
				<ul class="list-unstyled">
					@foreach($topMonthViewStories as $topMonth)
						<li class="row p-2 border-bottom">
							<div class="col-2 d-flex align-items-center">
								@if($topMonth->image)
									<img src="upload/{{$topMonth->image}}" alt="" width="100%" class="rank-image">
								@else
									<img src="no_image_vertical.png" alt="" width="100%" class="rank-image">
								@endif
							</div>
							<div class="col-10 d-flex">
								<div class="p-2" style="white-space:nowrap; text-overflow: ellipsis; overflow:hidden">
									<div class="font-weight-bold">
										{{$topMonth->name}}
									</div>
									
									<div class="text-muted">
										Số chương: {{$topMonth->chapter->count()}}
									</div>
								</div>
								<div class="text-info ml-auto p-2 align-self-center" data-toggle="tooltip" title="{{$topMonth->view}}" style="white-space:nowrap; text-overflow: ellipsis; overflow:hidden">
									<i class="fa fa-fw fa-eye"></i>{{$topMonth->view}}
								</div>
							</div>
						</li>
					@endforeach
				</ul>
			</div>
		</div>

	</div>
@endsection

@section('script')
    {!! Charts::scripts() !!}
    {!! $uploadChapterchart->script() !!}
@endsection
