<style type="text/css">
  th{
    text-align: center;
  }

  td{text-align: center;}

</style>

<?php if($aagcs): ?>
  <div class="col-xs-12">
    
    <!-- Start accordion -->
    <div id="performanceAccordion">
      <!-- Collect classes and session as accordion header -->
      <?php $__currentLoopData = $aagcs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

       <?php 
       $main_position = "";
        $aagc = App\Aagc::find($value->aagc_id); 

        $session = App\Session::find($value->session_id);
        $active = App\Aagc::active();

        $subjects = App\Assessment::studentClassSubject($student_id,$value->aagc_id,$value->session_id);

        $students = App\Assessment::classStudent($value->aagc_id,$value->student_category_id,$value->session_id,1);
         //var_dump($students);




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
                                    ?>

                                    <?php if( $last_score!= $student->gp ): ?>
                                    <?php
                                      $last_score = $student->gp;
                                      $position++;
                                    ?>
                                    
                                    <?php endif; ?>
                                    <?php if($student->id == $student_id): ?>
                                    <?php
                                    $main_position = $position
                                    ?>

                                    <?php endif; ?>

                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  <?php

        $cummulativeDivider = 0;

       ?>

       <div class="card rounded-0 no-border bottom-50" id="performance<?php echo e($x); ?>">

          <div class="card-header transparent clearfix">
             <div class="pull-left">
                 <a class="card-link" data-toggle="collapse" href="#performanceCollapse<?php echo e($x); ?>">
                     <h5>
                       <i class="os-icon text-primary os-icon-ui-23"></i> 
                       <?php echo e($aagc->group_class ? $aagc->group_class->name : ''); ?> (<?php echo e(isset($session->name) ? $session->name : ''); ?>)
                     </h5>
                 </a>
             </div>
          </div>
          <hr class="no-space">

         <!-- Class arms as accordion content -->
        <div id="performanceCollapse<?php echo e($x); ?>" class="collapse <?php echo e($x == 0 ? 'show' : ''); ?>" data-parent="#performanceAccordion">

           <!-- Collect class arms -->
          <div class="card-body">
            <?php if($subjects): ?>
              <div class="os-tabs-w">
                <div class="os-tabs-controls">
                  <ul class="nav nav-tab-sticky nav-tabs smaller">
                    <li class="nav-item active">
                      <a class="nav-link active" data-toggle="tab" href="#firstTerm<?php echo e($x+1); ?>">First term</a>
                    </li>
                      
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#secondTerm<?php echo e($x+1); ?>">Second term</a>
                    </li>
                    
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#thirdTerm<?php echo e($x+1); ?>">Third term</a>
                    </li>
                      
                    <!-- <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#cummulative<?php echo e($x+1); ?>">Cummulative</a>
                    </li> -->
                  </ul>
                    
                </div>

                
                <div class="tab-content">
                  <div class="tab-pane active" id="firstTerm<?php echo e($x+1); ?>">
                   <a href="<?php echo e(App\Assessment::printUrl($student_id,$value->aagc_id,$value->session_id,$main_position,5,1,$cummulative)); ?>">Print</a>
                     <?php if($subjects): ?>
                        
                        <table style="width: 100%;" class="table table-striped table-bordered dataTable">
                          <thead>
                            <tr>
                               <th>S/N</th>
                               <th>Subjects</th>
                               <th>1<sup>st</sup> Test</th>
                               <th>2<sup>nd</sup> Test</th>
                               <th>3<sup>rd</sup> Test</th>
                               <th>Exam</th>
                               <th>Total</th>
                               <th>Grade</th>
                               <th>Remark</th>
                            </tr>
                          </thead>
                          <tbody>
                              <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                <!-- Collect grades -->
                                <?php
                                  $score = App\Assessment::stupidLoading($subject->id,$student_id,$value->aagc_id,$value->session_id,1,false,false);
                                ?>

                                <?php if($score): ?>
                                  <?php
                                    $total = $score->test1 + $score->test2 + $score->test3 + $score->exam;
                                    $cummulativeDivider=1;
                                  ?>
                                  <tr>
                                    <td><?php echo e($i+1); ?></td>
                                    <td class="text-left"><?php echo e($subject->name); ?></td>
                                    <td><?php echo e($score->test1); ?></td>
                                    <td><?php echo e($score->test2); ?></td>
                                    <td><?php echo e($score->test3); ?></td>
                                    <td><?php echo e($score->exam); ?></td>
                                    <td><?php echo e($total); ?></td>
                                    <td><?php echo e(App\Assessment::grade($total)); ?></td>
                                    <td><?php echo e(App\Assessment::remark($total)); ?></td>
                                  </tr>
                                <?php endif; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </tbody>

                          </table>
                        
                      
                      <?php else: ?>
                        <h3 class="text-center text-danger"><i class="fas fa-trash"></i> No assessment found</h3>
                      <?php endif; ?>
                  </div>


                  <div class="tab-pane" id="secondTerm<?php echo e($x+1); ?>">
                   <a href="<?php echo e(App\Assessment::printUrl($student_id,$value->aagc_id,$value->session_id,$main_position,5,2,$cummulative)); ?>">Print</a>
                    <?php if($subjects): ?>
                        
                        <table style="width: 100%;" class="table table-striped table-bordered dataTable">
                          <thead>
                            <tr>
                               <th>S/N</th>
                               <th>Subjects</th>
                               <th>1<sup>st</sup> Test</th>
                               <th>2<sup>nd</sup> Test</th>
                               <th>3<sup>rd</sup> Test</th>
                               <th>Exam</th>
                               <th>Total</th>
                               <th>Grade</th>
                               <th>Remark</th>
                            </tr>
                          </thead>
                           <tbody>
                              <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                <!-- Collect grades -->
                                <?php
                                  $score = App\Assessment::stupidLoading($subject->id,$student_id,$value->aagc_id,$value->session_id,2,false,false);
                                ?>

                                <?php if($score): ?>
                                  <?php
                                    $total = $score->test1 + $score->test2 + $score->test3 + $score->exam;
                                    $cummulativeDivider=2;
                                  ?>
                                  <tr>
                                    <td><?php echo e($i+1); ?></td>
                                    <td class="text-left"><?php echo e($subject->name); ?></td>
                                    <td><?php echo e($score->test1); ?></td>
                                    <td><?php echo e($score->test2); ?></td>
                                    <td><?php echo e($score->test3); ?></td>
                                    <td><?php echo e($score->exam); ?></td>
                                    <td><?php echo e($total); ?></td>
                                    <td><?php echo e(App\Assessment::grade($total)); ?></td>
                                    <td><?php echo e(App\Assessment::remark($total)); ?></td>
                                  </tr>
                                <?php endif; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </tbody>

                          </table>
                        
                      
                      <?php else: ?>
                        <h3 class="text-center text-danger"><i class="fas fa-trash"></i> No assessment found</h3>
                      <?php endif; ?>
                  </div>


                  <div class="tab-pane" id="thirdTerm<?php echo e($x+1); ?>">
                   <a href="<?php echo e(App\Assessment::printUrl($student_id,$value->aagc_id,$value->session_id,$main_position,5,3,$cummulative)); ?>">Print</a>
                    <?php if($subjects): ?>
                        
                        <table style="width: 100%;" class="table table-striped table-bordered dataTable">
                          <thead>
                            <tr>
                               <th>S/N</th>
                               <th>Subjects</th>
                               <th>1<sup>st</sup> Test</th>
                               <th>2<sup>nd</sup> Test</th>
                               <th>3<sup>rd</sup> Test</th>
                               <th>Exam</th>
                               <th>Total</th>
                               <th>Grade</th>
                               <th>Remark</th>
                            </tr>
                          </thead>
                          <tbody>
                              <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                <!-- Collect grades -->
                                <?php
                                  $score = App\Assessment::stupidLoading($subject->id,$student_id,$value->aagc_id,$value->session_id,3,false,false);
                                ?>

                                <?php if($score): ?>
                                  <?php
                                    $total = $score->test1 + $score->test2 + $score->test3 + $score->exam;
                                    $cummulativeDivider=3;
                                  ?>
                                  <tr>
                                    <td><?php echo e($i+1); ?></td>
                                    <td class="text-left"><?php echo e($subject->name); ?></td>
                                    <td><?php echo e($score->test1); ?></td>
                                    <td><?php echo e($score->test2); ?></td>
                                    <td><?php echo e($score->test3); ?></td>
                                    <td><?php echo e($score->exam); ?></td>
                                    <td><?php echo e($total); ?></td>
                                    <td><?php echo e(App\Assessment::grade($total)); ?></td>
                                    <td><?php echo e(App\Assessment::remark($total)); ?></td>
                                  </tr>
                                <?php endif; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </tbody>

                          </table>
                        
                      
                      <?php else: ?>
                        <h3 class="text-center text-danger"><i class="fas fa-trash"></i> No assessment found</h3>
                      <?php endif; ?>
                  </div>


                </div>

              </div>
            <?php else: ?>
              <h3 class="text-center text-danger"><i class="fas fa-trash"></i> No assessment found</h3>
            <?php endif; ?>
          </div>
        </div>

       </div>

     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   </div>
  </div>
<?php else: ?>
  <h3 class="alert alert-danger text-center">No data found</h3>
<?php endif; ?>