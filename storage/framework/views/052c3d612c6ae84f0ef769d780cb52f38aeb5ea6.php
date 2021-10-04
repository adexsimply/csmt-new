<?php $__env->startSection('title','Student result pin'); ?>
<?php $__env->startSection('content'); ?>

          <!--
          END - Breadcrumbs
          -->
          <div class="content-i">
            <div class="content-box">
              <div class="element-wrapper compact pt-4">
                <div class="element-wrapper">
                  
                    <div class="element-header clearfix">
                      <h4>Bulk sms pin</h4>
                      
                      <?php echo $__env->make('components.sms-menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                    <?php echo e($term_name); ?>

                    <div class="element-box">
                      <?php if($pins): ?>
                      <table class="table table-padded dataTable">
                        <thead>
                          <th>SN</th>
                          <th>Student ID</th>
                          <th>Student name</th>
                          <th>Pin</th>
                          <th>Phone number</th>
                        </thead>
                        <tbody>
                          <?php $__currentLoopData = $pins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $pin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                              <td><?php echo e($x+1); ?></td>
                              <td><?php echo e($pin->admission_no); ?></td>
                              <td><?php echo e($pin->surname.' '.$pin->othernames); ?></td>
                              <td><?php echo e($pin->pin); ?></td>
                              <td><?php echo e($pin->phone); ?></td>
                            </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                      </table> 
                      <?php else: ?>
                        <h1 class="text-danger text-center"><i class="fas fa-trash"></i> No pin found</h1>
                      <?php endif; ?>
                    </div>

                    
                </div>
              </div>
              

              
            </div>
          </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>