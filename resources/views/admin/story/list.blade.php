@extends('admin.layout.master')

@section('title')
  Danh sách truyện | ADMIN TRUYỆN VIỆT
@endsection

@section('content')
	<div class="container-fluid">
      <!-- Breadcrumbs-->
    <div>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('admin.category.index')}}">Tổng quan</a>
        </li>
        <li class="breadcrumb-item active"><a href="{{route('admin.story.index')}}">Truyện</a></li>
      </ol>
    </div>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Danh sách truyện
          <div class="pull-right"><a class="btn btn-danger text-white" data-toggle="modal" data-target="#deleteMulti" id="delelte-multi-button"><i class="fa fa-trash fa-fw"></i>Xóa</a></div>
          <div class="pull-right" style="margin-right:5px; "><a class="btn btn-primary text-white" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus fa-fw"></i>Thêm</a></div>

        </div>
        <div class="card-body">

          <div class="table-responsive">
            <table class="table table-bordered table-hover dt-responsive" id="data-table" width="100%" cellspacing="0">
              <thead class="thead-light">
                <tr>
                  <th data-priority="2"><input type="checkbox" id="checkAllDelete"/></th>
                  <th data-priority="3">ID</th>
                  <th>Tên</th>
                  <th>Mô tả</th>
                  <th>Trạng thái</th>
                  <th>Thể loại</th>
                  <th>Lượt xem</th>
                  <th>Nguồn</th>
                  <th>Ngày tạo</th>
                  <th>Cập nhật</th>
                  <th data-priority="1">Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
</div>

<!-- add modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Thêm truyện</h5>
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
              <input type="text" class="form-control" id="name_add" required="true" placeholder="Nhập tên thể loại...">
            </div>

            <div class="form-group">
              <label for="name" class="font-weight-bold">Giới thiệu:</label>
              <textarea class="form-control ckeditor" id="description_add" placeholder="Nhập giới thiệu"></textarea>
            </div>

            
            <div class="form-group">
              <label for="description" class="font-weight-bold">Ảnh:</label>
              <input type="file" class="form-control" id="image_add" placeholder="Nhập mô tả...">
            </div>
            
            <div class="form-group">
              <label for="name" class="font-weight-bold">Thể Loại</label>
              <select class="form-control select2" id="category_add" name="category_add" required="true">
                <option></option>>
                @foreach($categories as $category)
                  <option value='{{$category->id}}'>{{$category->name}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="name" class="font-weight-bold">Tác giả</label>
              <select class="form-control select2" id="author_add" name="author_add">
                <option></option>         
                @foreach($authors as $author)
                  <option value='{{$author->id}}'>{{$author->name}}</option>          
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="name" class="font-weight-bold">Nguồn:</label>
              <input type="select" class="form-control" id="source_add" placeholder="Nhập nguồn...">
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
              <input type="text" class="form-control" id="name_edit" name="name" placeholder="Nhập tên thể loại...">
            </div>

            <div class="form-group">
              <label for="detail" class="font-weight-bold">Thông tin:</label>
              <textarea type="text" class="form-control" id="detail_edit" name="detail" placeholder="Nhập mô tả...">123</textarea>
            </div>

            <div class="form-group">
              <label for="description" class="font-weight-bold">Ảnh:</label>
              <input type="file" class="form-control" id="image_edit" placeholder="Nhập mô tả...">
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
@endsection

@section('script')
<script>



$('#data-table').DataTable({
  processing: true,
  serverSide: true,
  responsive: true,
  ajax: 'admin/truyen/danhsach',
  columns:[
    { data:'id', name:'check', orderable: false, searchable: false, render: function(data,type,row){
    	return '<input type="checkbox" name="delete-item[]" class="delete-multi-checkbox" value="'+data+'"/>';
    }},
    { data:'id' ,name: 'id'},
    { data: 'name', name: 'name'},
    { data:'description', name:'description'},
    { data: 'status', name: 'status',render: function(data, type, row){
      if(data==1)
      {
        return '<input type="checkbox" class="status-checkbox" name="status" checked/>';
      }
      else
      {
        return '<input type="checkbox" class="status-checkbox" name="status"/>';
      }
    }},
    { data:'category', name:'category', render: function(data, type, row){
      return '<a href="admin/the-loai/'+data.slug+'">'+data.name+'</a>';
    }},
    { data: 'view', name: 'view'},
    { data: 'source', name:'source'},
    { data: 'created_at', name: 'created_at', render: function(data,type,row){
    	return moment(data).locale('vi').fromNow(true);
    }},
    { data: 'updated_at', name: 'updated_at', render: function(data,type,row){
		return moment(data).locale('vi').fromNow(true);
    }},	
    { data: 'id',name: 'action', orderable: false, searchable: false, render: function(data,type,row){
    	return '<a title="Xem" style:"display:inline;" class="btn btn-success btn-small show-button text-white" data-toggle="modal" data-target="#showModal" data-id="'+data+'"><i class="fa fa-fw fa-eye"></i></a> <a title="Sửa" style:"display:inline;" class="btn btn-info btn-small edit-button text-white" data-toggle="modal" data-target="#editModal" data-id="'+data+'"><i class="fa fa-fw fa-pencil"></i></a> <a title="Xóa" style:"display:inline;" class="btn btn-danger btn-small delete-button text-white" data-toggle="modal" data-target="#deleteModal" data-id="'+data+'"><i class="fa fa-fw fa-trash"></i></a>';
    }}
  ],
  language:{
    "processing":   "Đang xử lý...",
    "lengthMenu":   "Xem _MENU_ mục",
    "zeroRecords":  "Không tìm thấy dòng nào phù hợp",
    "info":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
    "infoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
    "infoFiltered": "(được lọc từ _MAX_ mục)",
    "infoPostFix":  "",
    "search":       "Tìm:",
    "url":          "",
    "paginate": {
        "first":    "Đầu",
        "previous": "Trước",
        "next":     "Tiếp",
        "last":     "Cuối"
    }
  }

});

$(document).ready(function(){

	$('#checkAllDelete').click(function (){
      $('.delete-multi-checkbox').prop('checked', this.checked);
    });
  
  CKEDITOR.replace( 'description_add');
  // $('.select2').select2({ width:'100%'});
  $('#category_add').select2({
    placeholder: 'Chọn thể loại...',
    width: '100%',
    allowClear: true,
    sorter: function(data) {
    return data.sort(function (a, b) {
        if (a.text > b.text) {
            return 1;
        }
        if (a.text < b.text) {
            return -1;
        }
        return 0;
      });
    }
  });
  
  $('#author_add').select2({
    placeholder: 'Chọn tác giả...',
    width: '100%',
    allowClear: true,
    sorter: function(data) {
    return data.sort(function (a, b) {
        if (a.text > b.text) {
            return 1;
        }
        if (a.text < b.text) {
            return -1;
        }
        return 0;
      });
    }
  });

  $(document).on('shown.bs.modal','#addModal', function(){
        $('#form-add')[0].reset();
        $('#name_add').focus();
    });

    //add
    $("#them").click(function(){
        var _token = $('input[name=_token]').val();
        var name = $('#name_add').val();
        var description = $('#description_add').val();
        var author = $('#author_add').val();
        var category = $('#category_add').val();
        var image = $('#image_add').prop('files')[0];
        var form = new FormData();
        form.append('_token',_token);
        form.append('name',name);
        form.append('description',description);
        form.append('image',image);
        form.append('author', author);
        form.append('category', category);
      $.ajax({
        type:'POST',
        contentType: false,       // The content type used when sending data to the server.
        processData: false,
        url:'admin/truyen/them',
        data: form,
        success: function(){
          dataTable.ajax.reload(null, false);
          dataTable.page('last').draw('page');
          $('#addModal').modal('hide');
        },
        error: function(data){
          var errors = $.parseJSON(data.responseText);
            $.each(errors.errors, function(key, value){
                $('.add-error').append('<div>'+value+'</div>');
                $('.add-error').fadeIn();

                setTimeout(function(){
                  $('.add-error div').remove();
                  $('.add-error').fadeOut();
                },5000)
            });
        }
      });
    });

});
</script>
@endsection