
              <div class="element-box"> 
                              <form method="post" onsubmit="oisForm(event)" action="<?php echo e(url('comments/store')); ?>">

                                <div class="formAlert"></div>

                              <div class="table-responsive">
                               <table class="table table-lightborder">
                                  <thead>
                                    <tr>
                                      <th>S/N</th>
                                      <th>Student's ID</th>
                                      <th>Name</th>
                                      <th>Principal's Comment</th>
                                      <th>Teacher's Comment</th>
                                      <th>Hostel Parent's Comment</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                 <input type="hidden" name="aagc_id" value="<?php echo e($aagc_id); ?>" /> 
                                 <input type="hidden" name="session_id" value="<?php echo e($session_id); ?>" /> 
                                 <input type="hidden" name="term_id" value="<?php echo e($term_id); ?>" /> 
                                 <input type="hidden" name="category_id" value="<?php echo e($category_id); ?>" /> 

                                <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                                  <input type="hidden" name="student_id[]" value="<?php echo e($student->id); ?>" />
                                  

                                  <tr>
                                    <td><?php echo e($x+1); ?></td>
                                    <td><a class="studentDetails" href="<?php echo e(url('students/show/'.$student->id)); ?>"><?php echo e($student->admission_no); ?></a></td>
                                    <td><?php echo e($student->surname.' '.$student->othernames); ?></td>

                                    <td><input placeholder="Principal's comment" class="form-control" name="principal_comment[]" type="text" /></td>

                                    <td><input placeholder="Teacher's comment" class="form-control" name="teacher_comment[]" type="text"/></td>

                                    <td><input placeholder="Hostel parent's comment" class="form-control" name="hostel_comment[]" type="text"/></td>
                                    
                                  </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                                    </tbody>
                    
                                   </table>
                                </div>

                                <button class="btn btn-primary" type="submit"><i class="fas fa-check-circle"></i> Submit comment</button>

                              </form>
                    </div>

<script type="text/javascript">
  $(document).ready(function(){
    formProcessor();
    studentDetails();
  });
</script>