@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thể Loại
                    <small>{{$category->name}}</small>
                </h1>
            </div>
             <!-- /.col-lg-8 -->
            <div class="col-lg-8 mx-auto">
                @if(count($errors) > 0 )
                    <div class="alert alert-danger alert-dismissable">
                        @foreach($errors->all() as $err)
                            {{$err}}<br>
                        @endforeach
                    </div>
                @endif

                @if(session('thongbao'))
                            <div class="alert alert-success alert-dismissable">
                                {{session('thongbao')}}
                            </div>
                @endif
					
                    <form action="{{route('admin.category.update', $category->id)}}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}" />
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <label class="font-weight-bold">Tên thể loại</label>
                                <input type="text" class="form-control" name="name" placeholder="Nhập tên thể loại..." value="{{$category->name}}"/>
                            </div>
                            <div class="form-group">
                                <label for="description">Mô tả</label>
                                <input type="text" class="form-control" name="description" placeholder="Nhập mô tả..." value="{{$category->description}}"/>
                            </div>
                            <div class="form-group">
	                            <label for="status" class="font-weight-bold">Trạng thái: </label>
	                            <input type="checkbox" name="status" 
									@if($category->status == 1)
										{{" checked value=1"}}
                                    @else
                                        {{" value=0"}}
									@endif
	                            />
							</div>
							<br>
                            <button type="submit" class="btn btn-success">Sửa</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                    <form>
                </div>
            </div>
                <!-- /.row -->
        </div>
@endsection