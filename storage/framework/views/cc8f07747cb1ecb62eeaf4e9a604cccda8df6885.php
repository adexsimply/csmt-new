<?php $__env->startSection('title','House students'); ?>
<?php $__env->startSection('content'); ?>

          <!--
          END - Breadcrumbs
          -->
          <div class="content-i">
            <div class="content-box">
              <div class="element-wrapper compact pt-4">
                <div class="element-wrapper">
                  
                    <div class="element-header clearfix">
                      <h4>House students</h4>
                    </div>

                    <div class="element-box">
                      <?php if($students): ?>
                      <table class="table table-striped table-bordered dataTable" style="width:100%">
                        <thead>
                          <th>ID</th>
                          <th>Student ID</th>
                          <th>Name</th>
                          <th>Gender</th>
                          <th>Class</th>
                        </thead>

                        <tbody>
                          <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                              <td><?php echo e($x+1); ?></td>
                              <td><?php echo e($student->admission_no); ?></td>
                              <td><?php echo e($student->surname.' '.$student->othernames); ?></td>
                              <td><?php echo e($student->gender); ?></td>
                              <td><?php echo e($student->current_class.''.$student->arm); ?></td>
                            </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                      </table>
                      <?php else: ?>
                        <h1 class="text-danger"><i class="fas fa-trash"></i> No student found! </h1>
                      <?php endif; ?>
                    </div>

                    
                </div>
              </div>
              

              
            </div>
          </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>