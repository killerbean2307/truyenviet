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

	.caption{
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
	}
	
	.full{
		width: 60px;
		height: 60px;
		background: url('full.png') no-repeat center center / 100%;;
		position: absolute;
		z-index: 100;
		top: 0;
		left: 0;
	}

	.slide-image{
		position: relative;
		transition:all 0.1s ease-in-out;
		overflow: hidden;
	}
	
	.slide-image a{
		/*overflow: hidden;*/
	}

	.slide-image img{
		max-width: 100%;
		height: 269px;
	}

	.slide-image:hover a{
		color: #F5A623;
	}	

	.slide-image:hover img{
		border: 2px solid #F5A623;
	}
</style>
@endsection

@section('content')
<div class="container content">
	<br>
	<div class="row">
		{{-- content --}}
		
		{{-- Truyen hot --}}
		<div class="container-fluid" style="margin-bottom:2rem">
			<div class="list">
				<h3 class="title-list d-flex align-items-center">
					<a href="{{route('hot-story')}}">
						<span class="text-uppercase">
							Truyện hot <i class="fas fa-fire"></i>
						</span>
					</a>
					<select name="category-select" id="category-select" class="ml-auto rounded d-none d-md-block mt-1" style="font-size:16px;">
						<option value="0"> --Thể loại-- </option>
						@foreach($categories as $category)
							<option value="{{$category->slug}}">{{$category->name}}</option>
						@endforeach
					</select>
				</h3>

				<div class="list-content">
					<div class="row">
						<div class="owl-carousel owl-theme">
							@foreach($hotStories->chunk(2) as $hotStory)
								<div class="item mx-3">
									@foreach($hotStory as $hot)
										<div class="item my-3 slide-image">										
											<a href="{{route('story', $hot->slug)}}">
												@if($hot->image)
													<img src="upload/{{$hot->image}}" alt="{{$hot->name}}" width="100%" class="rounded full-story-item-image">
													
												@else
													<img src="no_image_vertical.png" alt="{{$hot->name}}" width="100%" class="rounded full-story-item-image">
													
												@endif
											</a>

											@if($hot->isFull())
												<span class="full"></span>
											@endif

											<div class="caption text-center">
												<a href="{{route('story', $hot->slug)}}">{{$hot->name}}</a>
											</div>	
										</div>
									@endforeach
								</div>
							@endforeach
						</div>
					</div>    
				</div>
			</div>
		</div>
		{{-- end truyen hot --}}

		{{-- truyen moi cap nhat --}}
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 mr-1 py-3 content">
			<div class="list">
				<h3 class="title-list">
					<a href="{{route('new-story')}}">
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

								@if($newChap->story->isFull())
									<span class="full-icon"></span>
								@endif

								@if($newChap->story->isHot())
									<span class="hot-icon"></span>
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
						<a href="{{route('new-story')}}">Xem tất tả <i class="fa fa-chevron-right"></i></a>
					</div>
				</div>
			</div>

			{{-- end truyen moi cap nhat --}}

			<br><br>

			{{-- truyen hoan thanh --}}
			<div class="list wow fadeIn">
				<h3 class="title-list">
					<a href="{{route('full-story')}}">
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
												<img src="upload/{{$fullStory->image}}" class="rounded full-story-item-image" alt="">
											</a>
										@else
											<a href="{{route('story', $fullStory->slug)}}">
												<img src="no_image_vertical.png" alt="" class="rounded full-story-item-image">
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
							<a href="{{route('full-story')}}">Xem tất tả <i class="fa fa-chevron-right"></i></a>
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
</div>

@endsection

@section('script')
<script>
$('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
	nav: false,
	animateIn: 'fadeIn',
	animateOut: 'fadeOut',
	navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],	
	autoplay:true,
    autoplayTimeout:5000,
    autoplayHoverPause:true,
	responsiveClass:true,
    responsive:{
        0:{
            items:2,
			nav:true

        },
        600:{
            items:3,
			nav:true

        },
        1000:{
            items:5,
            nav:true

        }
    }
});

// $( ".owl-prev").html('<i class="fa fa-angle-left"></i>');
// $( ".owl-next").html('<i class="fa fa-angle-right"></i>');
// $('.owl-carousel').find('.owl-nav').removeClass('disabled');
// $('.owl-carousel').find('.owl-nav').addClass('text-center');
// $('.owl-carousel').on('changed.owl.carousel', function(event) {
// 	$(this).find('.owl-nav').removeClass('disabled');
// });
</script>
<script>
	$(document).ready(function(){
		$('#category-select').change(function(){
			if($(this).val() != 0)
			{	
				const cur = $(location).prop('href');
				$(location).prop('href', cur+'the-loai/'+$(this).val()); 
			}
		});
	});
</script>
@endsection