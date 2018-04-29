@extends('admin.layout.master')
@section('css')
	{!! Charts::styles() !!}
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
				{!! $chart->html() !!}
			</div> 
		</div>
	</div>
@endsection

@section('script')
    {!! Charts::scripts() !!}
    {!! $chart->script() !!}
@endsection
