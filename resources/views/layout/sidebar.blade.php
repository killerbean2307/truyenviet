<div class="col-lg-4 col-md-4 col-sm-12 col-12" style="margin-left: -4px">
	<div class="fb-page mt-4" data-href="https://www.facebook.com/doctruyen123/" data-height="250" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/doctruyen123/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/doctruyen123/">Truyện Việt</a></blockquote></div>
	<div class="list my-4 content">
		<h3 class="title-list">
			<a href="javacript:void(0)">
				<span class="text-uppercase">Thể loại &nbsp;</span>
			</a>
		</h3>
		<div class="list-content" style="font-size: 14px;">
			<div class="row">
				@foreach($categories as $category)
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 pr-3 py-2">
						<a href="{{route('category.story', $category->slug)}}">{{$category->name}}</a>
					</div>
				@endforeach
				{{-- <div class="mt-3 pb-2 pl-4">
					<a href="#">Xem tất tả <i class="fa fa-chevron-right"></i></a>
				</div> --}}
			</div>
		</div>
	</div>

</div>