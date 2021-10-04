<div class="col-xs-12">
	<?php if($permissions): ?>
		<form onsubmit="oisForm(event)" method="POST" action="<?php echo e(route('roles.update',$role->id)); ?>">
			
			<div class="formAlert"></div>
			<?php echo e(csrf_field()); ?>

			<?php echo e(method_field('PUT')); ?>


			<input type="hidden" name="id" value="<?php echo e($role->id); ?>">

			<div class="form-group">
				<label class="sr-only">Role name</label>
				<input type="text" value="<?php echo e(ucwords($role->name)); ?>" required="" name="name" placeholder="Enter role name" class="form-control" />
				<?php if($errors->has('name')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('name')); ?></strong>
                    </span>
                <?php endif; ?>
			</div>



			<div class="form-group">
				<label>Grant permissions to:</label> <br>
				<?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="checkbox-inline">
					    <label><input name="permissions[]" type="checkbox" value="<?php echo e($permission->id); ?>"> <?php echo e(ucwords($permission->name)); ?></label>
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				
				<?php if($errors->has('permissions')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('permissions')); ?></strong>
                    </span>
                <?php endif; ?>
			</div>

			<button class="btn btn-success" type="submit">Submit</button>
		</form>
	<?php else: ?>
		<?php echo Addon::alertDanger('No permission found'); ?>

		<div class="text-center">
			<a onclick="oisNew(event)" href="<?php echo e(route('permissions.create')); ?>"><i class="fa fa-plus-circle"></i> Create permissions </a>
		</div>
		
	<?php endif; ?>
</div>