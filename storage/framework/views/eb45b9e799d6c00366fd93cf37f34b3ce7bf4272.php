<div class="element-box">
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit report')): ?>
	<?php if(count($students) > 0 ): ?>
		<form action="<?php echo e(url('assessments/update-many')); ?>" onsubmit="oisForm(event)" method="post" class="f-16">

			<?php echo e(@csrf_field()); ?>


			<div class="formAlert"></div>


			<div class="row">

				<!-- <div class="col-md-6">
					<div class="form-group">
						<label>Session</label>
						<select name="session_id" required="" class="form-control sessionOptions"></select>
					</div>
				</div>


				<div class="col-md-6">
					<div class="form-group">
						<label>Term</label>
						<select name="term_id" required="" class="form-control termOptions"></select>
					</div>
				</div> -->


				<input type="hidden" name="session_id" value="<?php echo e($session_id); ?>">
				<input type="hidden" name="term_id" value="<?php echo e($term_id); ?>">
				<input type="hidden" name="aagc_id" value="<?php echo e($aagc_id); ?>">
				<input type="hidden" name="subject_id" value="<?php echo e($subject_id); ?>">
				<input type="hidden" name="category_id" value="<?php echo e($category_id); ?>">

			</div>
			<div class="table-responsive">
	            <table style="width: 100%;" class="table table-lightborder">
	                <thead>
	                   <tr>
	                      <th>S/N</th>
	                      <th>Student name</th>
	                       <th>Student's ID</th>
	                       <th>First test</th>
	                       <th>Second test</th>
	                       <th>Third test</th>
	                       <th>Micro Exam</th>
	                       <th>Exam</th>
	                    </tr>
	                </thead>
	                <tbody>
	 

	                <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                    <tr>
	                        <td><?php echo e($x+1); ?></td>
	                        <td><?php echo e($student->surname.' '.$student->othernames); ?></td>
	                        <td><a class="studentDetails" href="<?php echo e(url('students/show/'.$student->student_id)); ?>"><?php echo e($student->admission_no); ?></a></td>

	                        <td>
	                            <input type="hidden" name="student_id[]" value="<?php echo e($student->student_id); ?>">
	                            <input type="hidden" name="admission_no[]" value="<?php echo e($student->admission_no); ?>">
	                            <input type="number" min="0" value="<?php echo e($student->test1); ?>" max="10" name="test1[]" class="form-control" />
	                        </td>
	                                    
	                        <td> <input type="number" min="-1" value="<?php echo e($student->test2); ?>" max="10" name="test2[]" class="form-control" /></td>
	                                    
	                        <td> <input type="number" min="-1" value="<?php echo e($student->test3); ?>" max="10" name="test3[]" class="form-control" /></td>
	                                    
	                        <td> <input type="number" min="-1" value="<?php echo e($student->micro_exam); ?>" max="10" name="micro_exam[]" class="form-control" /></td>
	                                    
	                        <td> <input type="number" min="-1" value="<?php echo e($student->exam); ?>" max="85" name="exam[]" class="form-control" /> </td>          
	                    </tr>
	                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



	                </tbody>
	                    
	           	</table>
	        </div>



			<div class="row">
				<div class="col-md-12">
					<button type="submit" class="btn btn-primary btn-md"><i class="fas fa-cloud"></i> Update Assessment</button>
				</div>
			</div>


		</form>

	<?php else: ?>
		<h3 class="text-center text-danger"> <i class="fas fa-trash"></i> No unassessed student found</h3>
	<?php endif; ?>

<?php else: ?>
	<h3 class="text-center text-danger"> <i class="fas fa-trash"></i> Authorization needed </h3>
<?php endif; ?>				  

</div>


<script type="text/javascript">
	
	termOptions('<?php echo e($term_id); ?>');
	sessionOptions('<?php echo e($session_id); ?>');
	studentDetails();
	// useDataTable('.subjectStudent');

</script>