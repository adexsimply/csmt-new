
<?php $__env->startSection('title','permission'); ?>
<?php $__env->startSection('content'); ?>
	<div class="container">
	    <div class="row">
	        <div class="col-md-8 center-block">
	            <div class="panel panel-success card">
	                <div class="panel-heading card-header"><strong>System permissions</strong>
	                    <a href="<?php echo e(route('permissions.create')); ?>" onclick="oisNew(event)" class="btn btn-success btn-xs pull-right"><i class="fa fa-plus-circle"></i> Add new</a>
	                </div>

	                <div class="panel-body card-body">
	                <?php if($permissions): ?>
	                <div class="table-responsive">
	                     <table class="table table-striped table-bordered table-hover">
	                       <thead>
	                       		<tr>
		                           <th>SN</th>
		                           <th>permission</th>
		                           <th>Actions</th>
	                       		</tr>
	                   		</thead>    
	                       <tbody>
	                           <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                            <tr id="permission<?php echo e($permission->id); ?>">
	                                <td><?php echo e($x+1); ?></td>
	                                <td><?php echo e(ucwords($permission->name)); ?></td>
	                    			<td>
	                                    
	                                    <a href="<?php echo e(route('permissions.edit',$permission->id)); ?>" data-id="<?php echo e($permission->id); ?>" onclick="oisEdit(event)" data-title="Edit permissions" class="btn btn-success btn-xs edit"><i class="fa fa-edit"></i> Edit</a>

	                                    <a href="<?php echo e(route('permissions.destroy',$permission->id)); ?>" data-id="<?php echo e($permission->id); ?>" data-method="delete" onclick="oisDelete(event)" data-hide="#permission<?php echo e($permission->id); ?>" class="btn btn-danger btn-xs delete"><i class="fa fa-times-circle"></i> Delete</a>
	                             
	                                </td>
	                            </tr>
	                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                       </tbody>                   
	                   </table>

	                </div>
	                  
	                <?php else: ?>
	                    <div class="text-center">
	                        <h1>No permission found </h1>
	                    </div>
	                    
	                <?php endif; ?>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>