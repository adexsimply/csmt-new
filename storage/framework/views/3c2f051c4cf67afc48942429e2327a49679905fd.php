<?php $__env->startSection('title','Home'); ?>
<?php $__env->startSection('content'); ?>

  <div class="content-i">
    <div class="content-box">
      <div class="element-wrapper compact pt-4">
        <div class="element-wrapper">
                    
          <h6 class="element-header">
            Students & Admission history
          </h6>
              <div class="element-box">
                    <div class="element-content">
                      <div class="tablo-with-chart">
                        <div class="row">
                          <div class="col-sm-5 col-xxl-4">
                            <div class="tablos">
                              <div class="row mb-xl-2 mb-xxl-3">

                                <div class="col-sm-6">
                                  <a class="element-box el-tablo centered trend-in-corner padded bold-label" href="<?php echo e(url('students/birthday')); ?>" data-size="xl" data-type="purple" data-title="Birthday" onclick="oisRead(event)">
                                    <div class="value">
                                      <?php echo e(App\Student::birthday(true)); ?>

                                    </div>
                                    <div class="label">
                                      Birthday
                                    </div>
                                   
                                  </a>
                                </div>


                                <div class="col-sm-6">
                                  <a class="element-box el-tablo centered trend-in-corner padded bold-label" href="<?php echo e(url('students')); ?>">
                                    <div class="value">
                                      <?php echo e(App\Student::where('status',1)->count('id')); ?>

                                    </div>
                                    <div class="label">
                                      Active students
                                    </div>
                                    
                                  </a>
                                </div>

                              </div>


                              <div class="row">

                                <div class="col-sm-6">
                                  <a class="element-box el-tablo centered trend-in-corner padded bold-label" href="<?php echo e(url('students/1/1')); ?>">
                                    <div class="value">
                                      <?php echo e(App\Student::where([['student_category_id',1],['status',1]])->count()); ?>

                                    </div>
                                    <div class="label">
                                      Boarding Students
                                    </div>
                                   
                                  </a>
                                </div>


                                <div class="col-sm-6">
                                  <a class="element-box el-tablo centered trend-in-corner padded bold-label" href="<?php echo e(url('students/1/2')); ?>">
                                    <div class="value">
                                      <?php echo e(App\Student::where([['student_category_id',2],['status',1]])->count()); ?>

                                    </div>
                                    <div class="label">
                                      Day students
                                    </div>
                                    
                                  </a>
                                </div>
                                
                              </div>

                              <div class="row">

                                <div class="col-sm-12">
                                  <a class="element-box el-tablo centered trend-in-corner padded bold-label" href="<?php echo e(url('students/3')); ?>">
                                    <div class="value">
                                      <?php echo e(App\Student::where('status',3)->count()); ?>

                                    </div>
                                    <div class="label">
                                      Graduated Students
                                    </div>
                                   
                                  </a>
                                </div>
                                
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-7 col-xxl-8">
                            <!--START - Chart Box-->
                            <div class="element-box pl-xxl-5 pr-xxl-5">
                              <div class="el-tablo bigger highlight bold-label">
                                
                                <div class="label">
                                  Admission history
                                </div>
                              </div>
                              <div class="el-chart-w">
                                <canvas height="300px" id="admission-graph" width="600px"></canvas>
                              </div>
                            </div>
                            <!--END - Chart Box-->
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-12">
                                  <div id="canvas-holder" style="width:100%">
                                      <canvas id="classesBar" />
                                  </div>
                                </div>
                      </div>
                    </div>
                  </div>
                
      </div>


      <div class="element-wrapper compact pt-4">
        <div class="element-wrapper">
                    
          <h5 class="element-header">
            All Classes
          </h5>
                   
          <?php echo $__env->make('components.classes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
      </div>
         


      <!-- Start assessment -->
      <div class="element-wrapper compact pt-4">
        <div class="element-wrapper">
                    
          <h5 class="element-header">
            Academic Record Menu
          </h5>
                   
          <div class="element-box">                      
            <?php echo $__env->make('components.assessment', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          </div>
        </div>
      </div>
      <!-- End assessment -->
         
    </div>
  </div>




<?php $__env->stopSection(); ?>



<?php $__env->startSection('modal'); ?>




  <!-- Create new group_class modal -->
  <div class="modal fade" id="newArm">
    <div class="modal-dialog modal-sm ">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-name">Create new arm</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form onsubmit="oisForm(event)" method="POST" action="<?php echo e(url('classes/aagc/store')); ?>">
            <?php echo e(csrf_field()); ?>

            <div class="formAlert"></div>

            <input type="hidden" id="group_class_id" name="group_class_id">

            <div class="form-group">
              <select class="armOptions form-control" name="arm_id"></select>
            </div>  


            <div class="form-group">
              <select class="aliasOptions form-control" name="alias_id"></select>
            </div>  


            <button class="btn btn-primary" type="submit"> Submit</button>

          </form>
        </div>

      </div>
    </div>
  </div>



<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
  <script type="text/javascript">
    $(document).ready(function(){

      /*Initiate assessment controller function*/
      assessment();


      /*Admission history*/
      jQuery.getJSON("<?php echo e(url('students/admission-graph')); ?>").done(function(data){
        var graphData = new Array();
        var label = new Array();
        $.each(data.data,function(i,value){
            graphData[graphData.length] = value.history;
            label[label.length] = ""+value.name+"";
        });

        graphPloter(2000,label,graphData,'#admission-graph');
      });

      /*Trigger ad new group_class modal form*/
      $('.newArm').click(function(e){
        e.preventDefault();
        armOptions();
        aliasOptions();

        var group_class_id = $(this).data('group_class_id');

        $("#group_class_id").val(group_class_id);


        $('#newArm').modal('show');
      });





    /*Student bar chart*/
    jQuery.getJSON("<?php echo e(url('students/class-student-graph')); ?>").done(function(data){
      console.log(data);
      var graphData = new Array();
        var label = new Array();
        $.each(data.data,function(i,value){
            graphData[graphData.length] = value.students;
            label[label.length] = ""+value.classes+"";
        });

        console.log(graphData);
        console.log(label);

      var barChartData = {
            labels: label,
            datasets: [{
                label: 'Students',
                backgroundColor: 'purple',
                borderColor: 'purple',
                borderWidth: 1,
                data: graphData
            }]

        };

            var ctx = document.getElementById("classesBar").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Active students'
                    }
                }
            });

    });


     
    

       

    });
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>