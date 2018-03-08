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
  </div>
      <!-- Example DataTables Card-->
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
                  <th>Ảnh</th>
                  <th>Giới thiệu</th>
                  <th>Trạng thái</th>
                  <th>Tạo</th>
                  <th>Cập nhật</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
        @if(App\Author::all()->count())
        <div class="card-footer small text-muted">Cập nhật vào lúc {{App\Author::orderBy('updated_at','desc')->pluck('updated_at')->first()->format('H:i d-m-Y')}}</div>
        @endif
      </div>
</div>

{{-- add modal --}}
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
        <div class="alert alert-danger alert-dismissible add-error" style="display: none" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="form-horizontal" role="form" id="form-add" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="name" class="font-weight-bold">Tên:</label>
              <input type="text" class="form-control" id="name_add" name="name_add" placeholder="Nhập tên thể loại...">
            </div>
            
            <div class="form-group">
              <label for="description" class="font-weight-bold">Mô tả:</label>
              <input type="text" class="form-control" id="detail_add" name="detail_add" placeholder="Nhập mô tả...">
            </div>

            <div class="form-group">
              <label for="image" class="font-weight-bold">Ảnh:</label>
              <input type="file" class="form-control" id="image_add" name="image_add">              
            </div>
      </div>
      <div class="modal-footer">
          <button class="btn btn-success" type="button" id="them"><i class="fa fa-fw fa-check"></i>Thêm</button>
          <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fa fa-fw fa-times"></i>Hủy</button>
        </form>
      </div>
      </div>
    </div>
</div>

<!-- edit modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Sửa tác giả</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
        </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form" enctype="multipart/form-data">
        <div class="alert alert-danger alert-dismissible edit-error" style="display: none" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
              <label for="name" class="font-weight-bold">Tên:</label>
              <input type="text" class="form-control" id="name_edit" name="name_edit" placeholder="Nhập tên thể loại...">
            </div>

            <div class="form-group">
              <label for="description" class="font-weight-bold">Mô tả</label>
              <textarea type="text" class="form-control" id="detail_edit" name="detail_edit" placeholder="Nhập mô tả..."></textarea>
            </div>

            <div class="form-group">
              <label for="image" class="font-weight-bold">Ảnh:</label>
              <input type="file" class="form-control" id="image_edit" name="image_edit">              
            </div>
      </div>
      <div class="modal-footer">
          <button class="btn btn-success" type="button" id="sua"><i class="fa fa-fw fa-check"></i>Sửa</button>
          <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fa fa-fw fa-times"></i>Hủy</button>
        </form>
      </div>
      </div>
    </div>
</div>

{{-- delete confirm --}}
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
        <form class="delete-form form-horizontal" role="form" method="POST">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="_method" value="DELETE">
      </div>
      <div class="modal-footer">
          <button class="btn btn-success" type="button" id="xoa" data-dismiss="modal"><i class="fa fa-fw fa-trash"></i>Đồng ý</button>
          <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fa fa-fw fa-times"></i>Hủy</button>
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
        <button class="btn btn-success" type="button" id="xoaNhieu"><i class="fa fa-trash"></i>Đồng ý</button>
        <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fa fa-times">Hủy</i></button>
      </div>
    </div>
  </div>
</div>
</div>
@endsection

@section('script')
    <script>

    $(document).ready(function(){
      ('#checkAllDelete').click(function (){
        $('.delete-multi-checkbox').prop('checked', this.checked);
      });
    });

    </script>

@endsection