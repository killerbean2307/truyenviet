<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thể Loại
                    <small><?php echo e($category->name); ?></small>
                </h1>
            </div>
             <!-- /.col-lg-8 -->
            <div class="col-lg-8 mx-auto">
                <?php if(count($errors) > 0 ): ?>
                    <div class="alert alert-danger alert-dismissable">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($err); ?><br>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>

                <?php if(session('thongbao')): ?>
                            <div class="alert alert-success alert-dismissable">
                                <?php echo e(session('thongbao')); ?>

                            </div>
                <?php endif; ?>
					
                    <form action="<?php echo e(route('admin.category.update', $category->id)); ?>" method="POST">
                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
                            <?php echo e(method_field('PUT')); ?>

                            <div class="form-group">
                                <label class="font-weight-bold">Tên thể loại</label>
                                <input type="text" class="form-control" name="name" placeholder="Nhập tên thể loại..." value="<?php echo e($category->name); ?>"/>
                            </div>
                            <div class="form-group">
                                <label for="description">Mô tả</label>
                                <input type="text" class="form-control" name="description" placeholder="Nhập mô tả..." value="<?php echo e($category->description); ?>"/>
                            </div>
                            <div class="form-group">
	                            <label for="status" class="font-weight-bold">Trạng thái: </label>
	                            <input type="checkbox" name="status" 
									<?php if($category->status == 1): ?>
										<?php echo e(" checked value=1"); ?>

                                    <?php else: ?>
                                        <?php echo e(" value=0"); ?>

									<?php endif; ?>
	                            />
							</div>
							<br>
                            <button type="submit" class="btn btn-success">Sửa</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                    <form>
                </div>
            </div>
                <!-- /.row -->
        </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>