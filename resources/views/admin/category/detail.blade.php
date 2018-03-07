@extends('admin.layout.master')

@section('content')
	<div class="container-fluid">
      <!-- Breadcrumbs-->
    <div>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('admin.category.index')}}">Tổng quan</a>
        </li>
        <li class="breadcrumb-item"><a href="{{route('admin.category.index')}}">Thể Loại</a></li>
        <li class="breadcrumb-item active">{{$category->name}}</li>
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
                  <th>Tác giả</th>
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
@endsection

@section('script')
<script>
var url = window.location.pathname;
var stuff = url.split('/');
var id = stuff[stuff.length-1];

$('#data-table').DataTable({
  processing: true,
  serverSide: true,
  responsive: true,
  ajax: 'admin/the-loai/truyen/'+id,
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
    { data:'author.name', name:'author'},
    { data: 'view', name: 'view'},
    { data: 'source', name:'source'},
    { data: 'created_at', name: 'created_at', render: function(data,type,row){
    	// moment.locale('vi');
     //  	var m = moment(data);
     //  	return m.fromNow(true);
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
});
</script>
@endsection