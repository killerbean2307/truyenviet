<?php $__env->startSection('content'); ?>

<div class="container-fluid">
      <!-- Breadcrumbs-->
    <div>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo e(route('admin.author.list')); ?>">Tổng quan</a>
        </li>
        <li class="breadcrumb-item active">Thể Loại</li>
      </ol>
    </div>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Danh sách thể loại
          <div class="pull-right"><a class="btn btn-danger text-white" data-toggle="modal" data-target="#deleteMulti" id="delelte-multi-button"><i class="fa fa-trash fa-fw"></i>Xóa</a></div>
          <div class="pull-right" style="margin-right:5px; "><a class="btn btn-primary text-white" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus fa-fw"></i>Thêm</a></div>

        </div>
        <div class="card-body">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title" >Custom Filter : </h3>
            </div>
            <div class="panel-body">
                <form id="form-filter" class="form-horizontal">
                    <div class="form-group row">
                        <label for="country" class="col-sm-1 col-form-label font-weight-bold">Tên</label>
                        <div class="col-sm-5">
                          <input type="text" id="filter-name" class="form-control" value="" placeholder="Nhập tên...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="LastName" class="col-sm-2 control-label"></label>
                        <div class="col-md-12">
                            <button type="button" id="btn-filter" class="btn btn-primary">Filter</button>
                            <button type="button" id="btn-reset" class="btn btn-default">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="data-table" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th><input type="checkbox" id="checkAllDelete"/></th>
                  <th>ID</th>
                  <th>Tên</th>
                  <th>Mô tả</th>
                  <th>Trạng thái</th>
                  <th>Ngày tạo</th>
                  <th>Ngày cập nhật</th>
                  <th>Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
</div>
<!-- add modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Thêm thể loại</h5>
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
        <form class="form-horizontal" role="form" id="form-add">
            <?php echo e(csrf_field()); ?>

            <div class="form-group">
              <label for="name" class="font-weight-bold">Tên thể loại:</label>
              <input type="text" class="form-control" id="name_add" placeholder="Nhập tên thể loại...">
            </div>

            <div class="form-group">
              <label for="description" class="font-weight-bold">Mô tả</label>
              <input type="text" class="form-control" id="description_add" placeholder="Nhập mô tả...">
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
          <h5 class="modal-title" id="editModalLabel">Sửa thể loại</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
        </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form">
        <div class="alert alert-danger alert-dismissible edit-error" style="display: none" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <div class="form-group">
              <label for="name" class="font-weight-bold">Tên thể loại:</label>
              <input type="text" class="form-control" id="name_edit" name="name" placeholder="Nhập tên thể loại...">
            </div>

            <div class="form-group">
              <label for="description" class="font-weight-bold">Mô tả</label>
              <textarea type="text" class="form-control" id="des_edit" name="description" placeholder="Nhập mô tả..."></textarea>
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
          <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
$('#data-table').DataTable({
  processing: true,
  serverSide: true,
  ajax:{
    "url": '<?php echo route('admin.category.list'); ?>',
    "type": 'POST',
    "data": function(data){
      data.name = $('#filter-name').val(),
      data._token = '<?php echo e(csrf_token()); ?>'
    }
  },
  columns:[
    { data:'id', name:'check', orderable: false, searchable: false, render: function(data,type,row){
      return '<input type="checkbox" name="delete-item[]" class="delete-multi-checkbox" value="'+data+'"/>';
    }},
    { data: 'id' ,name: 'id'},
    { data: 'name', name: 'name'},
    { data: 'description', name:'description', width: "20%"},
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
    { data: 'created_at', name: 'created_at', render:function(data,type,row){
        return moment(data).locale('vi').fromNow(true);
    }},
    { data: 'updated_at', name: 'updated_at', render: function(data,type,row){
        return moment(data).locale('vi').fromNow(true);
    }},
    { data: 'slug', name: 'action', width: "20%", orderable: false, searchable: false, render: function(data,type,row){
      // data-toggle="modal" data-target="#showModal"
      var url = window.location.href;
      url = url+"/"+data;

      return '<a title="Xem" href="'+url+'" style:"display:inline;" class="btn btn-success btn-small show-button text-white""><i class="fa fa-fw fa-eye"></i></a> <a title="Sửa" style:"display:inline;" class="btn btn-info btn-small edit-button text-white" data-toggle="modal" data-target="#editModal" data-id="'+data+'"><i class="fa fa-fw fa-pencil"></i></a> <a title="Xóa" style:"display:inline;" class="btn btn-danger btn-small delete-button text-white" data-toggle="modal" data-target="#deleteModal" data-id="'+data+'"><i class="fa fa-fw fa-trash"></i></a>';}}

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


var dataTable = $('#data-table').DataTable();

  $(document).ready(function(){
      
    $('#btn-filter').click(function(){
      dataTable.ajax.reload();
    });

    $('#btn-reset').click(function(){
      $('#form-filter')[0].reset();
      dataTable.ajax.reload();
    });

    $(document).on('change','.status-checkbox', function(){
      var id = $(this).closest('tr').find('td').eq(1).text();
      var checked = $(this).prop('checked');
      $.ajax({
        type: 'post',
        url: '<?php echo e(route('admin.category.changeStatus')); ?>',
        data:{
          '_token': '<?php echo e(csrf_token()); ?>',
          'id': id,
          'checked': checked,
        },
      });
    });

    $(document).on('click', '.edit-button', function(){
      $('#name_edit').val($(this).closest('tr').find('td').eq(2).text());
      $('#des_edit').val($(this).closest('tr').find('td').eq(3).text());
      $('#sua').val($(this).data('id'));
    });

    $(document).on('shown.bs.modal','#editModal', function(){      
      $('#name_edit').focus();
      $(document).keypress(function(e) {
          if(e.which == 13) {
            $('#name_edit').trigger('click');
        }
      });
    });
    $(document).on('shown.bs.modal','#addModal', function(){
        $('#form-add')[0].reset();
        $('#name_add').focus();
    });


    $('#checkAllDelete').click(function (){
      $('.delete-multi-checkbox').prop('checked', this.checked);
    });

    $(document).on('click', '.delete-button', function(){
      $('#xoa').val($(this).data('id'));      
    });

    $("#them").click(function(){
      $.ajax({
        type:'post',
        dataType:'json',
        url:'<?php echo e(route('admin.category.store')); ?>',
        data:{
          '_token': $('input[name=_token]').val(),
            'name': $('#name_add').val(),
            'description': $('#description_add').val(),
        },
        success: function(){
          dataTable.ajax.reload(null, false);
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

    $('#sua').click(function(){
      var editID = $(this).val();
      $id = editID;
      $.ajax({
        type: 'put',
        url: 'admin/the-loai/sua/'+editID,
        dataType: 'JSON',
        data: {
          '_token': $('input[name=_token]').val(),
          'name': $('#name_edit').val(),
          'description': $('#des_edit').val(),
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

    $('#xoa').click(function(){
      var deleteID = $(this).val();

      $.ajax({
        url: '<?php echo e(route('admin.category.delete')); ?>',
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
        url:'<?php echo e(route('admin.category.deleteMulti')); ?>',
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

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>