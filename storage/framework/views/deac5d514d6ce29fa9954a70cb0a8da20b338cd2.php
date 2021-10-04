
<div class="element-box">
						
						<form action="<?php echo e(url('students/update')); ?>" onsubmit="oisForm(event)" method="post" class="f-16">

							<?php echo e(@csrf_field()); ?>


							<div class="formAlert"></div>

							<input type="hidden" name="id" value="<?php echo e($student->student_id); ?>">

							
							
				              <div class="table-responsive">
				              <table class="table table-striped table-bordered dataTable" style="width:100%">
				                <thead class="text-primary">
				              <tr>
				                <th class="text-center"><i class="fas fa-level-down"></i> S/N</th>
				                <th><i class="fas fa-user-circle"></i> Name</th>
				                <th><i class="fas fa-user-tie"></i> Parent's phone</th>
				                <th><i class="fas fa-user-tie"></i> Parent's phone2</th>
				                <th><i class="fas fa-user-tie"></i> Email</th>
				                <th><i class="fas fa-user-tie"></i> Address</th>
				                <th><i class="fas fa-plug"></i> Actions</th>
				              </tr>
				                </thead>
				                <tbody>

              					<?php $__currentLoopData = $parents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>



				              <tr id="parent<?php echo e($parent->id); ?>">
				                <td class="text-center"><?php echo e($x+1); ?></td>

				                <td><a data-type="purple" data-title="<?php echo e($parent->name); ?> details" data-size="l" onclick="oisRead(event)" href="<?php echo e(url('parents/show/'.$parent->id)); ?>"><?php echo e($parent->name); ?></a></td>

				                <td><?php echo e($parent->phone1); ?></td>
				                <td><?php echo e($parent->phone2); ?></td>
				                <td><?php echo e($parent->email); ?></td>
				                <td><?php echo e($parent->address); ?></td>
				                <td class="text-center">

				                  <a data-type="purple" data-title="Update <?php echo e($parent->name); ?> details" data-size="xl" onclick="oisEdit(event)" href="<?php echo e(url('students/edit_parent/'.$parent->id.'/'.$student->student_id)); ?>" title="Edit parent"><i class="fas fa-check"></i></a> &nbsp;
				                </td>
				              </tr>
				              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              
              
                </tbody>
                
              </table>

              
              </div> 


							<div class="row">
								<div class="col-md-12">
									<button type="submit" class="btn btn-primary btn-md">Update</button>
									<button type="reset" class="btn btn-sceondary btn-md">Reset fields</button>
								</div>
							</div>


						</form>
					  

					</div>


<script type="text/javascript">

	stateOptions('<?php echo e($student->state_id); ?>');
	sessionOptions('<?php echo e($student->admitted_session_id); ?>');
	clubOptions('<?php echo e($student->club_id); ?>');
	houseOptions('<?php echo e($student->house_id); ?>');
	lgaOptions('<?php echo e($student->state_id); ?>','<?php echo e($student->lga_id); ?>');
	fullArmOptions('<?php echo e($student->group_class_id); ?>','<?php echo e($student->aagc_id); ?>');
	$("#blood_group").val('<?php echo e($student->blood_group); ?>');
	$("#genotype").val('<?php echo e($student->genotype); ?>');
	$("#student_category_id").val('<?php echo e($student->student_category_id); ?>');
	$("#gender").val('<?php echo e($student->gender); ?>');
	$("#status").val('<?php echo e($student->status); ?>');
	classOptions('<?php echo e($student->group_class_id); ?>');

	/*Collect new class arms when class is changed*/
	$(".classOptions").change(function(){
		var group_class_id = $(this).val();
		fullArmOptions(group_class_id);
	});


</script>  

