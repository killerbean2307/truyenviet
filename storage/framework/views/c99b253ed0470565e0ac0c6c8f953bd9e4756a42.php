<?php if(Session::has('toasts')): ?>
	<?php $__currentLoopData = Session::get('toasts'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $toast): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<div class="alert alert-<?php echo e($toast['level']); ?>">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

			<?php if(!is_null($toast['title'])): ?>
				<strong><?php echo e($toast['title']); ?></strong>
			<?php endif; ?>

			<?php echo e($toast['message']); ?>

		</div>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>