@extends('layout.master')

@section('content')
	<div>Tìm thấy {{$results->total()}} kết quả</div>
	@if($results)
		@foreach($results as $result)
			{{$result->name}}
			<br>
		@endforeach
	@else
		{{"Không có kết quả nào"}}
	@endif
	{!!$results->links()!!}
@endsection