<div class="col-sm-12">
	<?php if($students): ?>
		<label>Previously marked</label>

		<div class="row">
			<div class="col-sm-6">
				<input type="date" id="classAssignmentSubject" class="form-control" />
			</div>
			<div class="col-sm-6">
				<select required="" class="form-control" data-type="purple" data-title="Previously marked" data-size="xl" data-url="<?php echo e(url('assignment/subject/show/'.$aagc_id.'/'.$session_id.'/'.$term_id.'/'.$category_id)); ?>" onchange="viewAssignmentAttendance(event)">
						<?php if($subjects): ?>
							<option value="">Select subject</option>
							<?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($subject->id); ?>">
									<?php echo e($subject->name); ?>

								</option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php else: ?>
							<option>No subject found</option>
						<?php endif; ?>
					</select>
			</div>
		</div>
		
		<hr />

		<h3>Mark new </h3>
		<form method="post" onsubmit="oisForm(event)" action="<?php echo e(url('assignment/subject/store')); ?>">
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
					<th class="text-center"><input type="radio" onclick="mark_early()" class="radio-lg" name="mark_all">Early</th>
					<th class="text-center"><input type="radio" onclick="mark_late()" class="radio-lg" name="mark_all">Late</th>
				</thead>

				<tbody>
					<?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<input type="hidden" name="student_id[<?php echo e($x); ?>]" value="<?php echo e($student->student_id); ?>" />
							<td><?php echo e($x+1); ?></td>
							<td><?php echo e($student->surname.' '.$student->othernames); ?></td>
							<td><?php echo e($student->admission_no); ?></td>
							<td class="text-center"><input type="radio" required class="radio-lg early" name="status[<?php echo e($x); ?>]" value="1"></td>

							<td class="text-center"><input type="radio" required class="radio-lg late" name="status[<?php echo e($x); ?>]" value="0"></td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
			<div class="row">
				<div class="col-sm-5">
					<label>Select date</label>
					<input type="date" required="" name="date" class="form-control">
				</div>

				<div class="col-sm-5">
					<label>Select Subject</label>
					<select required="" name="subject_id" class="form-control">
						<?php if($subjects): ?>
							<option value="">Select subject</option>
							<?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($subject->id); ?>">
									<?php echo e($subject->name); ?>

								</option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php else: ?>
							<option>No subject found</option>
						<?php endif; ?>
					</select>
				</div>

				<div class="col-sm-2">
					<br>
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

<script type="text/javascript">
	subjectOptions();
</script>
<script type="text/javascript">
	function mark_early() {
		$(".early").prop("checked", true);
		//alert('Shina');
	}
	function mark_late() {
		$(".late").prop("checked", true);
		//alert('Shina');
	}
</script>