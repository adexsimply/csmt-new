<?php $__env->startSection('title','Cummulative assessment'); ?>
<?php $__env->startSection('content'); ?>

<style type="text/css">
  th{
    text-align: center;
  }
  td{
    text-align: center;
  }

</style>

          <div class="content-i">
            <div class="content-box">
                <div class="element-wrapper">
                    
                    <h3 class="element-header">
                      <?php echo App\Aagc::name($aagc_id); ?> <?php echo e(App\Student::categoryName($category_id)); ?>


                      <?php
                          if($cummulative)
                            echo 'Cummulative result';

                          else if($term_id)
                            echo App\Term::find($term_id)->name.' result';

                       ?>

                     <!--  <div class="btn-group float-right">  


                        <a href="<?php echo e(url('assessments/cummulative/'.$aagc_id.'/'.$session_id)); ?>" class="btn btn-primary"><i class="fas  fa-bar-chart"></i> Cummulative </a>

                      </div> -->
                      <a target="_blank" href="<?php echo e(url('assessments/class-master-sheet-printer/'.$aagc_id.'/'.$category_id.'/'.$session_id.'/'.$term_id)); ?>"><button class="btn btn-danger">Print Master Sheet</button></a>
                      <a target="_blank" href="<?php echo e(url('assessments/class-result-standing-printer/'.$aagc_id.'/'.$category_id.'/'.$session_id.'/'.$term_id)); ?>"><button class="btn btn-success">Print Result Standing</button></a>
                        <!-- <a href="#" class="moreOption float-right"><i class="fas  fa-search"></i>  </a> -->
                      <a target="_blank" href="<?php echo e(url('assessments/class-assessment-pdf/'.$aagc_id.'/'.$category_id.'/'.$session_id.'/'.$term_id)); ?>"><button class="btn btn-primary">Print PDF</button></a>
                        <a href="#" class="moreOption float-right"><i class="fas  fa-search"></i>  </a>

                    </h3>

                    

                    <div class="element-box">


                     
                     <?php if( Addon::isEmpty($students)): ?>

                     <div class="table-responsive">
                      
                        <table class="table dataTableFull table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Students' ID</th>
                                    <th class="text-left">Name</th>
                                    <th>Position</th>
                                    <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <th><?php echo e($subject->name); ?></th>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <th>Total</th>
                                    <th class="no-print">Print</th>
                                </tr>
                            </thead>
                            <tbody>
                           <?php


                                  //$rank = 0;
                                  $last_score = false;
                                  $rows = 0;

                                  //$previousScore=0;
                                  $position = 0;
                                  //$doublePosition = false;
                               ?>
                              <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php 

                                  $rows++;

                                    if( $last_score!= $student->gp ){
                                      $last_score = $student->gp;
                                      $position++;
                                    }
                                      
                                      // if($x == 0){
                                      //   $position= $x +1;
                                      //   $previousScore = $student->gp; 
                                      // }

                                      // else {

                                      //   if($previousScore == $student->gp){
                                      //     $previousScore = $student->gp;
                                      //     $doublePosition = true; 
                                      //   }
                                      //   else{
                                            
                                      //       if($doublePosition){
                                      //           $position = $x;
                                      //       } else{
                                      //           $position = $x + 1;
                                      //       }
                                          
                                      //     $previousScore = $student->gp;
                                      //   }

                                      // }


                                  ?>
                                <tr>
                                  <td><?php echo e($x+1); ?></td>
                                  <td><a onclick="oisRead(event)" data-type="purple" href="<?php echo e(url('students/show/'.$student->id)); ?>"><?php echo e($student->admission_no); ?></a></td>
                                  <td class="text-left"><?php echo e($student->surname.' '.$student->othernames); ?></td>
                                  <td><?php echo Addon::position($position); ?></td>

                                  <?php $total=0 ?>

                                  <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <td>

                                      <?php
                                        $score =  App\Assessment::stupidLoading($subject->id,$student->id,$aagc_id,$session_id,$term_id);
                                        $total+=$score;
                                        
                                      ?>

                                      <?php echo e($score); ?>


                                    </td>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                  <td><?php echo e($total); ?></td>


                                  <td class="text-center no-print">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('print report')): ?>

                                        <a target="_blank" href="<?php echo e(App\Assessment::printUrl($student->id,$aagc_id,$session_id,$position,$group_class_id,$term_id,$cummulative)); ?>"><i class="fas  fa-print"></i></a>

                                    <?php endif; ?>
                                    
                                  </td>
                                </tr>

                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                            </tbody>
                              

                        </table>

                      </div>

                      <?php else: ?> 
                        <h3 class="text-center">No assessment found!</h3>
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
          <form method="get" action="<?php echo e(url('assessments/class-assessment-printer')); ?>">

                        

                      

                        
                        <div class="form-group">
                          <select class="form-control classOptions"></select>
                        </div>

                        
                        <div class="form-group">
                          <select class="form-control fullArmOptions" required="" name="aagc_id"></select>
                        </div>
                        
                        <div class="form-group">
                          <select class="form-control sessionOptions" required="" name="session_id"></select>
                        </div>

                        <div class="form-group">
                          <select class="form-control termOptions" required="" name="term_id"></select>
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


<?php

    $group_class_id = App\Aagc::find($aagc_id)->group_class->id;

?>


<?php $__env->startSection('script'); ?>
  

  <script type="text/javascript">
    $(document).ready(function(){


      $('.dataTableFull').DataTable({
      // "processing": true,
      // "ajax": 'server.php',
      "dom": 'lBfrtip',
      // "pageLength": 100,
      "bPaginate": false,
      // "responsive": true,
      "fixedHeader": true,
      "buttons": [
            {
                extend: 'collection',
                text: 'Export',
                buttons: [
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ]

    });


      $(".moreOption").click(function(e){
        e.preventDefault();
        sessionOptions('<?php echo e($session_id); ?>');
        termOptions('<?php echo e($term_id); ?>');
        classOptions('<?php echo e($group_class_id); ?>');
        fullArmOptions('<?php echo e($group_class_id); ?>','<?php echo e($aagc_id); ?>');


        $(".classOptions").change(function(){
          var group_class_id = $(this).val();
          fullArmOptions(group_class_id);
        });
  

        $("#moreOption").modal('show');
      });

    });
  </script>
<?php $__env->stopSection(); ?>





<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>