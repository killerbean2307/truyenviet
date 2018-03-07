<?php $__env->startSection('content'); ?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="">Tổng quan</a>
        </li>
        <li class="breadcrumb-item">Tác giả</li>
        <li class="breadcrumb-item active">Thêm</li>
      </ol>
	<div class="col-lg-7">
        <?php if(count($errors) > 0 ): ?>
        	<div class="alert alert-danger"></div>
               <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($err); ?><br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    		</div>
        <?php endif; ?>

    	<?php if(session('thongbao')): ?>
      		<div class="alert alert-success">
           		<?php echo e(session('thongbao')); ?>

        	</div>
		<?php endif; ?>
	</div>
	
	<div class="col-md-6 mx-auto">
		<form action="<?php echo e(route('admin.author.store')); ?>" method="POST">
			<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
			<div class="form-group">
				<label for="name">Tên:</label>
				<input type="text" class="form-control" name="name" placeholder="Nhập tên">
			</div>
			<button type="submit" class="btn btn-success">Add</button>
            <button type="reset" class="btn btn-default">Reset</button>
		</form>
	</div>	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>