<div class="col-lg-4 col-md-4 col-sm-12 col-12" style="margin-left: -4px">
	<div class="fb-page mt-4" data-href="https://www.facebook.com/doctruyen123/" data-height="250" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/doctruyen123/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/doctruyen123/">Truyện Việt</a></blockquote></div>
	<div class="list my-4 content">
		<h3 class="title-list">
			<a onclick="return false;">
				<span class="text-uppercase">Thể loại &nbsp;</span>
			</a>
		</h3>
		<div class="list-content" style="font-size: 14px;">
			<div class="row">
				@foreach($categories as $category)
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 pr-3 py-2 category">
						<a href="{{route('category.story', $category->slug)}}">{{$category->name}}</a>
					</div>
				@endforeach
				{{-- <div class="mt-3 pb-2 pl-4">
					<a href="#">Xem tất tả <i class="fa fa-chevron-right"></i></a>
				</div> --}}
			</div>
		</div>
	</div>
	
	{{-- top view --}}
	<div class="list content" id="rank">
		<h3 class="title-list">
			<a>
				<span class="text-uppercase">Top truyện</span>
			</a>
		</h3>
		<div class="list-content" style="font-size: 14px">
			<div class="container">
				<ul class="nav nav-tabs nav-justified mb-3">
				  <li class="nav-item">
				    <a class="nav-link active" data-toggle="tab" href="#topDay">Ngày</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" data-toggle="tab" href="#topWeek">Tuần</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" data-toggle="tab" href="#topMonth">Tháng</a>
				  </li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content pt-2 top-view-rank">
				  <div class="tab-pane container active" id="topDay">
				  	<ul class="list-unstyled">
					  	@foreach($topDayViewStories as $story)
					  		<li class="top-item p-2">
					  			<div class="row">
					  				<div class="col-2 p-0">
					  					@if($story->image)
					  						<a href="{{route('story', $story->slug)}}">
					  							<img src="upload/{{$story->image}}" alt="">
					  						</a>
					  					@else
					  						<a href="{{route('story', $story->slug)}}">
					  							<img src="no_image_vertical.png" alt="" width="100%">
					  						</a>
					  					@endif
					  				</div>
					  				<div class="col-10 top-story">
							  			<a class="font-weight-bold" href="{{route('story', $story->slug)}}">{{$story->name}}</a>
							  			<br>
							  			
							  			<a href="{{route('chapter', array($story->slug, $story->getLastChapter()->ordering))}}">
							  				Chương {{$story->getLastChapter()->ordering}}
							  			</a>

							  			<div class="float-right text-muted">
											<i class="fas fa-eye"></i> {{$story->viewCount->day_view}}
										</div>
									</div>
								</div>
					  		</li>
					  	@endforeach
					</ul>
				  </div>

				  <div class="tab-pane container fade" id="topWeek">
				  	<ul class="list-unstyled">
					  	@foreach($topWeekViewStories as $week)
					  		<li class="top-item p-2">
					  			<div class="row">
					  				<div class="col-2 p-0">
					  					@if($week->image)
					  						<a href="{{route('story', $week->slug)}}">
					  							<img src="upload/{{$week->image}}" alt="">
					  						</a>
					  					@else
					  						<a href="{{route('story', $week->slug)}}">
					  							<img src="no_image_vertical.png" alt="" width="100%">
					  						</a>
					  					@endif
					  				</div>
					  				<div class="col-10 top-story">
							  			<a class="font-weight-bold top-story-name" href="{{route('story', $week->slug)}}">{{$week->name}}</a>
							  			<br>
							  			
							  			<a href="{{route('chapter', array($story->slug, $story->getLastChapter()->ordering))}}">
							  				Chương {{$week->getLastChapter()->ordering}}
							  			</a>

							  			<div class="float-right text-muted">
											<i class="fas fa-eye"></i> {{$week->viewCount->week_view}}
										</div>
									</div>
								</div>
					  		</li>
					  	@endforeach
					</ul>
				  </div>

				  <div class="tab-pane container fade" id="topMonth">
				  	<ul class="list-unstyled">
					  	@foreach($topMonthViewStories as $story)
					  		<li class="top-item p-2">
					  			<div class="row">
					  				<div class="col-2 p-0">
					  					@if($story->image)
					  						<a href="{{route('story', $story->slug)}}">
					  							<img src="upload/{{$story->image}}" alt="">
					  						</a>
					  					@else
					  						<a href="{{route('story', $story->slug)}}">
					  							<img src="no_image_vertical.png" alt="" width="100%">
					  						</a>
					  					@endif
					  				</div>
					  				<div class="col-10 top-story">
							  			<a class="font-weight-bold top-story-name" href="{{route('story', $story->slug)}}">{{$story->name}}</a>
							  			<br>
							  			
							  			<a href="{{route('chapter', array($story->slug, $story->getLastChapter()->ordering))}}">
							  				Chương {{$story->getLastChapter()->ordering}}
							  			</a>

							  			<div class="float-right text-muted">
											<i class="fas fa-eye"></i> {{$story->viewCount->month_view}}
										</div>
									</div>
								</div>
					  		</li>
					  	@endforeach
					</ul>
				  </div>
				</div>
			</div>
		</div>
	</div>

	{{-- reading --}}
	<div class="list content my-4" id="reading">
		<h3 class="title-list">
			<a>
				<span class="text-uppercase">Truyện đang đọc</span>
			</a>
		</h3>

		<div class="list-content">
			@if(Cookie::has('readingStory'))
				<ul class="list-unstyled p-2">
					@php
						$reading = json_decode(Cookie::get('readingStory'), true);
						$reading = collect($reading)->sortByDesc('time');
					@endphp
					@foreach($reading->take(3) as $key => $value)
						<li class="row p-2">
							<div class="col-8 reading-story">
								<a href="{{route('story', $key)}}">{{$value['name']}}</a>
							</div>
							<div class="col-4">
								<a href="{{route('chapter', array($key, $value['ordering']))}}">[Đọc tiếp]</a>
							</div>
						</li>
					@endforeach
				</ul>
				<div class="mt-3 pb-4 pl-4">
					<a href="{{route('reading')}}" class="mt-3" style="padding-bottom: 20px;">Xem tất cả <i class="fa fa-chevron-right"></i>
					</a>
				</div>
			@endif
		</div>
	</div>

</div>