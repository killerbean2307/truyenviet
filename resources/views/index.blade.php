@extends('layout.master')

@section('css')
<style>
	.newchap-list-story-name a{
		color: 	#8B572A;
		font-weight: 900;
	}
	
	/* .newchap-list-story-name .badge{
		overflow: hidden;
		text-overflow: ellipsis;
	} */

	.full-story-item-name{
		color: #8B572A!important;
	}

	.full-story-item-name:hover{
		color: #F5A623!important;
	}

	.full-story-item-image{
		border: 1px solid #d8d8d8;
	}

</style>
@endsection

@section('content')
<div class="container content">
	<br>
	<div class="row">
		{{-- content --}}
		
		{{-- Truyen hot --}}
		<div class="container-fluid wow fadeIn" style="margin-bottom:2rem">
			<div class="list">
				<h3 class="title-list float-left">
					<a href="#">
						<span class="text-uppercase">
							Truyện hot <i class="fas fa-fire"></i>
						</span>
					</a>
				</h3>
				<select name="category-select" id="category-select" class="float-right rounded d-none d-md-block">
					<option value="0">Tất cả</option>
					@foreach($categories as $category)
						<option value="{{$category->id}}">{{$category->name}}</option>
					@endforeach
				</select>

				<div class="list-content" style="height: 10cm; background-color:steelblue">

				</div>
			</div>
		</div>
		{{-- end truyen hot --}}

		{{-- truyen moi cap nhat --}}
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 mr-1 py-3 content wow fadeIn">
			<div class="list">
				<h3 class="title-list">
					<a href="#">
						<span class="text-uppercase">Truyện mới cập nhật &nbsp;<i class="fas fa-newspaper"></i></span>
					</a>
				</h3>
				{{-- <div class="list-title py-2">Truyện mới cập nhật</div> --}}
				<div class="list-content" id="list-new">
					@foreach($newestChapters as $newChap)
						<div class="row">
							<div class="col-8 col-sm-6 col-md-6 col-lg-6 newchap-list-story-name pt-2">
								<i class="fas fa-book" style="padding-right: 0.85em; color: #8b572a;"></i>
								<a href="{{route('story', $newChap->story->slug)}}">
									{{$newChap->story->name}}
								</a>
								@if(\Carbon\Carbon::create($newChap->story->createdAt) > \Carbon\Carbon::now()->subWeek())
									<span class="new-icon"></span>
								@endif

								@if($newChap->story->status == 2)
									<span class="full-icon"></span>
								@endif
							</div>
							<div class="d-none d-sm-block col-sm-3 col-md-3 col-lg-3 newchap-list-category-name">
								<a href="{{route('category.story', $newChap->story->category->slug)}}">{{$newChap->story->category->name}}</a>
							</div>
							<div class="col-4 col-sm-3 col-md-3 col-lg-3 newchap-list-ordering">
								<a href="{{route('chapter', array($newChap->story->slug, $newChap->ordering))}}" class="" style="color: #F5A623">Chương {{$newChap->ordering}}</a>
								<p class="text-muted small">{{ $newChap->created_at->diffForHumans()}}</p>
							</div>
						</div>
					@endforeach
					<div class="mt-3 pb-2 pl-4">
						<a href="#">Xem tất tả <i class="fa fa-chevron-right"></i></a>
					</div>
				</div>
			</div>

			{{-- end truyen moi cap nhat --}}

			<br><br>

			{{-- truyen hoan thanh --}}
			<div class="list wow fadeIn">
				<h3 class="title-list">
					<a href="">
						<span class="text-uppercase">Truyện hoàn thành &nbsp;<i class="fas fa-check"></i></span>
					</a>
				</h3>
				<div class="list-content">
					<div class="row">
						@foreach($fullStories as $fullStory)
							<div class="col-12 col-sm-12 col-md-6 col-lg-6">
								<div class="row py-1">
									<div class="col-4 col-sm-4 col-md-4 col-lg-4">
										@if($fullStory->image)
											<a href="{{route('story', $fullStory->slug)}}">
												<img src="upload/{{$fullStory->image}}" class="rounded full-story-item-image" alt="" width="100%" height="auto">
											</a>
										@else
											<a href="{{route('story', $fullStory->slug)}}">
												<img src="no_image_vertical.png" alt="" width="100%" height="auto" class="rounded full-story-item-image">
											</a>
										@endif
									</div>
									<div class="col-8 col-sm-8 col-md-8 col-lg-8">
										<a href="{{route('story', $fullStory->slug)}}" class="font-weight-bold full-story-item-name">{{$fullStory->name}}</a>
										<div class="small">
											<div>
												Thể loại: <a href="{{route('category.story', $fullStory->category->slug)}}">{{$fullStory->category->name}}</a>
											</div>
											<div>
												<a href="#">{{$fullStory->author->name}}</a>
											</div>
											<div>
												Số chương: {{$fullStory->chapter->count()}} (Full)
											</div>
										</div>
									</div>
								</div>
							</div>
						@endforeach
						<div class="mt-3 pb-2 pl-4">
							<a href="#">Xem tất tả <i class="fa fa-chevron-right"></i></a>
						</div>
					</div>
				</div>
			</div>

			{{-- end truyen hoan thanh --}}

		</div>
		{{-- end content --}}

		{{-- side bar --}}
		@include('layout.sidebar')
		{{-- end side bar --}}
	</div>

		{{-- <div id="map" style="width:100%;height:500px;"></div>
	    <script>
	      var map;
	      function initMap() {
	        map = new google.maps.Map(document.getElementById('map'), {
	          center: {lat: 21.0168864, lng: 105.7855574},
	          zoom: 16
	        });
	      }
	    </script>
	    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0TxN30zoyR0LNRwS8BgFyuGaRGWim7e0&callback=initMap"
	    async defer></script> --}}
</div>

@endsection