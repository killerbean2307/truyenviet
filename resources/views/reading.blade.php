@extends('layout.master')

@section('css')
<style>
	.page-link{
		color:#F5A623;
	}

	.page-link:hover{
		color:#F5A623;
	}

	.pagination{
		justify-content: center;
	}
</style>
@endsection

@section('content')
<div class="container">
	<div class="list my-5">
		<h3 class="title-list">
			<a>
				<span>
					Truyện đang đọc
				</span>
			</a>
		</h3>
		<div class="list-content mb-4">
			@foreach($readingStory as $key => $value)
				<div class="row p-3">
					<div class="col-8 text-center">
						<a class="my-link font-weight-bold reading-story" href="{{route('story', $key)}}">{{$value->name}}</a>
					</div>
					<div class="col-4 text-center">
						<a class="my-link" href="{{route('chapter', array($key, $value->ordering))}}">Chương {{$value->ordering}}</a>
					</div>
				</div>
			@endforeach			
		</div>
		{{$readingStory->links("pagination::bootstrap-4")}}</div>

	</div>



</div>
@endsection