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
                  <th>Tên</th>
                  <th>Ảnh</th>
                  <th>Đánh giá</th>
                  <th>Mô tả</th>
                  <th>Trạng thái</th>
                  <th>Thể loại</th>
                  <th>Tác giả</th>
                  <th>Lượt xem</th>
                  <th>Lượt like</th>
                  {{-- <th>Nguồn</th> --}}
                  {{-- <th>Tạo</th> --}}
                  <th>Cập nhật</th>
                  <th data-priority="1">Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
  </div>


{{-- detail modal --}}
<div class="modal fade" id="detailModal" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detailModalLabel">Chi tiết truyện</h5>
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
          
          <div class="row">  
          <div class=" col-lg-9 col-md-9 col-sm-9 col-xs-9">

            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <label for="name_detail" class="font-weight-bold">Tên:</label>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" id="name_detail">
              </div>
            </div>
            
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <label for="category_detail" class="font-weight-bold">Thể loại</label>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" id="category_detail">
              </div>
            </div>

            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <label for="author_detail" class="font-weight-bold">Tác giả</label>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" id="author_detail">
              </div>
            </div>

            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <label for="status_detail" class="font-weight-bold">Trạng thái</label>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" id="status_detail">
              </div>
            </div>

            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <label for="description_detail" class="font-weight-bold">Giới thiệu</label>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" id="description_detail">
              </div>
            </div>

            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <label for="view_like_detail" class="font-weight-bold">Lượt đọc</label>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" id="view_like_detail">
              </div>
            </div>

            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <label for="created_at_detail" class="font-weight-bold">Ngày tạo</label>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" id="created_at_detail">
              </div>
            </div>

            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <label for="updated_at_detail" class="font-weight-bold">Ngày cập nhật</label>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" id="updated_at_detail">
              </div>
            </div>

            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <label for="user_detail" class="font-weight-bold">Người đăng</label>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" id="user_detail">
              </div>
            </div>
          
          </div>

          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <img src="" alt="" width="100%" id="image_detail">
          </div>
          </div>
        </div>

        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fa fa-fw fa-ban"></i>Đóng</button>
        </div>
      </div>
    </div>
</div>

<!-- add modal -->
<div class="modal fade" id="addModal" role="dialog" aria-labelledby="addModalLabel" data-backdrop="static" aria-hidden="true">
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
              <label for="name_add" class="font-weight-bold">Tên:</label>
              <input type="text" class="form-control" id="name_add" required="true" placeholder="Nhập tên truyện...">
            </div>

            <div class="form-group">
              <label for="description_add" class="font-weight-bold">Giới thiệu:</label>
              <textarea class="form-control ckeditor" id="description_add" placeholder="Nhập giới thiệu"></textarea>
            </div>

            
            <div class="form-group">
              <label for="image_add" class="font-weight-bold">Ảnh:</label>
              <input type="file" class="form-control" id="image_add">
            </div>
            
            <div class="form-group">
              <img src="" alt="preview" id="preview_add">
            </div>

            <div class="form-group">
              <label for="category_add" class="font-weight-bold">Thể Loại</label>
              <select class="form-control select2" id="category_add" name="category" required="true">
                <option></option>
                @foreach($categories as $category)
                  <option value='{{$category->id}}'>{{$category->name}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="author_add" class="font-weight-bold">Tác giả</label>
              <select class="form-control select2" id="author_add" name="author">
                <option></option>         
                @foreach($authors as $author)
                  <option value='{{$author->id}}'>{{$author->name}}</option>          
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="source_add" class="font-weight-bold">Nguồn:</label>
              <input type="text" class="form-control" id="source_add" placeholder="Nhập nguồn...">
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
<div class="modal fade" id="editModal" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Sửa truyện</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
        </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form" id="form-edit" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" id='slug_edit'>
            <div class="form-group">
              <label for="name_add" class="font-weight-bold">Tên:</label>
              <input type="text" class="form-control" id="name_edit" required="true" placeholder="Nhập tên truyện...">
            </div>

            <div class="form-group">
              <label for="description_add" class="font-weight-bold">Giới thiệu:</label>
              <textarea class="form-control ckeditor" id="description_edit" placeholder="Nhập giới thiệu"></textarea>
            </div>

            
            <div class="form-group">
              <label for="image_add" class="font-weight-bold">Ảnh:</label>
              <input type="file" class="form-control" id="image_edit">
            </div>
            <div class="form-group">
              <img src="" alt="Preview" id="preview_edit">  
            </div>
            <div class="form-group">
              <label for="category_add" class="font-weight-bold">Thể Loại</label>
              <select class="form-control select2" id="category_edit" name="category" required="true">
                <option></option>
                @foreach($categories as $category)
                  <option value='{{$category->id}}'>{{$category->name}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="author_add" class="font-weight-bold">Tác giả</label>
              <select class="form-control select2" id="author_edit" name="author">
                <option></option>         
                @foreach($authors as $author)
                  <option value='{{$author->id}}'>{{$author->name}}</option>          
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="source_add" class="font-weight-bold">Nguồn:</label>
              <input type="text" class="form-control" id="source_edit" placeholder="Nhập nguồn...">
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

<!-- delete multi confirm modal -->
<div class="modal fade" id="deleteMulti" role="dialog" aria-labelledby="deleteMultiLabel" aria-hidden="true">
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
    	return '<div class="pretty p-icon p-thick p-smooth"> <input type="checkbox" name="delete-item[]" class="delete-multi-checkbox" value="'+data+'"/> <div class="state p-primary"> <i class="icon mdi mdi-check"></i> <label></label> </div> </div>';
    }},
    // { data:'id' ,name: 'id'},
    { data: 'name', width: '20%' , name: 'name',render: function(data,type,row){
      var content = '<a data-toggle="modal" data-target="#detailModal" href="" class="detailButton"><img style="width: 50px; height: 50px; float: left" src="upload/'+row['image']+'"/>'+data+'</a>';
      if(!row['image'])
        content = '<a data-toggle="modal" data-target="#detailModal" href="" class="detailButton">'+data+'</a>';
      return content;
    }},
    { data: 'image', name:'image'},
    { data: 'view', name:'view', searchable: false, orderable: true,width: '15%',render: function(data, type, row) {
      return '<span class="text-muted">'+data+ ' <i class="fa fa-eye fa-fw"></i></span> - <span class="text-primary">'+row['like']+' <i class="fa fa-thumbs-up fa-fw"></span>';
    }},
    { data:'description',name:'description',render: function(data, type, row){
      if(!data)
        return "Chưa có";
      else
        // if(data.length > 50)
        // {
        //   var des = data.substring(0,50)+ '...';
        //   return des;
        // }
        return data;
    }},
    { data: 'status',  className:'text-center', name: 'status',render: function(data, type, row){
      var text = "";
      switch(parseInt(data)){
        case 0: 
          text = '<span class="badge badge-danger">Drop</span>';
          break;
        case 1:
          text = '<span class="badge badge-info">Còn tiếp</span>';
          break;
        case 2:
          text = '<span class="badge badge-success">Hoàn thành</span>';
          break;
        default:
          return '<span class="badge badge-info">Còn tiếp</span>';
      }
      return text;
    }},
    { data:'category', name:'category', render: function(data, type, row){
      return '<a href="admin/the-loai/'+data.slug+'" data-id="'+data.id+'">'+data.name+'</a>';
    }},
    { data:'author', name:'author', render: function(data, type, row){
      if(data)
        return '<a href="admin/tac-gia/'+data.slug+'" data-id="'+data.id+'">'+data.name+'</a>';
      else 
        return 'Chưa có';
    }},
    { data: 'view', name: 'view'},
    { data: 'like', name: 'like'},  
    // { data: 'source', name:'source'},
    // { data: 'created_at', name: 'created_at', render: function(data,type,row){
    // 	return moment(data).locale('vi').fromNow(true);
    // }},
    { data: 'updated_at', name: 'updated_at', render: function(data,type,row){
		  return moment(data).locale('vi').fromNow();
    }},	
    { data: 'id',name: 'action', orderable: false, searchable: false, render: function(data,type,row){
    	return '<a href="admin/truyen/'+data+'/danh-sach-chuong" title="Xem" role="button" style="display:inline;" class="btn btn-outline-success btn-small show-button"><i class="fa fa-fw fa-eye"></i></a> <button title="Sửa" style:"display:inline;" class="btn btn-outline-info btn-small edit-button" data-toggle="modal" data-target="#editModal" data-id="'+data+'"><i class="fa fa-fw fa-pencil"></i></button> <button title="Xóa" style:"display:inline;" class="btn btn-outline-danger btn-small delete-button" data-toggle="modal" data-target="#deleteModal" data-id="'+data+'"><i class="fa fa-fw fa-trash"></i></button>';
    }}
  ],
  columnDefs:[
    {visible:false, targets:[2,4,8,9]}
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
  // $('[data-toggle="tooltip"]').tooltip(); 
  $('.status-checkbox').prop('indeterminate', true)

	$('#checkAllDelete').click(function (){
      $('.delete-multi-checkbox').prop('checked', this.checked);
    });

    $(document).on('click', '.edit-button', function(){
      $('#name_edit').val($(this).closest('tr').find('td').eq(1).text());

      $('#image_edit').val(''); 

      $('#preview_edit').attr('src','');

      var des = dataTable.row($(this).parents('tr')).data()['description'];

      var author = $(this).closest('tr').find('td').eq(5).find('a').data('id');

      var category = $(this).closest('tr').find('td').eq(4).find('a').data('id');

      CKEDITOR.instances.description_edit.setData(des);

      var image = $(this).closest('tr').find('td').eq(2).find('img').attr('src');

      $('#author_edit').val(author).trigger('change');

      $('#category_edit').val(category).trigger('change');

      $('#slug_edit').val($(this).closest('tr').find('td').eq(1).text());

      $('#sua').val($(this).data('id'));

      $('#preview_edit').attr('src',image);
    });

  $('.select2').select2({
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


  // CKEDITOR.replace( 'description_add');
  $(document).on('shown.bs.modal','#addModal', function(){
        $('#form-add')[0].reset();
        $('#preview_add').attr('src','');
        $('#name_add').focus();
    });

  $(document).on('shown.bs.modal','#editModal', function(){
        $('#name_edit').focus();
    });

    $(document).on('click', '.delete-button', function(){
      $('#xoa').val($(this).data('id'));      
    });

  $(document).on('click','.detailButton', function(){

    $('#detailModalLabel').text($(this).text());
    var id = $(this).closest('tr').find('td').find('.delete-multi-checkbox').val();
    $('#image_detail').attr('src', "");
    $.ajax({
      type: 'GET',
      url: 'admin/truyen/'+id+'/chitiet',
      async: 'false',
      success: function(data){
        $('#name_detail').text(data.name);
        $('#category_detail').text(data.category.name);
        $('#author_detail').text(data.author.name);
        $('#status_detail').html(function(){
          var text = "";
          switch(parseInt(data.status)){
            case 0: 
              text = '<div class="badge badge-danger">Drop</div>';
              break;
            case 1:
              text = '<div class="badge badge-info">Còn tiếp</div>';
              break;
            case 2:
              text = '<div class="badge badge-success">Hoàn thành</div>';
              break;
            default:
              return '<div class="badge badge-info">Còn tiếp</div>';
          }
          return text;
        });
        $('#view_like_detail').html('<span class="text-success">'+data.view+ ' đọc</span> - <span class="text-danger">'+data.like+' thích</span>');
        $('#description_detail').html(data.description);
        $('#created_at_detail').text(moment(data.created_at).locale('vi').format('DD/MM/YYYY, hh:mm:ss A'));
        $('#updated_at_detail').text(moment(data.updated_at).locale('vi').format('DD/MM/YYYY, hh:mm:ss A'));
        $('#user_detail').text(data.user.name);

        $('#image_detail').attr('src','upload/'+data.image);

      },
      error: function(){
          
      }
    });
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
        if(image)
        {
          form.append('image',image);
        }
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

    $('#image_edit').change(function(){
      readURL(this, 'preview_edit');
    });

    $('#image_add').change(function(){
      readURL(this, 'preview_add');
    });

    //Sua
    $('#sua').click(function(){
      var slug = ChangeToSlug($('#slug_edit').val());
      // alert(slug);
      var _token = $('input[name=_token]').val();
      var name = $('#name_edit').val();
      var description = CKEDITOR.instances.description_edit.getData();
      var author = $('#author_edit').val();
      var category = $('#category_edit').val();
      var image = $('#image_edit').prop('files')[0];
      var _method = 'PUT';

      var form = new FormData();

      form.append('_token',_token);
      form.append('_method',_method);
      form.append('name',name);
      form.append('description',description);
      if(image)
      {
        form.append('image',image);
      }
      form.append('author', author);
      form.append('category', category);

      var id = $(this).val();

      $.ajax({
        type: 'POST',
        url: 'admin/truyen/sua/'+slug+'/'+id,
        contentType: false,       // The content type used when sending data to the server.
        processData: false,
        data: form,
        success: function(data){
          console.log(data);
          $('#editModal').modal('hide');
          dataTable.ajax.reload(null, false);
        },
        error: function(data){
          var errors = $.parseJSON(data.responseText);
            $.each(errors.errors, function(key, value){
                console.log(value);
                $('.edit-error').append('<div>'+value+'</div>');
                $('.edit-error').show();

                setTimeout(function(){
                  $('.edit-error div').remove();
                  $('.edit-error').hide();
                },5000)
            });
        }
      });
    });


    //xoa
    $('#xoa').click(function(){
      var deleteID = $(this).val();

      $.ajax({
        url: 'admin/truyen/xoa',
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

    //Xoa nhieu
    $('#xoaNhieu').click(function(){
      var deleteID = new Array();
      $('input.delete-multi-checkbox:checked').each(function(){
        deleteID.push($(this).val());
      });

      if(deleteID.length == 0)
      {
        alert("Bạn chưa chọn bản ghi nào!");
        $('#deleteMulti').modal('hide');
        return 0;
      }

      $.ajax({
        type:'DELETE',
        url:'admin/truyen/xoa-nhieu',
        dataType: 'JSON',
        data:{
          '_token': $('input[name=_token]').val(),
          'id': deleteID,
        },
        success: function(){
          dataTable.ajax.reload(null, false);
          $('#deleteMulti').modal('hide');
        }
      });
   }); 

});
</script>
@endsection