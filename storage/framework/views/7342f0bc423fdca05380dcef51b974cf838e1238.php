                      <div class="element-box">
                        <?php if(count($students) > 0 ): ?>
                          
                          <?php if($term_id == 3): ?>
                        <form onsubmit="oisForm(event)" method="post" action="<?php echo e(url('classes/aagc/promotion')); ?>">

                          <div class="formAlert"></div>

                          <?php echo e(@csrf_field()); ?>


                          <input type="hidden" name="old_aagc_id" value="<?php echo e($aagc_id); ?>" />

                          <input type="hidden" name="old_session_id" value="<?php echo e($session_id); ?>" />



                          <div class="form-group">
                            <label>Select next session</label>
                            <select class="form-control sessionOptions" required="" name="session_id"></select>
                          </div>


                              <div class="table-responsive">
                                <table class="table table-lightborder">
                                  <thead>
                                    <tr>
                                      <th>S/N</th>
                                      <th>Student's ID</th>
                                      <th>Name</th>
                                      <th>Score</th>
                                      <th>Average</th>
                                      <th>Promotion Status</th>
                                      <th>Next class</th>
                                      <th>Next class arm</th>
                                    </tr>
                                  </thead>
                                  <tbody>


                                <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <input type="hidden" name="student_id[]" value="<?php echo e($student->student_id); ?>" />
                                <input type="hidden" name="student_category_id" value="<?php echo e($student->student_category_id); ?>" />
                                  <tr>
                                    <td><?php echo e($x+1); ?></td>

                                    <td><a class="studentDetails" href="<?php echo e(url('students/show/'.$student->student_id)); ?>"><?php echo e($student->admission_no); ?></a></td>

                                    <td><?php echo e($student->surname.' '.$student->othernames.' '.$student->status); ?></td>
                                    <td><?php echo e($student->totalScore); ?></td>
                                    <td><?php echo e(round($student->totalScore / $student->totalSubject,2)); ?></td>
                                    
                                    <td>
                                      <?php
                                      $promotion_status = App\Assessment::getPromotionStatus($aagc_id,$session_id,$student->student_id);
                                       // if(!empty($promotion_status)) {
                                       //  echo $promotion_status->promotion_status;
                                       //  }
                                       //  else {
                                       //    echo "NOT SET";
                                       //  }
                                     

                                      ?>
                                      <select name="promotion_status[]" class="form-control" required="">
                                        <?php if (!empty($promotion_status) && ($promotion_status->promotion_status!=0)) { ?>
                                        <option value="<?php echo $promotion_status->promotion_status ?>">
                                          <?php if ($promotion_status->promotion_status==1) { echo "Promoted"; } else { echo "Promoted on Trial";} ?></option>
                                        <?php } ?>
                                        <option></option>
                                        <option value="1">Promoted</option>
                                        <option value="2">Promoted on trial</option>
                                        <option value="0">Repeat</option>
                                      </select>
                                    </td>

                                    <td><select class="form-control classOptions"></select></td>
                                    <td><select name="aagc_id[]" class="form-control fullArmOptions"></select></td>
                                  </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                    
                                   </table>
                                </div>

                                <button class="btn btn-primary" type="submit"> Submit promotion </button>
                            </form>

                            <?php else: ?>
                                <h3 class="text-danger text-center"><i class="fa fa-warning"></i> Promotion not available until the end of third term... </h3>
                            <?php endif; ?>


                            <?php else: ?>
                              <h3 class="text-danger text-center"><i class="fa fa-warning"></i> No Student available for promotion... </h3>
                            <?php endif; ?>


                            </div>


  <script type="text/javascript">
    $(document).ready(function(){

      classOptions();
      sessionOptions();
      studentDetails();

      /*Authenticate next session*/
      $(".sessionOptions").change(function(){
        var session_id = $(this).val();
        var current_session = '<?php echo e($session_id); ?>';

          if(session_id <= current_session){

            $.confirm({
              content : 'Please select a higher academic session <p><strong>Click Create to add a higher session</strong></p>',
              title : 'Invalid session',
              type:'red',
              buttons:{
                Create : function(){
                  // window.open('<?php echo e(url("sessions")); ?>','_blank');
                  $(".sessionOptions").prop('selectedIndex',0);
                  newTab('<?php echo e(url("sessions")); ?>#newSession');
                },
                Close: function(){
                  $(".sessionOptions").prop('selectedIndex',0);
                }
              }
            });

          }
            
      });




      $(".classOptions").change(function(){

          var that = $(this).parent().next().children('select');

          var group_class_id = $(this).val();

          that.html("<option>Collecting class arms......</option>");

    
          $.get('<?php echo e(url("select/full-arms")); ?>/'+group_class_id,function(data){
            console.log(data);
            var fullArmOptions = "<option value=''>Select class arm</option>";

            $.each(data.fullArms,function(i,value){

                fullArmOptions+="<option value='"+value.id+"'>"+value.arm+"</option>";

            });


            that.html(fullArmOptions);

          });



      });


    });
  </script>