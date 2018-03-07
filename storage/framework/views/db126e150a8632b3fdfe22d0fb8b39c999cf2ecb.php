<?php $__env->startSection('content'); ?>

<div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo e(route('admin.author.list')); ?>">Tổng quan</a>
        </li>
        <li class="breadcrumb-item active">Tác giả</li>
      </ol>
        <div class="col-md-12">
        <?php if(count($errors) > 0): ?> 
          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              <?php echo e($err); ?>

            </div>

          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <?php if(session('thongbao')): ?>
          <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              <?php echo e(session('thongbao')); ?>

          </div>
        <?php endif; ?>

        </div>
  </div>
      <!-- Example DataTables Card-->
<form action="<?php echo e(route('admin.author.deleteMulti')); ?>" method="POST" id="deleteMultiForm">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />

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
        <?php $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr id="<?php echo e($author->id); ?>">
                        <td><input type="checkbox" name="delete-item[]" class="delete-multi-checkbox" value="<?php echo e($author->id); ?>"></td>
						<td><?php echo e($author->id); ?></td>
						<td><?php echo e($author->name); ?></td>
						<td>
                            <input type="checkbox" onclick="return false" name="status"
                            <?php if($author->status == 1): ?>
                            {
                              <?php echo e("checked"); ?>

                            }
                            <?php endif; ?>
                          />
                        </td>
						<td><?php echo e($author->created_at->format('H:i d/m/Y')); ?></td>
						<td><?php echo e($author->updated_at->format('H:i d/m/Y')); ?></td>
                        <td class="center">
                        <a href="<?php echo e(route('admin.author.edit', $author->id)); ?>" class="btn btn-info"><i class="fa fa-pencil fa-fw"></i>Sửa</a>&nbsp;&nbsp;
                        <a class="btn btn-danger delete-button" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo e($author->id); ?>" style="color:white;"><i class="fa fa-trash-o fa-fw"></i>Xóa</a></td>
                            </tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
              </tbody>
            </table>
          </div>
        </div>
        <?php if(App\Author::all()->count()): ?>
        
        <div class="card-footer small text-muted">Cập nhật vào lúc <?php echo e(App\Author::orderBy('updated_at','desc')->pluck('updated_at')->first()->format('H:i D d-m-Y')); ?></div>
        <?php endif; ?>
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
        <form action="<?php echo e(route('admin.author.store')); ?>" method="POST">
          <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
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
                <form action="<?php echo e(route('admin.author.delete')); ?>" method="POST" class="delete-form">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>