
              <div class="element-box"> 
                <h1>Update Performance</h1>
                              <?php if( count($students) > 0 ): ?>
                              <form method="post" onsubmit="oisForm(event)" action="<?php echo e(url('extra/update-many-club-report')); ?>">

                                <div class="formAlert"></div>

                              <div class="table-responsive">
                               <table class="table table-lightborder">
                                  <thead>
                                    <tr>
                                      <th>S/N</th>
                                      <th>Student's ID</th>
                                      <th>Name</th>
                                      <th>Performance Score</th>
                                    </tr>
                                  </thead>
                                  <tbody>



                                       <input type="hidden" name="session_id" value="<?php echo e($session_id); ?>" /> 
                                       <input type="hidden" name="term_id" value="<?php echo e($term_id); ?>" /> 
                                       <input type="hidden" name="club_id" value="<?php echo e($club_id); ?>" /> 

                                <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                                  

                                  <tr>
                                    <td><?php echo e($x+1); ?>

                                  <input type="hidden" name="student_id[]" value="<?php echo e($student->student_id); ?>" />

                                       <input type="hidden" name="aagc_id[]" value="<?php echo e($student->aagc_id); ?>" /> 
                                       <input type="hidden" name="category_id[]" value="<?php echo e($student->student_category_id); ?>" /> </td>
                                    <td><a class="studentDetails" href="<?php echo e(url('students/show/'.$student->student_id)); ?>"><?php echo e($student->admission_no); ?></a></td>
                                    <td><?php echo e($student->surname.' '.$student->othernames); ?></td>

                                    <td><input placeholder="Principal's comment" value="<?php echo e($student->performance); ?>" class="form-control" type="number" name="performance[]" type="number" /></td>
                                    
                                  </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                                    </tbody>
                    
                                   </table>
                                </div>

                                <button class="btn btn-primary" type="submit"><i class="fas fa-check-circle"></i> Update Report</button>

                              </form>

                              <?php else: ?>
                                  <h3 class="text-center text-danger"> <i class="fa fa-warning"></i> No active student found! </h3>
                              <?php endif; ?>
                            
                    </div>

<script type="text/javascript">
  $(document).ready(function(){
    formProcessor();
    studentDetails();
  });
</script>