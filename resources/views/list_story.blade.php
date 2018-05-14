@extends('layout.master')
@section('css')
<style>
	.item-image{
		border: 1px solid #d8d8d8;
	}
	
	.pagination{
	    padding-left: 0;
	    margin: 20px 0;
	    border-radius: 4px;
	    justify-content: center;
	}
/*	.title-list>a:hover{
		cursor: text;
	}*/
</style>
@endsection

@section('content')
<div class="container">
	<div>
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item">
	      <a href="">Trang chủ</a>
	    </li>
	    <li class="breadcrumb-item active">
	    	<a href="
				@switch($list)
					@case(1)
						{{route('category.story', $slug)}}
						@break
					@case(2)
						{{route('author.story', $slug)}}
						@break
					@default
						{{$slug}}
				@endswitch
	    	">
	    	{{$title}}
	    	</a>
		</li>
	  </ol>
	</div>

	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 mr-1 py-3 content wow fadeIn">
			<div class="list">
				<h3 class="title-list">
					<a onclick="return false;" {{--  style="cursor: text;" --}}>
						<span class="text-uppercase">
							@if(isset($title))
								{{$title}}
							@endif
						</span>
					</a>
				</h3>
				<div class="list-content">
					<div class="row">
						@foreach($listStories as $story)
							<div class="col-12 col-sm-12 col-md-6 col-lg-6">
								<div class="row py-1">
									<div class="col-4 col-sm-4 col-md-4 col-lg-4 pr-0">
										@if($story->image)
											<a href="{{route('story',$story->slug)}}">
												<img src="upload/{{$story->image}}" class="rounded item-image" alt="" width="100%" height="auto">
											</a>
										@else
											<a href="{{route('story',$story->slug)}}">
												<img src="no_image_vertical.png" alt="" width="100%" height="auto" class="rounded item-image">
												</a>
											@endif
									</div>
									<div class="col-8 col-sm-8 col-md-8 col-lg-8">
										<a href="{{route('story',$story->slug)}}" class="font-weight-bold full-story-item-name">{{$story->name}}</a>
										<div class="small">
											<div>
												Thể loại: <a href="{{route('category.story',$story->category->slug)}}">{{$story->category->name}}</a>
											</div>
											<div>
												<a href="{{route('author.story', $story->author->slug)}}">{{$story->author->name}}</a>
											</div>
											<div>
												Số chương: {{$story->chapter->count()}}
												@if($story->isFull())
													{{"(Full)"}}
												@endif
											</div>
											<div>
												Lượt đọc: {{$story->view}}
											</div>
										</div>
									</div>
								</div>
							</div>
						@endforeach
					</div>
					<div class="w-100 py-3">
						{{$listStories->links("pagination::bootstrap-4")}}
					</div>
				</div>
			</div>
		</div>
	
		@include('layout.sidebar')
	</div>
</div>
@endsection

@section('script')
<script>
	$(document).ready(function(){
		$('#rank,#reading').hide();
	});
</script>
@endsection
