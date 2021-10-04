    
    <?php if(count($students) > 0 ): ?>
    <form onsubmit="oisForm(event)" method="POST" action="<?php echo e(url('classes/aagc/subject-student-addup')); ?>">

      <?php echo e(@csrf_field()); ?>


      <div class="formAlert"></div>

      <input type="hidden" name="session_id" value="<?php echo e($session_id); ?>" />
      <input type="hidden" name="aagc_id" value="<?php echo e($aagc_id); ?>" />
      <input type="hidden" name="subject_id" value="<?php echo e($subject_id); ?>" />
      
    <div class="table-responsive">
            <table class="table table-lightborder">
                <thead>
                   <tr>
                      <th>S/N</th>
                      <th>Select</th>
                       <th>Student's ID</th>
                       <th>Name</th>
                    </tr>
                  </thead>
                  <tbody>
 

                                <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <tr>
                                    <td><?php echo e($x+1); ?></td>

                                    <td><input type="checkbox" id="<?php echo e($x); ?>" name="student_id[]" value="<?php echo e($student->id); ?>" /></td>

                                    <td><a class="studentDetails" href="<?php echo e(url('students/show/'.$student->id)); ?>"><?php echo e($student->admission_no); ?></a></td>

                                    <td><label for="<?php echo e($x); ?>"><?php echo e($student->surname.' '.$student->othernames); ?></label></td>
                                    
                                  </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                                    </tbody>
                    
                                   </table>
                                </div>

                    <button class="btn btn-success" type="submit">Add selected student(s)</button>
            </form>
      <?php else: ?>
        <h3 class="text-center text-danger"><i class="fas fa-trash"></i> No data found</h3>
      <?php endif; ?>



<script type="text/javascript">
  $(document).ready(function(){
    studentDetails();
  });

</script>