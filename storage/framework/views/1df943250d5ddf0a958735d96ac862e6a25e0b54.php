
<?php $__env->startSection('title','Role'); ?>
<?php $__env->startSection('content'); ?>
	<div class="container">
	    <div class="row">
	        <div class="col-md-10 center-block">
	            <div class="panel panel-success card">
	                <div class="panel-heading card-header"><strong>User roles</strong>
	                    <a href="<?php echo e(route('roles.create')); ?>" onclick="oisNew(event)" data-title="Create new role" class="btn btn-success btn-xs pull-right"><i class="fa fa-plus-circle"></i> Add new</a>
	                </div>

	                <div class="panel-body card-body">
	                <?php if($roles): ?>
	                <div class="table-responsive">
	                     <table class="table table-striped table-bordered table-hover">
	                       <thead>
	                       		<tr>
		                           <th>SN</th>
		                           <th>Role</th>
		                           <th>Permission</th>
		                           <th>Actions</th>
	                       		</tr>
	                   		</thead>    
	                       <tbody>
	                           <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                            <tr id="role<?php echo e($role->id); ?>">
	                                <td class="text-center"><?php echo e($x+1); ?></td>
	                                <td><?php echo e(ucwords($role->name)); ?></td>
	                                <td>
	                                	<?php $__currentLoopData = $role->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                                		<span class="badge"><?php echo e(ucwords($permission->name)); ?></span>
	                                	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                                </td>
	                    			<td>
	                                    <a href="<?php echo e(route('roles.edit',$role->id)); ?>" data-id="<?php echo e($role->id); ?>" onclick="oisEdit(event)" data-title="Update role" class="btn btn-success btn-xs edit"><i class="fa fa-edit"></i> Edit</a>

	                                    <a href="<?php echo e(route('roles.destroy',$role->id)); ?>" data-method="delete" onclick="oisDelete(event)" data-hide="#role<?php echo e($role->id); ?>" class="btn btn-danger btn-xs delete"><i class="fa fa-times-circle"></i> Delete</a>
	                                </td>
	                            </tr>
	                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                       </tbody>                   
	                   </table>

	                </div>
	                  
	                <?php else: ?>
	                    <div class="text-center">
	                        <h1>No role found </h1>
	                    </div>
	                    
	                <?php endif; ?>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>