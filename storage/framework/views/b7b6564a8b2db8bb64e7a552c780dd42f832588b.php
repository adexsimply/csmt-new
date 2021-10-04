
<?php $__env->startSection('title','Users'); ?>
<?php $__env->startSection('content'); ?>
	<div class="container">
	    <div class="row">
	        <div class="col-md-11 center-block">
	            <div class="panel panel-success card">
	                <div class="panel-heading card-header"><strong>User manager</strong>
	                    <a href="<?php echo e(route('users.create')); ?>" onclick="oisNew(event)" data-title="Add new user" class="btn btn-success btn-xs pull-right"><i class="fa fa-plus-circle"></i> Add new</a>
	                </div>

	                <div class="panel-body card-body">
	                <?php if($users): ?>
	                <div class="table-responsive">
	                     <table class="table table-striped table-bordered table-hover">
	                       <thead>
	                       		<tr>
		                           <th>SN</th>
		                           <th>Name</th>
		                           <th>Email</th>
		                           <th>Roles</th>
		                           <th>Actions</th>
	                       		</tr>
	                   		</thead>    
	                       <tbody>
	                           <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                            <tr id="user<?php echo e($user->id); ?>">
	                                <td><?php echo e($x+1); ?></td>
	                                <td><?php echo e($user->name); ?></td>
	                                <td><?php echo e($user->email); ?></td>
	                                <td>
	                                	<?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                                		<span class="badge"><?php echo e(ucwords($role->name)); ?></span>
	                                	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                                </td>
	                    			<td>
	                                    
	                                    <a href="<?php echo e(route('users.edit',$user->id)); ?>" onclick="oisEdit(event)" data-id="<?php echo e($user->id); ?>" data-title="Edit <?php echo e($user->name); ?>" class="btn btn-success btn-xs edit"><i class="fa fa-edit"></i> Edit</a>
	                                   

	                                    <a href="<?php echo e(route('users.destroy',$user->id)); ?>" data-method="delete" data-hide="#user<?php echo e($user->id); ?>" onclick="oisDelete(event)" class="btn btn-danger btn-xs delete"><i class="fa fa-times-circle"></i> Delete</a>
	                                    
	                             
	                                </td>
	                            </tr>
	                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                       </tbody>                   
	                   </table>

	                </div>
	                  
	                <?php else: ?>
	                    <div class="text-center">
	                        <h1>No user found </h1>
	                    </div>
	                    
	                <?php endif; ?>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>