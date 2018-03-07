@extends('admin.layout.master')

@section('content')

<div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('admin.author.list')}}">Tổng quan</a>
        </li>
        <li class="breadcrumb-item active">Tác giả</li>
      </ol>
        <div class="col-md-12">
        @if(count($errors) > 0) 
          @foreach($errors->all() as $err)
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              {{$err}}
            </div>

          @endforeach
        @endif
        @if(session('thongbao'))
          <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              {{session('thongbao')}}
          </div>
        @endif

        </div>
  </div>
      <!-- Example DataTables Card-->
<form action="{{route('admin.author.deleteMulti')}}" method="POST" id="deleteMultiForm">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" value="{{csrf_token()}}" />

      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Danh sách tác giả
            <div class="pull-right"><a class="btn btn-danger" data-toggle="modal" data-target="#deleteMulti" style="color:white; margin-left: 10px;"><i class="fa fa-trash fa-fw"></i>Xóa</a></div>
            <div class="pull-right"><a class="btn btn-primary" data-toggle="modal" data-target="#addModal"  data-backdrop="static" style="color:white;"><i class="fa fa-plus fa-fw"></i>Thêm</a></div>

        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th><input type="checkbox" id="checkAllDelete"></th>
                  <th>ID</th>
                  <th>Tên</th>
                  <th>Trạng thái</th>
                  <th>Ngày tạo</th>
                  <th>Ngày cập nhật</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
        @foreach($authors as $author)
					<tr id="{{$author->id}}">
                        <td><input type="checkbox" name="delete-item[]" class="delete-multi-checkbox" value="{{$author->id}}"></td>
						<td>{{$author->id}}</td>
						<td>{{$author->name}}</td>
						<td>
                            <input type="checkbox" onclick="return false" name="status"
                            @if($author->status == 1)
                            {
                              {{"checked"}}
                            }
                            @endif
                          />
                        </td>
						<td>{{$author->created_at->format('H:i d/m/Y')}}</td>
						<td>{{$author->updated_at->format('H:i d/m/Y')}}</td>
                        <td class="center">
                        <a href="{{route('admin.author.edit', $author->id)}}" class="btn btn-info"><i class="fa fa-pencil fa-fw"></i>Sửa</a>&nbsp;&nbsp;
                        <a class="btn btn-danger delete-button" data-toggle="modal" data-target="#deleteModal" data-id="{{$author->id}}" style="color:white;"><i class="fa fa-trash-o fa-fw"></i>Xóa</a></td>
                            </tr>
				@endforeach	
              </tbody>
            </table>
          </div>
        </div>
        @if(App\Author::all()->count())
        
        <div class="card-footer small text-muted">Cập nhật vào lúc {{App\Author::orderBy('updated_at','desc')->pluck('updated_at')->first()->format('H:i D d-m-Y')}}</div>
        @endif
      </div>
</div>
</form>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Thêm tác giả</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
        </div>
      <div class="modal-body">
        <form action="{{route('admin.author.store')}}" method="POST">
          <input type="hidden" name="_token" value="{{csrf_token()}}" />
            <div class="form-group">
              <label for="name" class="font-weight-bold">Tên tác giả:</label>
              <input type="text" class="form-control" name="name" placeholder="Nhập tên tác giả">
            </div>
      </div>
      <div class="modal-footer">
          <button class="btn btn-success" type="submit" id="them">Thêm</button>
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
        </form>
      </div>
      </div>
    </div>
</div>

<!-- delete 1 confirm modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Xác nhận xóa</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa bản ghi này?
                <form action="{{route('admin.author.delete')}}" method="POST" class="delete-form">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <input type="hidden" id="idXoa" name="id" value=""/>

            </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit" id="xoa">Đồng ý</button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- delete multi confirm modal -->
<div class="modal fade" id="deleteMulti" tabindex="-1" role="dialog" aria-labelledby="deleteMultiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteMultiLabel">Xác nhận xóa</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa các bản ghi đã chọn?
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit" form="deleteMultiForm" id="xoa">Đồng ý</button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>

        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 4000);

        $(document).ready(function(){
            $('.delete-button').click(function(){
                var id = $(this).attr('data-id');
                $('#idXoa').val(id);
            });

            $('#checkAllDelete').click(function (){
                $('.delete-multi-checkbox').prop('checked', this.checked);
            });
        });
    </script>

@endsection