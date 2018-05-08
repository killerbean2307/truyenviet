@extends('layout.master')

@section('content')
	<button id="cookie"> 
		SET cookie
	</button>
	<input type="text" id="nhap" value="">
	<div class="bg-dark text-white">
		@if(Cookie::get('font-family'))
			{{-- {{$_COOKIE['font-family']}} --}}
			{{Cookie::get('font-family')}}
		@else 
			{{"Không có cookie"}}
		@endif
	</div>
@endsection

@section('script')
<script>
	$('#cookie').click(function(){
		$.cookie('font-family', $('#nhap').val(), { expires: 10000 });
	});
	if($.cookie("font-family"))
		$('#nhap').val($.cookie("font-family"));
	else 
		$('#nhap').val('Deo co');
</script>
@endsection

