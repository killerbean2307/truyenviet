@extends('layout.master')

@section('css')
<style>
	.story-image{
		border: 1px solid #d8d8d8;
	}

	.my-border{
		background-color: white;
		box-shadow: 0px 0px 10px 0px rgba(245, 166, 35, 0.2);
	}

	.story-name{
		color: #8B572A;
	}

	.story-author a, .story-category a{
		text-decoration: none;
		color: #F5A623;
	}

	.related a
	{
		text-decoration: none;
		color: #8B572A;		
	}

	.related a:hover{
		color: #F5A623;
	}

	.relate-image{
		border: 1px solid #d8d8d8;
	}
</style>
@endsection

@section('content')
<div class="container my-2">
	<div>
	  <ol class="breadcrumb" style="width: 100%;">
	    <li class="breadcrumb-item">
	      <a href="{{route('index')}}">Trang chủ</a>
	    </li>
	    <li class="breadcrumb-item"><a href="{{route('category.story', $story->category->slug)}}">{{$story->category->name}}</a></li>
	    <li class="breadcrumb-item active"><a href="{{route('story', $story->slug)}}">{{$story->name}}</a></li>
	  </ol>
	</div>

	<div class="row">
		<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 wow fadeIn">
			<div class="row my-border py-3" style="margin:0;">
				<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
					@if($story->image)
						<img src="upload/{{$story->image}}" alt="" width="100%" height="auto" class="story-image rounded">
					@else
						<img src="no_image_vertical.png" alt="" width="100%" height="auto" class="story-image rounded">
					@endif
				</div>
				<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8 px-3">
					<h3 class="font-weight-bold story-name">{{$story->name}}</h3>		
					<div class="story-author font-weight-bold py-1">
						<a href="#">{{$story->author->name}}</a>
					</div>
					<div class="story-category font-weight-bold py-1">
						<a href="{{route('category.story', $story->category->slug)}}">{{$story->category->name}}</a>
					</div>
					<div>
						<label for="" class="font-weight-bold">Số chương:</label> {{$story->chapter->count()}}
					</div>
					<div>
						<label for="" class="font-weight-bold">Trạng thái: </label>
						@switch($story->status)
						    @case(1)
						    	<span class="text-primary">Còn tiếp...</span>
						        @break
						    @case(2)
						    	<span class="text-success">Hoàn thành</span>
						        @break

						    @default
								<span class="text-danger">Drop</span>
						@endswitch
					</div>
					<div>
						<label for="" class="font-weight-bold">Lượt đọc: </label>
						<span class="text-info">
							{{$story->view}} <i class="fas fa-eye"></i> - {{$story->like}} <i class="far fa-thumbs-up"></i>
						</span>
					</div>
					<div>
						<label for="" class="font-weight-bold">Nguồn:</label> {{$story->source}}
					</div>
					<a class="btn btn-outline-info mt-1" href="" id="chapter-list-button"><i class="fas fa-bars"></i> Danh sách chương</a>
					<a class="btn btn-outline-success mt-1" href="{{route('chapter', array($story->slug, $story->getFirstChapter()->ordering))}}"><i class="fas fa-book"></i> Đọc truyện</a>
				</div>
				<div class="mt-3 px-3">
					<div class="font-weight-bold pb-2">Nội dung truyện {{$story->name}}</div>
					<div class="small">{!!$story->description!!}</div>
				</div>
			</div>

			<div class="row my-border py-3 my-3 px-4" style="margin:0;">
				<h6 class="font-weight-bold pb-3 col-12">Danh sách chương mới nhất</h6>
				<div class="col-12">
					@foreach($topLastedChapter as $lchap)
						<div class="font-size-85-em py-1">
							<i class="fas fa-certificate"></i> 
							<a href="{{route('chapter', array($lchap->story->slug, $lchap->ordering))}}">
								{{"Chương: ".$lchap->ordering.": "}}
								{{$lchap->name}}
							</a>
						</div>
					@endforeach
				</div>
			</div>

			<div class="row my-border py-3 my-4 px-4" style="margin:0;" id="chapter-list">
				<h6 class="font-weight-bold pb-3 col-12">Danh sách chương</h6>
				<div class="col-12">
					@foreach($chapters as $chap)
						<div class="font-size-85-em py-1">
							<i class="fas fa-certificate"></i> 
							<a href="{{route('chapter', array($chap->story->slug, $chap->ordering))}}">
								{{"Chương: ".$chap->ordering.": "}}
								{{$chap->name}}
							</a>
						</div>
					@endforeach
					<br>
					{{$chapters->links("pagination::bootstrap-4")}}
				</div>
			</div>
			<div class="fb-comments" data-href="{{URL::current()}}" data-numposts="5" data-width="100%"></div>
		</div>

		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 wow fadeIn">
			<div class="list">
				<h3 class="title-list">
					<a href="#">
						<span class="text-uppercase">
							Truyện cùng thể loại
						</span>
					</a>
				</h3>

				<div class="list-content pb-3">
					<div class="row related">
						@foreach($relateStories as $relateStory)
							<div class="col-12 pt-1">
								<div class="row">
									<div class="col-4 col-sm-4 col-md-4 col-lg-4">
										@if($relateStory->image)
											<a href="{{route('story', $relateStory->slug)}}">
												<img src="upload/{{$relateStory->image}}" class="rounded relate-image" alt="" width="100%" height="auto">
											</a>
										@else
											<a href="{{route('story', $relateStory->slug)}}">
												<img src="no_image_vertical.png" alt="" width="100%" height="auto" class="rounded relate-image">
											</a>
										@endif										
									</div>

									<div class="col-8 col-sm-8 col-md-8 col-lg-8">
										<a href="{{route('story', $relateStory->slug)}}" class="font-weight-bold full-story-item-name">{{$relateStory->name}}</a>
										<div class="small">
											<div>
												Thể loại: <a href="{{route('category.story', $relateStory->category->slug)}}">{{$relateStory->category->name}}</a>
											</div>
											<div>
												<a href="#">{{$relateStory->author->name}}</a>
											</div>
											<div>
												Số chương: {{$relateStory->chapter->count()}} (Full)
											</div>
										</div>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script>
	$('#chapter-list-button').attr('href', document.URL+"#chapter-list");

	$('#chapter-list-button').click(function(event){
		event.preventDefault();
        $('html,body').animate({scrollTop:$(this.hash).offset().top}, 500);
	});
</script>
@endsection