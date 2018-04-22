@extends('layout.master')

@section('css')
<style>
	.content a{
		text-decoration: none;
		color: black;
	}

	.content a:hover{
		color: #1ABC9C;
	}
</style>
@endsection

@section('content')
<div class="container content">
	<br>
	<div class="row">
		{{-- content --}}
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 mr-1 py-3 content">
			<div class="list">
				<h3 class="title-list">
					<a href="">
						<span class="text-uppercase">Truyện mới cập nhật</span>
					</a>
				</h3>
				<div class="list-content">
					@foreach($newestChapters as $newChap)
						<div class="row py-1">
							<div class="col-xs-9 col-sm-6 col-md-6 col-lg-6 newchap-list-story-name pr-2">
								<i class="fa fa-fw fa-chevron-right"></i>
								<a href="#">{{$newChap->story->name}}</a>
{{-- 								{{\Carbon\Carbon::create($newChap->story->createdAt)}}
								{{\Carbon\Carbon::now()->subDay(30)}}
								@php
									exit(0);
								@endphp --}}
								@if(\Carbon\Carbon::create($newChap->story->createdAt) > \Carbon\Carbon::now()->subWeek())
									<span class="badge badge-primary">Mới</span>
								@endif
								@if($newChap->story->status == 2)
									<span class="badge badge-success">Full</span>
								@endif
							</div>
							<div class="d-none d-sm-block col-sm-3 col-md-3 col-lg-3 newchap-list-category-name px-2">
								<a href="#">{{$newChap->story->category->name}}</a>
							</div>
							<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 newchap-list-ordering px-2">
								<a href="#">Chương {{$newChap->ordering}}</a>
								<p class="text-muted small">{{ $newChap->created_at->diffForHumans()}}</p>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
		{{-- end content --}}

		{{-- side bar --}}
		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="margin-left: -4px">
			<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fdoctruyen123%2F&tabs=timeline&width=340&height=250&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=194208891305427" width="340" height="250" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
		</div>
		{{-- end side bar --}}
	</div>

{{-- 		<div id="map" style="width:100%;height:500px;"></div>
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