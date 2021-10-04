<div class="col-sm-12">
	<?php if($students): ?>
		
		<form method="post" onsubmit="oisForm(event)" action="<?php echo e(url('psychomotor/store')); ?>">
			<div class="formAlert"></div>
			<?php echo e(csrf_field()); ?>

			<input type="hidden" name="aagc_id" value="<?php echo e($aagc_id); ?>">
			<input type="hidden" name="session_id" value="<?php echo e($session_id); ?>">
			<input type="hidden" name="term_id" value="<?php echo e($term_id); ?>">
			<table class="table table-hover table-padded">
				<thead>
					<th>SN</th>
					<th>Name</th>
					<!-- <th>Student ID</th> -->
					<th>Craft skill</th>
					<th>Pet project</th>
					<th>Sport</th>
					<th>Remark</th>
				</thead>

				<tbody>
					<?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<input type="hidden" name="student_id[]" value="<?php echo e($student->student_id); ?>" />
							<td><?php echo e($x+1); ?></td>
							<td><?php echo e($student->surname.' '.$student->othernames); ?></td>
							<!-- <td><?php echo e($student->admission_no); ?></td> -->
							<td>
								<input type="text" class="form-control" name="craft_skill[]" placeholder="Enter craft skill">
							</td>

							<td>
								<input type="text"  class="form-control" name="pet_project[]" placeholder="Enter pet project">
							</td>

							<td>
								<input type="text" class="form-control" name="sport[]" placeholder="Enter sport">
							</td>

							<td>
								<input type="text" class="form-control" name="remark[]" placeholder="Enter remark">
							</td>


						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
			<div class="row">
				<div class="col-xs-12">
					<button type="submit" class="btn btn-primary">
						<i class="fas fa-check"></i> Submit
					</button>
				</div>
				
			</div>
			
		</form>
	<?php else: ?>
		<div class="text-danger text-center">
			<i class="fas fa-trash"></i> No student found
		</div>
	<?php endif; ?>
</div>