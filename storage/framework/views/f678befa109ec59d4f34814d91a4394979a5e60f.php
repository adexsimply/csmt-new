<div class="col-sm-12">
	<?php if($students): ?>
		<label>Previously marked</label>

		<input data-type="purple" data-title="Previously marked" data-size="xl" type="date" data-url="<?php echo e(url('exeat/show/'.$aagc_id.'/'.$session_id.'/'.$term_id.'/'.$category_id)); ?>" onchange="viewAttendance(event)" class="form-control" />
		<hr />

		<h3>Mark new </h3>

		<form method="post" onsubmit="oisForm(event)" action="<?php echo e(url('exeat/store')); ?>">
			<div class="formAlert"></div>
			<?php echo e(csrf_field()); ?>

			<input type="hidden" name="aagc_id" value="<?php echo e($aagc_id); ?>">
			<input type="hidden" name="session_id" value="<?php echo e($session_id); ?>">
			<input type="hidden" name="term_id" value="<?php echo e($term_id); ?>">
			<table class="table table-hover table-padded">
				<thead>
					<th>SN</th>
					<th>Name</th>
					<th>Student ID</th>
					<th>
						Exeat
					</th>
				</thead>

				<tbody>
					<?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<input type="hidden" name="student_id[]" value="<?php echo e($student->student_id); ?>" />
							<td><?php echo e($x+1); ?></td>
							<td><?php echo e($student->surname.' '.$student->othernames); ?></td>
							<td><?php echo e($student->admission_no); ?></td>
							<td><input type="checkbox" class="radio-lg" name="status[<?php echo e($x); ?>]" value="1"></td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
			<div class="row">
				<div class="col-lg-4">
					<label>Select date</label>
					<input type="date" required name="date" class="form-control">
				</div>
				
				<div class="col-lg-8 text-right">
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