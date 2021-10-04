<div class="col-xs-12">
	
		<form onsubmit="oisForm(event)" method="POST" action="<?php echo e(route('permissions.update',$permission->id)); ?>">
			<?php echo e(csrf_field()); ?>

			<?php echo e(method_field('PUT')); ?>

			<!-- <input type="hidden" name="_method" value="PUT" /> -->
			<div class="formAlert"></div>


			<div class="form-group <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
				<label>Name</label>
				<input type="text" required="" value="<?php echo e($permission->name); ?>" name="name" placeholder="Enter permission name" class="form-control" />
				<?php if($errors->has('name')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('name')); ?></strong>
                    </span>
                <?php endif; ?>
			</div>

			<button class="btn btn-success" type="submit">Submit</button>
		</form>
	
</div>