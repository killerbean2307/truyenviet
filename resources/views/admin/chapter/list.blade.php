@extends('admin.layout.master')

@section('title')
	Danh sách chương
@endsection

@section('content')
	<div class="container-fluid">
      <!-- Breadcrumbs-->
    <div>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('admin.category.index')}}">Tổng quan</a>
        </li>
        <li class="breadcrumb-item"><a href="{{route('admin.story.index')}}">Truyện</a></li>
        <li class="breadcrumb-item active">
        	{{$story->name}}
        </li>
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
            <table class="table table-bordered table-hover" id="data-table" width="100%" cellspacing="0">
              <thead class="thead-light">
                <tr>
                  <th data-priority="2" class="text-center">
                      <div class="pretty p-icon p-jelly">
                        <input type="checkbox" id="checkAllDelete" />
                          <div class="state p-info-o">
                            <i class="icon mdi mdi-check-all"></i>
                            <label></label>
                          </div>
                      </div>
                  </th>
                  {{-- <th data-priority="3">ID</th> --}}
                  <th>#</th>
                  <th>Tên</th>
                  {{-- <th>Nội dung</th> --}}
                  {{-- <th>Thể loại</th> --}}
                  <th>Người đăng</th>
                  {{-- <th>Lượt xem</th> --}}
                  {{-- <th>Nguồn</th> --}}
                  <th>Ngày đăng</th>
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
<div class="modal fade" id="addModal" role="dialog" aria-labelledby="addModalLabel" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Thêm chương</h5>
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
        <form class="form-horizontal" method="POST" role="form" id="form-add" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="name_add" class="font-weight-bold">Tên:</label>
              <input type="text" class="form-control" id="name_add" placeholder="Nhập tên chương...">
            </div>
            
            <div class="form-group">
              <label for="ordering_add" class="font-weight-bold">Thứ tự:</label>
              <input type="number" class="form-control" id="ordering_add" required="true">
            </div>

            <div class="form-group">
              <label for="content_add" class="font-weight-bold">Giới thiệu:</label>
              <textarea class="form-control ckeditor" id="content_add" placeholder="Nhập nội dung"></textarea>
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


{{-- delete confirm --}}
<div class="modal fade" id="deleteModal" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
@endsection

@section('script')
<script>
var idTruyen = {{$story->id}};
$('#data-table').DataTable({
	processing: true,
  	serverSide: true,
  	responsive: true,
  	ajax: 'admin/truyen/'+idTruyen+'/danhsach',
  	columns:[
	    { data:'id', name:'check', orderable: false, searchable: false, render: function(data,type,row){
	    	return '<div class="pretty p-icon p-thick p-smooth"> <input type="checkbox" name="delete-item[]" class="delete-multi-checkbox" value="'+data+'"/> <div class="state p-primary"> <i class="icon mdi mdi-check"></i> <label></label> </div> </div>';
	    }},
	    { data: 'ordering', name: 'order'},
	    {data: 'name', name: 'name'},
	    // { data: 'content', name: 'content'},
	    { data: 'user', name: 'user', render: function(data, type, row){
	    	return data.name;
	    }},
	    { data: 'created_at', render: function(data, type, row){
	    	return moment(data).locale('vi').fromNow();
	    }},
	    { data: 'updated_at', render: function(data, type, row){
	    	return moment(data).locale('vi').fromNow();
	    }},
	    { data: 'id',name: 'action', orderable: false, searchable: false, render: function(data,type,row){
	    	return '<button title="Xem" style:"display:inline;" class="btn btn-outline-success btn-small show-button" data-toggle="modal" data-target="#showModal" data-id="'+data+'"><i class="fa fa-fw fa-eye"></i></button> <button title="Sửa" style:"display:inline;" class="btn btn-outline-info btn-small edit-button" data-toggle="modal" data-target="#editModal" data-id="'+data+'"><i class="fa fa-fw fa-pencil"></i></button> <button title="Xóa" style:"display:inline;" class="btn btn-outline-danger btn-small delete-button" data-toggle="modal" data-target="#deleteModal" data-id="'+data+'"><i class="fa fa-fw fa-trash"></i></button>';
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
	var dataTable = $('#data-table').DataTable();

	$(document).on('shown.bs.modal','#addModal', function(){
	    $('#form-add')[0].reset();
	    $('#ordering_add').val({{($lastOrder+1)}});
		CKEDITOR.instances['content_add'].setData("");
	    $('#name_add').focus();
	});

    $(document).on('click', '.delete-button', function(){
      $('#xoa').val($(this).data('id'));      
    });

   	$("#them").click(function(){
        var _token = $('input[name=_token]').val();
        var name = $('#name_add').val();
        var content = CKEDITOR.instances['content_add'].getData();
        var ordering = $('#ordering_add').val();
        var story_id = {{$story->id}};
      $.ajax({
        type:'POST',
        url:'admin/chuong/them',
        data: {
        	'_token': _token,
        	'name': name,
        	'content': content,
        	'ordering': ordering,
        	'story_id': story_id
        },
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

    //xoa
    $('#xoa').click(function(){
      var deleteID = $(this).val();

      $.ajax({
        url: 'admin/chuong/xoa',
        type: 'DELETE',
        dataType: 'JSON',
        data: {
          '_token': $('input[name=_token]').val(),
          'id': deleteID,
        },
        success: function(){
          dataTable.ajax.reload(null,false);
        }
      });
    });

});

</script>
@endsection