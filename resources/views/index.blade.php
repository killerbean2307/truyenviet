@extends('layout.master')

@section('css')
<style>

	.content a{
		text-decoration: none;
		color: black;
	}

	.content a:hover{
		color: turquoise;
	}

	.newchap-list-story-name a{
		color: 	#008080;
		font-weight: bold;
	}
	
	/* .newchap-list-story-name .badge{
		overflow: hidden;
		text-overflow: ellipsis;
	} */

	.list-content{
		background-color: white;
	}

	.list-content>.row{
		border-top: 0.5px dashed #F0FFFF;
		margin: 0;
	}

	.list-content>:first-child{
		padding-top: 1em;
		margin-top: 1em;
		border: none;
	}

</style>
@endsection

@section('content')
<div class="container content">
	<br>
	<div class="row">
		{{-- content --}}
		
		{{-- Truyen hot --}}
		<div class="container wow fadeIn" style="margin-bottom:5rem">
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
				<div class="list-content">
					@foreach($newestChapters as $newChap)
						<div class="row">
							<div class="col-8 col-sm-6 col-md-6 col-lg-6 newchap-list-story-name">
								<i class="fas fa-book"></i>
								<a href="#">
									{{$newChap->story->name}}
								</a>
								@if(\Carbon\Carbon::create($newChap->story->createdAt) > \Carbon\Carbon::now()->subWeek())
									<span class="badge badge-primary">Mới</span>
								@endif

								@if($newChap->story->status == 2)
									<span class="badge badge-success">Full</span>
								@endif
							</div>
							<div class="d-none d-sm-block col-sm-3 col-md-3 col-lg-3 newchap-list-category-name">
								<a href="#">{{$newChap->story->category->name}}</a>
							</div>
							<div class="col-4 col-sm-3 col-md-3 col-lg-3 newchap-list-ordering">
								<a href="#" class="">Chương {{$newChap->ordering}}</a>
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
								<div class="row">
									<div class="col-4 col-sm-4 col-md-4 col-lg-4">
										@if($fullStory->image)
											<a href="#">
												<img src="upload/{{$fullStory->image}}" class="rounded" alt="" width="100%" height="auto">
											</a>
										@else
											<a href="#">
												<img src="no_image_vertical.png" alt="" width="100%" height="auto" class="rounded">
											</a>
										@endif
									</div>
									<div class="col-8 col-sm-8 col-md-8 col-lg-8">
										<a href="#" class="font-weight-bold" style="color:#008080 hover:turquoise">{{$fullStory->name}}</a>
										<div class="small">
											<div>
												Thể loại: <a href="#">{{$fullStory->category->name}}</a>
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
					</div>
				</div>
			</div>

			{{-- end truyen hoan thanh --}}

		</div>
		{{-- end content --}}

		{{-- side bar --}}
		<div class="col-lg-4 col-md-4 col-sm-12 col-12" style="margin-left: -4px">
			<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fdoctruyen123%2F&tabs=timeline&width=340&height=250&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=194208891305427" width="340" height="250" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
		</div>
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