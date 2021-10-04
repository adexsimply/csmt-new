    
    <?php if(count($students) > 0 ): ?>
    <div class="table-responsive">
            <table class="table table-lightborder">
                <thead>
                   <tr>
                      <th>S/N</th>
                       <th>Student's ID</th>
                       <th>Name</th>
                       <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
 

                                <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <tr id="subjectStudent<?php echo e($student->pivot->id); ?>">
                                    <td><?php echo e($x+1); ?></td>

                                    <td><a class="studentDetails" href="<?php echo e(url('students/show/'.$student->id)); ?>"><?php echo e($student->admission_no); ?></a></td>

                                    <td><?php echo e($student->surname.' '.$student->othernames); ?></td>

                                    <td>
                                      <a data-type="dark" 
                                          onclick="oisDelete(event)" 
                                          data-hide="#subjectStudent<?php echo e($student->pivot->id); ?>"
                                          data-title="Remove <?php echo e($student->surname.' '.$student->othernames); ?>" 
                                          data-content="Are you sure you want to stop <?php echo e($student->surname.' '.$student->othernames); ?> from taking this subject ?" 
                                          data-toggle="tooltip" title="Remove student from subject" 
                                          data-id="<?php echo e($student->pivot->id); ?>" 
                                          href="<?php echo e(url('classes/aagc/subject-student/destroy')); ?>"><i class="fas fa-trash text-danger"></i></a>
                                    </td>
                                    
                                  </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                                    </tbody>
                    
                                   </table>
                                </div>
      <?php else: ?>
        <h3 class="text-center">No student found in selected subject</h3>
      <?php endif; ?>



<script type="text/javascript">
  $(document).ready(function(){
    studentDetails();
  });

</script>