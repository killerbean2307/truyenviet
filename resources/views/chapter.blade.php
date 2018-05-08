@extends('layout.master')

@section('css')
<style>
	.content{
		border: 1px #f0f0f5;
		/*box-shadow: 0px 0px 10px 0px rgba(0,0,1,0.2);*/
		background-color: #ECEEF3;
	}
	
	.background-color{
		border: 1px solid grey;
	}

	.background-active{
		border: 3px solid #EC9D2E;
	}

	.prev, .next{
		width: 150px;
	}

	input[type='number'] {
    -moz-appearance:textfield;
}

	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
	    -webkit-appearance: none;
	}
</style>
@endsection

@section('content')
<div class="container">
	<div>
	  <ol class="breadcrumb" style="width: 100%;">
	    <li class="breadcrumb-item">
	      <a href="{{route('index')}}">Trang chủ</a>
	    </li>
	    <li class="breadcrumb-item"><a href="{{route('category.story', $chapter->story->category->slug)}}">{{$chapter->story->category->name}}</a></li>
	    <li class="breadcrumb-item"><a href="{{route('story', $chapter->story->slug)}}">{{$chapter->story->name}}</a></li>
	    <li class="breadcrumb-item active font-weight-bold my-color-1">{{$chapter->name}}</li>
	  </ol>
	</div>

	<h3 class="text-center font-weight-bold mt-4">
		<a href="{{route('story', $chapter->story->slug)}}" class="my-color-1" style="text-decoration: none">{{$chapter->story->name}}</a>
	</h3>	
	<h6 class="text-center font-weight-bold pb-3">#{{$chapter->ordering}}: {{$chapter->name}}</h6>
	<div class="navigation-button text-center mb-3"> 
		<a href="{{route('chapter', array($chapter->story->slug, $previous->ordering))}}" class="prev btn btn-info 			
			@if($chapter->isFirstChapter())
				{{"disabled"}}
			@endif"><i class="fas fa-chevron-left"></i> Chương trước</a>

		<a href="{{route('chapter', array($chapter->story->slug, $next->ordering))}}" class="next btn btn-info
			@if($chapter->isLastestChapter())
				{{"disabled"}}
			@endif
		">Chương sau <i class="fas fa-chevron-right"></i></a>
		<form action="{{route('doc-chuong')}}" class="my-3" method="POST">
 			{{ csrf_field() }}
			<label for="chapter_num" class="mr-2 font-weight-bold">Đi đến chương:</label>
			<input type="hidden" name="story_slug" value="{{$chapter->story->slug}}">
			<input type="number" name="ordering" style="width: 50px">
			<label for="">/{{$chapter->story->chapter->count()}}</label>
		</form>
	</div>

	<div class="content container py-2">
		{!!$chapter->content!!}
	</div>

	<div class="navigation-button text-center mt-3">
		<a href="{{route('chapter', array($chapter->story->slug, $previous->ordering))}}" class="prev btn btn-info 			
			@if($chapter->isFirstChapter())
				{{"disabled"}}
			@endif" 
			><i class="fas fa-chevron-left"></i> Chương trước</a>
		<a href="{{route('chapter', array($chapter->story->slug, $next->ordering))}}" class="next btn btn-info
			@if($chapter->isLastestChapter())
				{{"disabled"}}
			@endif
		">Chương sau <i class="fas fa-chevron-right"></i></a>
	</div>
	
	<div class="fb-comments" data-href="{{URL::current()}}" data-numposts="5" data-width="100%"></div>
</div>
@endsection

@section('script')
<script src="js/chapter.js"></script>
@endsection