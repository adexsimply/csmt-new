

<?php $__env->startSection('content'); ?>

	<ul class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?php echo e(url('home')); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
              <span>Testimonials</span>
            </li>
          </ul>
          <!--
          END - Breadcrumbs
          -->
          <div class="content-i">
            <div class="content-box">
              <div class="element-wrapper compact pt-4">
                <div class="element-wrapper">
                    

                    <div class="element-header clearfix">
                      <h4>Existing Student Testimonial</h4>

                      <!-- Page menu -->
                      <div style="z-index: 999; margin-top: -25px;" class="pull-right os-dropdown-trigger os-dropdown-position-left">
                        <i class="fas fa-ellipsis-h fa-2x"></i>
                        <div class="os-dropdown bg-primary">
                          <ul>

                            <li>
                              <a onclick="oisNew(event)" data-type="purple" data-title="Create existing student testimonial" href="<?php echo e(url('testimonials/create')); ?>">
                                <i class="fas fa-user-plus"></i> Existing Student
                              </a>
                            </li>

                            <li>
                              <a onclick="oisNew(event)" data-type="purple" data-title="Create old student testimonial" href="<?php echo e(url('old-testimonials/create')); ?>">
                                <i class="fas fa-user-plus"></i> Old Student
                              </a>
                            </li>

                            
                          </ul>
                        </div>
                      </div>

                       
                    </div>

                    
                   
                    
                        <div class="element-box">
                         
                          <?php if($testimonials): ?>
                           <table id="table" class="table table-bordered">
                             <thead class="text-primary">
                               <tr>
                                 <th>SN</th>
                                 <th>Admission No:</th>
                                 <th>Name</th>
                                 <th>Admitted Session</th>
                                 <th>Graduated Session</th>
                                 <th>Action</th>
                               </tr>
                             </thead>
                             <tbody>
                               <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <?php
                                    $name = $testimonial->student->surname.' '.$testimonial->student->othernames
                                  ?>

                                  <tr id="<?php echo e($testimonial->id); ?>">

                                    <td><?php echo e($x+1); ?></td>

                                    <td><a class="studentDetails" href="<?php echo e(url('students/show/'.$testimonial->student->id)); ?>"><?php echo e($testimonial->student->admission_no); ?></a></td>

                                    <td><?php echo e($name); ?></td>
                                    <td><?php echo e($testimonial->session_admitted); ?></td>
                                    <td><?php echo e($testimonial->session_graduated); ?></td>
                                    <td>

                                      
                                      <a href="<?php echo e(url('testimonials/print/'.$testimonial->id)); ?>"><i class="fas fa-print"></i> </a> &nbsp;

                                      <a onclick="oisEdit(event)" data-type="purple" data-title="Edit <?php echo e($name); ?> testimonial" class="text-success" href="<?php echo e(url('testimonials/edit/'.$testimonial->id)); ?>"><i class="fas fa-edit"></i> </a> &nbsp;



                                      <a onclick="oisDelete(event)" class="text-danger" data-id="<?php echo e($testimonial->id); ?>" href="<?php echo e(url('testimonials/delete')); ?>"><i class="fas fa-times-circle"></i> </a>
                                    </td>
                                  </tr>
                                  
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             </tbody>
                           </table>
                          <?php else: ?>
                            <h3 class="alert alert-danger"><i class="fas fa-trash"></i> No data found </h3>
                          <?php endif; ?>
                             



                        </div>

                    
                </div>
              </div>
              

              
            </div>
          </div>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('script'); ?>
	<script type="text/javascript">
		$(document).ready(function(){
      
      $("#table").DataTable();

      $(".edit").click(function(e){
          e.preventDefault();
          var url = $(this).attr('href');

          dialog(url,'Update Testimonial','l');
      });


      $(".createNewTestimonial").click(function(e){
          e.preventDefault();
          var url = $(this).attr('href');

          dialog(url,'Create new Testimonial','l');
      });


		});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>