@extends('admin.layout.master')

@section('title')
 Danh sách tài khoản | ADMIN TRUYỆN VIỆT
@endsection

@section('content')
	<div class="container-fluid">
      <!-- Breadcrumbs-->
    <div>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('admin.dashboard')}}">Tổng quan</a>
        </li>
        <li class="breadcrumb-item active"><a href="{{route('admin.user.index')}}">Tài khoản</a></li>
      </ol>
    </div>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Danh sách tài khoản
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
                  <th>Tên</th>                 
                  <th>Email</th>
                  <th>Vai trò</th>
                  <th>Trạng thái</th>
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


{{-- detail modal --}}
<div class="modal fade" id="detailModal" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detailModalLabel">Chi tiết tài khoản</h5>
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
                  <label for="email_detail" class="font-weight-bold">Email:</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" id="email_detail">
                </div>
              </div>              

              <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                  <label for="role_detail" class="font-weight-bold">Vai trò:</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" id="role_detail">
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
          <h5 class="modal-title" id="addModalLabel">Thêm tài khoản</h5>
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
              <input type="text" class="form-control" id="name_add" required="true" placeholder="Nhập tên tài khoản...">
            </div>

            <div class="form-group">
              <label for="email_add" class="font-weight-bold">Email</label>
              <input type="email" class="form-control" id="email_add" required="true" placeholder="Nhập email...">
            </div>   

            <div class="form-group">
              <label for="password_add" class="font-weight-bold">Mật khẩu</label>
              <input type="password" class="form-control" id="password_add" required="true" placeholder="Nhập mật khẩu...">
            </div>   

            <div class="form-group">
              <label for="confirm_password_add" class="font-weight-bold">Nhập lại mật khẩu</label>
              <input type="password" class="form-control" id="confirm_password_add" required="true" placeholder="Nhập lại mật khẩu...">
            </div>

            <div class="form-group">
              <label for="level_add" class="font-weight-bold">Vai trò</label>
              <label class="radio-inline"><input type="radio" name="level_add" class="level_add" id="colla" value="1" checked><span class="badge badge-info">CTV</span></label>
              <label class="radio-inline"><input type="radio" name="level_add" class="level_add" id="admin" value="2"><span class="badge badge-danger">Admin</span></label>              
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
          <h5 class="modal-title" id="editModalLabel">Sửa tài khoản</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
        </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form" id="form-edit" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="name_add" class="font-weight-bold">Tên:</label>
              <input type="text" class="form-control" id="name_edit" required="true" placeholder="Nhập tên tài khoản...">
            </div>

            <div class="form-group">
              <label for="email_add" class="font-weight-bold">Email</label>
              <input type="email" class="form-control" id="email_edit" required="true" placeholder="Nhập email...">
            </div>   

            <div>
              <label for="change_pass">Đổi mật khẩu</label>
              <input type="checkbox" id="change_pass">
            </div>

            <div class="form-group">
              <label for="password_add" class="font-weight-bold">Mật khẩu</label>
              <input type="password" class="form-control" id="password_edit" required="true" placeholder="Nhập mật khẩu..." disabled>
            </div>   

            <div class="form-group">
              <label for="confirm_password_add" class="font-weight-bold">Nhập lại mật khẩu</label>
              <input type="password" class="form-control" id="confirm_password_edit" required="true" placeholder="Nhập lại mật khẩu..." disabled>
            </div>

            <div class="form-group">
              <label for="level_add" class="font-weight-bold">Vai trò</label>
              <label class="radio-inline"><input type="radio" name="level_add" class="level_edit" id="colla_edit" value="1" checked><span class="badge badge-info">CTV</span></label>
              <label class="radio-inline"><input type="radio" name="level_add" class="level_edit" id="admin_edit" value="2"><span class="badge badge-danger">Admin</span></label>              
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
  ajax: {
    "url": "{{route('admin.user.list')}}",
    "type": "GET"
  },
  columns:[
    { data:'id', name:'check', orderable: false, searchable: false, render: function(data,type,row){
    	return '<div class="pretty p-icon p-thick p-smooth"> <input type="checkbox" name="delete-item[]" class="delete-multi-checkbox" value="'+data+'"/> <div class="state p-primary"> <i class="icon mdi mdi-check"></i> <label></label> </div> </div>';
    }},
    { data: 'name', width: '20%' , name: 'name'},
    { data: 'email', name: 'email'},
    { data: 'level', searchable: false, render: function(data,type,row){
      text = "";
      switch(parseInt(data)){
        case 1:
          text = '<span class="badge badge-info">CTV</span>';
          break;
        case 2:
          text = '<span class="badge badge-danger">Admin</span>';
          break;
        default:
          text = '<span class="badge badge-info">CTV</span>';
      }

      return text;
    }},
    { data: 'active', name: 'active', className: 'text-center' ,render: function(data, type, row){
      if(data==1)
      {
        return '<div class="pretty p-icon p-round p-pulse p-smooth"> <input type="checkbox" class="status-checkbox" checked="true" />    <div class="state p-primary"> <i class="icon mdi mdi-check"></i> <label></label> </div> </div>';
      }
      else
      {
        return '<div class="pretty p-icon p-round p-pulse p-smooth"> <input type="checkbox" class="status-checkbox" /> <div class="state p-primary"> <i class="icon mdi mdi-check"></i> <label></label> </div> </div>';
      }
    }},
    { data: 'created_at', name: 'created_at', render: function(data,type,row){
    	return moment(data).locale('vi').fromNow();
    }},
    { data: 'updated_at', name: 'updated_at', render: function(data,type,row){
		  return moment(data).locale('vi').fromNow();
    }},	
    { data: 'id',name: 'action', orderable: false, searchable: false, render: function(data,type,row){
    	return '<button title="Xem" data-toggle="modal" data-target="#detailModal" role="button" style="display:inline;" class="btn btn-outline-success btn-sm detailButton"><i class="fa fa-fw fa-eye"></i></button> <button title="Sửa" style:"display:inline;" class="btn btn-outline-info btn-sm edit-button" data-toggle="modal" data-target="#editModal" data-id="'+data+'"><i class="fa fa-fw fa-pencil"></i></button> <button title="Xóa" style:"display:inline;" class="btn btn-outline-danger btn-sm delete-button" data-toggle="modal" data-target="#deleteModal" data-id="'+data+'"><i class="fa fa-fw fa-trash"></i></button>';
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
  // $('[data-toggle="tooltip"]').tooltip(); 
  $('.status-checkbox').prop('indeterminate', true);

	$('#checkAllDelete').click(function (){
      $('.delete-multi-checkbox').prop('checked', this.checked);
    });

  $('#change_pass').change(function(){
    $('#password_edit,#confirm_password_edit').prop('disabled', !this.checked);
  });

    $(document).on('click', '.edit-button', function(){

      var id = $(this).data('id');
      
      $('#sua').val($(this).data('id'));

      $.ajax({
        type: 'GET',
        url: 'admin/user/'+id,
        async: false,
        success: function(data){
          $('#editModalLabel').text('Sửa tài khoản '+data.name);
          $('#name_edit').val(data.name);
          $('#email_edit').val(data.email);
          switch(data.level){
            case 1:
              $('#colla_edit').prop('checked', "checked");
              break;
            case 2:
              $('#admin_edit').prop('checked',"checked");
              break;
            default:
              $('#colla').prop('checked',"checked");
          }
        },
        errors: function(){

        }
      });

    })

  $(document).on('shown.bs.modal','#addModal', function(){
        $('#form-add')[0].reset();
        $('#name_add').focus();
    });

  $(document).on('shown.bs.modal','#editModal', function(){
        $('#name_edit').focus();
    });

    $(document).on('click', '.delete-button', function(){
      $('#xoa').val($(this).data('id'));      
    });

  $(document).on('click','.detailButton', function(){
    var id = $(this).closest('tr').find('td').find('.delete-multi-checkbox').val();
    $('#image_detail').attr('src', "");
    $.ajax({
      type: 'GET',
      url: 'admin/user/'+id,
      async: 'false',
      success: function(data){
        $('#detailModalLabel').text('Truyện '+data.name);
        $('#name_detail').text(data.name);
        $('#email_detail').text(data.email);
        $('#role_detail').html(function(){
          let text = "";
          switch(parseInt(data.level)){
            case 1:
              text = "<span class='badge badge-info'>CTV</span>";
              break;
            case 2:
              text = "<span class='badge badge-danger'>Admin</span>";
              break;
            default:
              text = "<span class='badge badge-info'>CTV</span>";
          }
          return text;
        });

        $('#status_detail').html(function(){
          let text = "";
          switch(parseInt(data.active)){
            case 0: 
              text = '<span class="text-danger"><i class="fa fa-fw fa-lock"></i> Khóa</span>';
              break;
            case 1:
              text = '<span class="text-success"><i class="fa fa-fw fa-user"></i> Hoạt động</span>';
              break;
            default:
              return '<i class="fas fa-lock"></i> Khóa';
          }
          return text;
        });
        $('#created_at_detail').text(moment(data.created_at.date).locale('vi').format('DD/MM/YYYY, hh:mm:ss A'));
        $('#updated_at_detail').text(moment(data.updated_at.date).locale('vi').format('DD/MM/YYYY, hh:mm:ss A'));

      },
      error: function(){
          
      }
    });
  });


   $(document).on('click','.status-checkbox', function(e){
      e.preventDefault();
      var button = $(this);
      var check = $(this).prop('checked') == true ? 1 : 0;
      // alert(check);
      const id = $(this).closest('tr').find('td').eq(0).find('input[type=checkbox]').val();
      // alert(id);
      $.ajax({
        type: "POST",
        url: "{{route('admin.user.changeStatus')}}",
        data: {
          '_token': $('input[name=_token]').val(),
          'id' : id,
          'check': check
        },
        success: function(event,xhr,setting){
            button.prop("checked", check);
        },
        error: function(){

        }
      });
   });

    //add
    $("#them").click(function(){
      $.ajax({
        type:'POST',
        dataType:'json',
        url:'{{route('admin.user.store')}}',
        data: {
          '_token': $('input[name=_token]').val(),
            'name': $('#name_add').val(),
            'email': $('#email_add').val(),
            'level': $('.level_add:checked').val(),
            'password': $('#password_add').val(), 
            'confirmPassword': $('#confirm_password_add').val()
        },
        success: function(){
          dataTable.ajax.reload(null, false);
          dataTable.page('first').draw('page');
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

    //Sua
    $('#sua').click(function(){
      var id = $(this).val();

      $.ajax({
        type: 'PUT',
        url: 'admin/user/sua/'+id,
        data: {
          '_token': $('input[name=_token]').val(),
            'name': $('#name_edit').val(),
            'email': $('#email_edit').val(),
            'level': $('.level_edit:checked').val(),
            'password': $('#password_edit').val(), 
            'confirmPassword': $('#confirm_password_edit').val()          
        },
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
        url: 'admin/user/xoa',
        type: 'DELETE',
        dataType: 'JSON',
        data: {
          '_token': $('input[name=_token]').val(),
          'id': deleteID,
        },
        success: function(){
          dataTable.ajax.reload(null,false);
        },
        error: function(){

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
        url:'admin/user/xoa-nhieu',
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