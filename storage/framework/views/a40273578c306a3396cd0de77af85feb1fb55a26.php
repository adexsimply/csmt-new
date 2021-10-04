

<?php $__env->startSection('title','Clinic'); ?>
<?php $__env->startSection('content'); ?>

	<ul class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo e(url('home')); ?>">Dashboard</a>
      </li>
      <li class="breadcrumb-item">
        <span>Clinic Attendance</span>
      </li>
      </ul>
      <!-- 
      END - Breadcrumbs
      -->
      <div class="content-i">
      <div class="content-box">
        <div class="element-wrapper">
          <div class="element-box">
            <div class="element-header">

              <h3>
                Student's List
              </h3>


             <!-- Page menu -->



            </div>

              <?php if(count($students) > 0 ): ?>
              <div class="table-responsive">
              <table class="table table-striped table-bordered dataTable" style="width:100%">
                <thead class="text-primary">
              <tr>
                <th class="text-center"><i class="fas fa-level-down"></i> S/N</th>
                <th><i class="fas fa-user"></i> Student's ID</th>
                <th><i class="fas fa-user-circle"></i> Name</th>
                <th><i class="fas fa-users"></i> Current class</th>
                <th><i class="fas fa-user-tie"></i> Parent's phone</th>
                <th><i class="fas fa-tint"></i> Status</th>
                <th><i class="fas fa-plug"></i> Actions</th>
              </tr>
                </thead>
                <tbody>

              <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>



              <tr id="student<?php echo e($student->id); ?>">
                <td class="text-center"><?php echo e($x+1); ?></td>
                <td><a data-type="purple" data-title="<?php echo e($student->surname.' '.$student->othernames); ?> details" data-size="l" onclick="oisRead(event)" href="<?php echo e(url('students/show/'.$student->id)); ?>"><?php echo e($student->admission_no); ?></a></td>

                <td><a data-type="purple" data-title="<?php echo e($student->surname.' '.$student->othernames); ?> details" data-size="l" onclick="oisRead(event)" href="<?php echo e(url('students/show/'.$student->id)); ?>"><?php echo e($student->surname.' '.$student->othernames); ?></a></td>

                <td><?php echo e($student->current_class.' '.$student->arm); ?></td>

                <td><?php echo e($student->phone1); ?></td>

                <td>
             <a data-student_id="<?php echo e($student->id); ?>" href="<?php echo e(url('students/status')); ?>" class="changeStatus"><?php echo App\Student::status($student->status); ?></a> 
                </td>
                <td class="text-center">

                  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit student')): ?>
                  <a data-type="purple" data-title="Mark Clinic Attendance for <?php echo e($student->surname.' '.$student->othernames); ?>" data-size="xl" onclick="oisEdit(event)" href="<?php echo e(url('clinic/edit/'.$student->id)); ?>" title="Edit student"><i class="fas fa-edit"></i>Mark</a> &nbsp;
                  <?php endif; ?>
                    <a href="<?php echo e(url('clinic/show/'.$student->id)); ?>" onclick="oisRead(event)" data-type="purple" data-title="<?php echo e($student->surname.' '.$student->othernames); ?> Clinic Attendance" data-size="xl">
                      <i class="fas fa-eye"></i>
                    </a>

                </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              
              
                </tbody>
                
              </table>

                <?php echo e($students->links()); ?>

              
              </div> 

              

              <?php else: ?> 
              <div class="text-center">
                <h3>No student found</h3>

                <a onclick="oisNew(event)" data-type="purple" data-size="xl" data-title="Register new student" class="btn full-registration btn-outline-primary" href="<?php echo e(url('students/full-registration')); ?>">Register New Student</a>
              </div>
              <?php endif; ?>
              

            
          </div>
      </div>
        

        
      </div>
      </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('modal'); ?>
  <!-- Create new subject modal -->
  <div class="modal fade" id="filterStudent">
    <div class="modal-dialog modal-md ">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-name">Filter student</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form method="get" action="<?php echo e(url('students/filter')); ?>">
              
             <div class="form-group">
               <select name="group_class_id" class="form-control classOptions"></select>
             </div>

             
             <div class="form-group">
               <select class="form-control fullArmOptions" name="aagc_id"></select>
             </div>
             
             <div class="form-group">
               <select class="form-control" name="category_id">
                 <option value="1">Boarding</option>
                 <option value="2">Day</option>
               </select>
             </div>
             
             <div class="form-group">
               <select class="form-control sessionOptions" name="session_id"></select>
             </div>
             
             <div class="form-group">
               <select class="form-control clubOptions" name="club_id"></select>
             </div>

             <div class="form-group">
               <button class="btn btn-primary" type="submit"><i class="fas fa-eye"></i> View students</button>

               
             </div>

                  


                  </form>
        </div>

      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
	<script type="text/javascript">
		$(document).ready(function(){

      // $("#studentTable").DataTable();
      
      if(hash = location.hash){
       
        $(hash).trigger('click');
       
      }


      $(".filterStudent").click(function(e){
        e.preventDefault();
        sessionOptions();
        classOptions();
        clubOptions();


        $(".classOptions").change(function(){
          var group_class_id = $(this).val();
          fullArmOptions(group_class_id);
        });
  

        $("#filterStudent").modal('show');
      });


		});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>