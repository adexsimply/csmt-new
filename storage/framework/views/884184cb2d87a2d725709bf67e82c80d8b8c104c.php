    <?php if(Addon::isEmpty($students)): ?>
      <style type="text/css">
        th{
          text-align: center;
        }

        
      </style>

            
            <div class="table-responsive">
            
            <table id="table" class="table">
                <thead class="text-primary">
                    <tr>
                      <th class="text-center"><i class="fas fa-arrow-down"></i> S/N</th>
                      <th><i class="fas fa-user"></i> Student's ID</th>
                      <th><i class="fas fa-user-circle"></i> Name</th>
                      <th><i class="fas fa-user-tie"></i> Parent's Name</th>
                      <th><i class="fas fa-phone"></i> Phone number</th>
                      <th><i class="fas fa-calendar"></i> Birthday</th>
                      <th><i class="fas fa-users"></i> Current class</th>
                    </tr>
                </thead>
                <tbody>
                   <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td class="text-center"><?php echo e($x+1); ?></td>

                        <td><a data-type="purple" data-title="<?php echo e($student->surname.' '.$student->othernames); ?> details" data-size="l" onclick="oisRead(event)" href="<?php echo e(url('students/show/'.$student->id)); ?>"><?php echo e($student->admission_no); ?></a></td>

                        <td><a data-type="purple" data-title="<?php echo e($student->surname.' '.$student->othernames); ?> details" data-size="l" onclick="oisRead(event)" href="<?php echo e(url('students/show/'.$student->id)); ?>"><?php echo e($student->surname.' '.$student->othernames); ?></a></td>

                        <td><?php echo e($student->parent); ?></td>
                        <td><?php echo e($student->phone1.', '.$student->phone2); ?></td>

                        <td><span class="badge badge-success"><?php echo e($student->dob); ?></span></td>
                        <td><?php echo e($student->current_class.' ('.$student->arm.')'); ?></td>
                      </tr>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                            
                </tbody>
            </table>


            </div> 
            
          <?php else: ?>

            <h3 class="text-center text-danger"><i class="fas fa-trash"></i> No data found</h3>

          <?php endif; ?>

