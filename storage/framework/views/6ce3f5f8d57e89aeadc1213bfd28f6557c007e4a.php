
<?php $__env->startSection('title','Subject assessment'); ?>
<?php $__env->startSection('content'); ?>

  <ul class="breadcrumb">
             <li class="breadcrumb-item">
              <a href="<?php echo e(url('home')); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
              <a href="<?php echo e(url('classes')); ?>">All classes</a>
            </li>
            <li class="breadcrumb-item">
              <span><?php echo e($subject->name); ?> assessments</span>
            </li>
          </ul>
          <!--------------------
          END - Breadcrumbs
          -------------------->
          <div class="content-i">
            <div class="content-box">
                <div class="element-wrapper">
                    <h5 class="element-header">
                  &nbsp;&nbsp;  <a target="_blank" href="<?php echo e(url('assessments/printer-continuous/'.$subject->id.'/'.$aagc_id.'/'.$category_id.'/'.$session_id)); ?>"><button class="btn btn-danger float-right">Print</button></a>&nbsp;
                      <?php echo App\Aagc::name($aagc_id); ?> <?php echo e(App\Student::categoryName($category_id)); ?> <?php echo e($subject->name); ?> Assessment
                      <a href="#" class="moreOption float-right"><i class="fa fa-search"></i> More Options </a>&nbsp;
                    </h5>



                    <!-- <div class="element-box">
                     
                    </div> -->

                    <div class="element-box table-responsive">


                     
                     <?php if(Addon::isEmpty($assessments)): ?>
                      
                        <table style="width: 100%;" class="table table-striped table-bordered dataTable">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Student's ID</th>
                                    <th>Name</th>
                                    <th>1<sup>st</sup> Test</th>
                                    <th>2<sup>nd</sup> Test</th>
                                    <th>3<sup>rd</sup> Test</th>
                                    <th>Micro Exam</th>
                                    <th>Practical</th>
                                    <th>Exam</th>
                                    <th>Total</th>
                                    <th>Grade</th>
                                    <th>Remark</th>
                                    <th class="no-print">Options</th>
                                </tr>
                            </thead>
                            <tbody>

                              <?php $__currentLoopData = $assessments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $assessment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <?php

                                    $test1 = $assessment->test1;
                                    $test2 = $assessment->test2;
                                    $test3 = $assessment->test3;
                                    $microexam = $assessment->micro_exam;
                                    $practical = $assessment->practical;
                                    $exam = $assessment->exam;


                                    $gp = App\Assessment::gradeHelper($test1,$test2,$test3,$microexam,$practical,$exam);

                                   ?>
                                <tr id="<?php echo e($assessment->id); ?>">
                                  <td><?php echo e($x+1); ?></td>
                                  <td><a class="studentDetails" href="<?php echo e(url('students/show/'.$assessment->student_id)); ?>"><?php echo e($assessment->admission_no); ?></a></td>
                                  <td><?php echo e($assessment->surname.' '.$assessment->othernames); ?></td>
                                  <td><?php echo e(!is_null($test1) ? $test1 : '-'); ?></td>
                                  <td><?php echo e(!is_null($test2) ? $test2 : '-'); ?></td>
                                  <td><?php echo e(!is_null($test3) ? $test3 : '-'); ?></td>
                                  <td><?php echo e(!is_null($microexam) ? $microexam : '-'); ?></td>
                                  <td><?php echo e(!is_null($practical) ? $practical : '-'); ?></td>
                                  <td><?php echo e(!is_null($exam) ? $exam : '-'); ?></td>
                                  <td><?php echo e(round($assessment->gp,2)); ?></td>
                                  <td><?php echo e($assessment->grade); ?></td>
                                  <td><?php echo e($assessment->remark); ?></td>
                                  <td class="no-print">

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete report')): ?>
                                      <a onclick="oisDelete(event)" href="<?php echo e(url('assessments/destroy')); ?>" data-id="<?php echo e($assessment->id); ?>"  class="text-danger delete" href="#" title="Delete">
                                        <i class="fas fa-trash"></i>
                                      </a>
                                    <?php endif; ?>
                                    &nbsp;
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit report')): ?>
                                      <a href="<?php echo e(url('assessments/edit/'.$assessment->id)); ?>" title="Edit" class="edit">
                                        <i class="fas fa-edit"></i>
                                      </a>
                                    <?php endif; ?>
                                  </td>
                                </tr>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>

                        </table>
                      
                    
                    <?php else: ?>
                      <h3 class="text-center text-danger"><i class="fas fa-trash"></i> No assessment found</h3>
                    <?php endif; ?>

                    </div>
                </div>
              

              
            </div>
          </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('modal'); ?>
  <!-- Create new subject modal -->
  <div class="modal fade" id="moreOption">
    <div class="modal-dialog modal-md ">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-name">Fetch assessment</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form method="get" action="<?php echo e(url('assessments/printer')); ?>">

                        

                        <input type="hidden" name="aagc_id" value="<?php echo e($aagc_id); ?>" />

                        
                        <div class="form-group">
                          <select class="form-control sessionOptions" required="" name="session_id"></select>
                        </div>

                        <div class="form-group">
                          <select class="form-control termOptions" required="" name="term_id"></select>
                        </div>

                         <div class="form-group">
                            <select name="subject_id" required="" class="form-control subjectOptions"></select>
                         </div>

                         <input type="hidden" name="category_id" value="<?php echo e($category_id); ?>">

                        <div class="form-group">
                          <button class="btn btn-primary" type="submit">View Result</button>

                          
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

      $("#table").DataTable();


      $(".moreOption").click(function(e){
        e.preventDefault();
        sessionOptions('<?php echo e($session_id); ?>');
        termOptions('<?php echo e($term_id); ?>');
        var value = '<?php echo e($aagc_id); ?>';
        subjectOptions('<?php echo e($subject->id); ?>','id IN (SELECT subject_id FROM aagc_subject WHERE aagc_id='+value+')');

        $("#moreOption").modal('show');
      });


      $(".edit").click(function(e){
          e.preventDefault();
          var url = $(this).attr('href');
          
          $.dialog({
              content: function () {
                  var self = this;
                  return $.ajax({
                      url: url,
                      method: 'get',
                  }).done(function (data) {
                      self.setContent(data);
                      self.setTitle('Edit Assessment');
                  }).fail(function(){
                      self.setContent('Something went wrong');
                  });
              },
              columnClass: 'm',
          });


      });

    });
  </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>