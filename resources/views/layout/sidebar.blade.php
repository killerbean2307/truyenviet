<div class="col-lg-4 col-md-4 col-sm-12 col-12" style="margin-left: -4px">
	<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fdoctruyen123%2F&tabs=timeline&width=340&height=250&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=194208891305427" width="1000" height="250" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media" class="pt-4"></iframe>

	<div class="list my-4 content">
		<h3 class="title-list">
			<a href="#">
				<span class="text-uppercase">Thể loại &nbsp;</span>
			</a>
		</h3>
		<div class="list-content" style="font-size: 14px;">
			<div class="row">
				@foreach($categories as $category)
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 pr-3 py-2">
						<a href="#">{{$category->name}}</a>
					</div>
				@endforeach
				<div class="mt-3 pb-2 pl-4">
					<a href="#">Xem tất tả <i class="fa fa-chevron-right"></i></a>
				</div>
			</div>
		</div>
	</div>

</div>