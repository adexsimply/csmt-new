<?php $__env->startSection('title','Classes'); ?>
<?php $__env->startSection('content'); ?>

  <ul class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?php echo e(url('home')); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
              <a href="<?php echo e(url('classes')); ?>">All classes</a>
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
                      Academic Class Setup
                    </h4>

                    <?php echo $__env->make('components.classes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    
                   
                    
                </div>
              </div>
              

              
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
      

      /*Trigger ad new group_class modal form*/
      $('.newArm').click(function(e){
        e.preventDefault();
        armOptions();
        aliasOptions();

        var group_class_id = $(this).data('group_class_id');

        $("#group_class_id").val(group_class_id);


        $('#newArm').modal('show');
      });



    });
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>