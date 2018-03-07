@extends('admin.layout.master')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="">Tổng quan</a>
        </li>
        <li class="breadcrumb-item">Tác giả</li>
        <li class="breadcrumb-item active">Thêm</li>
      </ol>
	<div class="col-lg-7">
        @if(count($errors) > 0 )
        	<div class="alert alert-danger"></div>
               @foreach($errors->all() as $err)
                    {{$err}}<br>
                @endforeach
    		</div>
        @endif

    	@if(session('thongbao'))
      		<div class="alert alert-success">
           		{{session('thongbao')}}
        	</div>
		@endif
	</div>
	
	<div class="col-md-6 mx-auto">
		<form action="{{route('admin.author.store')}}" method="POST">
			<input type="hidden" name="_token" value="{{csrf_token()}}" />
			<div class="form-group">
				<label for="name">Tên:</label>
				<input type="text" class="form-control" name="name" placeholder="Nhập tên">
			</div>
			<button type="submit" class="btn btn-success">Add</button>
            <button type="reset" class="btn btn-default">Reset</button>
		</form>
	</div>	
@endsection