

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
                    

                    <h4 class="element-header clearfix">
                      Student Testimonial

                       <div class="btn-group float-right">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                           New Testimonial
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item createNewTestimonial" href="<?php echo e(url('old-testimonials/create')); ?>">Existing Student</a>
                          <a class="dropdown-item createNewTestimonial" href="<?php echo e(url('old-testimonials/create')); ?>">Old Student</a>
                        </div>
                      </div>
                    </h4>

                    
                   
                    
                        <div class="element-box">

                         
                         <div class="table-responsive">

                         <table class="table table-bordered dataTable">
                           <thead class="text-primary">
                             <tr>
                               <th>SN</th>
                               <th>Name</th>
                               <th>Admitted Session</th>
                               <th>Graduated Session</th>
                               <th>Action</th>
                             </tr>
                           </thead>
                           <tbody>
                             <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr id="<?php echo e($testimonial->id); ?>">
                                  <td><?php echo e($x); ?></td>
                                  <td><?php echo e($testimonial->name); ?></td>
                                  <td><?php echo e($testimonial->session_admitted); ?></td>
                                  <td><?php echo e($testimonial->session_graduated); ?></td>
                                  <td>

                                    <a target="_blank" href="<?php echo e(url('old-testimonials/print/'.$testimonial->id)); ?>"><i class="fa fa-print"></i> </a>



                                    <a class="edit text-success" target="_blank" href="<?php echo e(url('old-testimonials/edit/'.$testimonial->id)); ?>"><i class="fa fa-edit"></i> </a>



                                    <a class="delete text-danger" data-id="<?php echo e($testimonial->id); ?>" href="<?php echo e(url('old-testimonials/delete')); ?>"><i class="fa fa-times-circle"></i> </a>
                                  </td>
                                </tr>
                                <?php ($x++); ?>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           </tbody>
                         </table>
                       </div>
                           



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