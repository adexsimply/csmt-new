
              <div class="element-box"> 
                              <form method="post" onsubmit="oisForm(event)" action="<?php echo e(url('extra/store-club-report')); ?>">

                                <div class="formAlert"></div>
                <h1>Comment Club</h1>

                              <div class="table-responsive">
                               <table class="table table-lightborder">
                                  <thead>
                                    <tr>
                                      <th>S/N</th>
                                      <th>Student's ID</th>
                                      <th>Name</th>
                                      <th>Performance</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                       <input hidden="" name="session_id" value="<?php echo e($session_id); ?>" /> 
                                       <input hidden="" name="term_id" value="<?php echo e($term_id); ?>" /> 
                                       <input hidden="" name="club_id" value="<?php echo e($club_id); ?>" /> 


                                <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                                  

                                  <tr>
                                    <td><?php echo e($x+1); ?>

                                        <input hidden="" name="student_id[]" value="<?php echo e($student->id); ?>" />

                                       <input hidden="" name="aagc_id[]" value="<?php echo e($student->aagc_id); ?>" /> 
                                       <input hidden="" name="category_id[]" value="<?php echo e($student->student_category_id); ?>" /> 
                                  </td>
                                    <td><a class="studentDetails" href="<?php echo e(url('students/show/'.$student->id)); ?>"><?php echo e($student->admission_no); ?></a></td>
                                    <td><?php echo e($student->surname.' '.$student->othernames); ?></td>

                                    <td><input placeholder="Principal's comment" value="<?php echo e(rand(20,100)); ?>" class="form-control" type="number" name="performance[]" type="number" /></td>
                                    
                                  </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                                    </tbody>
                    
                                   </table>
                                </div>

                                <button class="btn btn-primary" type="submit"><i class="fas fa-check-circle"></i> Submit Report</button>

                              </form>
                    </div>

<script type="text/javascript">
  $(document).ready(function(){
    formProcessor();
    studentDetails();
  });
</script>