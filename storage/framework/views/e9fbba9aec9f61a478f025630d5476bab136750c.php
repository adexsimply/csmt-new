

<?php $__env->startSection('title','Academic sessions'); ?>
<?php $__env->startSection('content'); ?>

	<ul class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?php echo e(url('home')); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
              <span>Sessions</span>
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
                      Academic Session Setup
                      
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add session')): ?>
                      <a href="#" class="newSession float-right btn btn-outline-primary"><i class="fa fa-plus-circle"></i> create new session</a>
                      <?php endif; ?>
                    </h4>

                    
                   
                    
                      <?php if(Addon::isEmpty($sessions)): ?>


                        <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                          <div class="element-box" id="session<?php echo e($session->id); ?>">
                            <div class="clearfix">
                              <h3 class="float-left"><?php echo e($session->name); ?></h3>

                              <div class="pull-right top-icon top-settings os-dropdown-trigger os-dropdown-position-left">
                                <i class="fas fa-ellipsis-h"></i>
                                <div class="os-dropdown bg-primary">
                                  <ul>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit session')): ?>
                                      <li>
                                        <a class="editSession" href="<?php echo e(url('sessions/edit/'.$session->id)); ?>" data-toggle="tooltip"><i class="os-icon os-icon-ui-49"></i><span>Edit asset</span> </a>
                                      </li>
                                    <?php endif; ?>


                                    
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete session')): ?>
                                    <li>
                                      <a onclick="oisDelete(event)" data-id="<?php echo e($session->id); ?>" data-hide="#session<?php echo e($session->id); ?>" href="<?php echo e(url('sessions/destroy/'.$session->id)); ?>" data-toggle="tooltip"><i class="os-icon os-icon-ui-15"></i><span>Delete asset</span> </a>
                                    </li>
                                    <?php endif; ?>

                                  </ul>
                                </div>
                              </div>
                            </div>


                             <hr>
                            
                            <div class="row mb-xl-2 mb-xxl-3">

                                <?php $__currentLoopData = $session->terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php if($term->pivot->status == 1 ): ?>
                                        <div class="col-sm-4">
                                          <a class="element-box  bg-primary text-white el-tablo centered trend-in-corner padded bold-label" href="#">
                                            <div class="label dashboard-icons">
                                              <div class="icon-check text-white mr-1"></div>
                                            </div>
                                            <div class="value dashboard-title">
                                              <?php echo e($term->name); ?> 
                                            </div>
                                            
                                          </a>
                                        </div>

                                    <?php else: ?>

                                        <div class="col-sm-4">

                                          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('activate session')): ?>
                                          <a data-toggle="tooltip" data-id="<?php echo e($term->pivot->id); ?>" title="Click to activate" class="element-box el-tablo activateTerm centered trend-in-corner padded bold-label" href="<?php echo e(url('sessions/activate')); ?>">
                                          <?php else: ?>


                                          <a class="element-box el-tablo centered trend-in-corner padded bold-label" href="#">
                                            <?php endif; ?>

                                            <div class="label dashboard-icons">
                                              <div class="os-icon os-icon-tasks-checked"></div>
                                            </div>
                                            <div class="value dashboard-title">
                                              <?php echo e($term->name); ?>

                                            </div>
                                            
                                          </a>
                                        </div>

                                    <?php endif; ?> 

                                   
                                       
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  

                            </div>

                          </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <div class="dataTables_paginate paging_simple_numbers" id="example_paginate">
                          <?php echo e($sessions->links()); ?>

                        </div>

                      <?php else: ?>

                        <div class="element-box text-center">
                          <h3> No Session found! </h3>
                          <a href="#" class="newSession btn btn-success">Add new session</a>
                        </div>
                      <?php endif; ?>
                    
                </div>
              </div>
              

              
            </div>
          </div>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('modal'); ?>

	<!-- Edit session modal -->
	<div class="modal fade" id="editSession">
	  <div class="modal-dialog modal-md ">
	    <div class="modal-content">

	      <!-- Modal Header -->
	      <div class="modal-header">
	        <h4 class="modal-name">Edit session</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>

	      <!-- Modal body -->
	      <div class="modal-body">
	        <form onsubmit="oisForm(event)" method="POST" action="<?php echo e(url('sessions/update')); ?>">

	        	<div class="formAlert"></div>

	        	<input type="hidden" name="id" id="id">
	        	<div class="form-group">
			        <label for=""> session Name</label>
			        <input id="name" required="" name="name" class="form-control" placeholder="Enter session name" type="text">
			     </div>  


			      <button class="btn btn-primary" type="submit"> Update session</button>

          </form>
	      </div>

	    </div>
	  </div>
	</div>


	<!-- Create new session modal -->
	<div class="modal fade" id="newSession">
	  <div class="modal-dialog modal-md ">
	    <div class="modal-content">

	      <!-- Modal Header -->
	      <div class="modal-header">
	        <h4 class="modal-name">Create new Session</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>

	      <!-- Modal body -->
	      <div class="modal-body">
	        <form onsubmit="oisForm(event)" id="newSession" method="POST" action="<?php echo e(url('sessions/store')); ?>">

	        	<div class="formAlert"></div>

	        	<div class="form-group">
			        <label for=""> Session name</label>
			        <input name="name" required="" class="form-control" placeholder="e.g 2010/2012 session" type="text">
			    </div>  



            <div class="form-check">
                <input type="checkbox" name='activate' value="1" class="form-check-input" id="activate_session">
                <label class="form-check-label" for="activate_session">Activate session</label>
            </div> 

          <br>
            <button class="btn btn-primary" type="submit"> Add session</button>
          
			    

             </form>
	      </div>

	    </div>
	  </div>
	</div>



<?php $__env->stopSection(); ?>



<?php $__env->startSection('script'); ?>
	<script type="text/javascript">
		$(document).ready(function(){


      if(hash = location.hash){
        $(hash).modal('show');
      }
      
      

      /*Trigger ad new session modal form*/
			$('.newSession').click(function(e){
        e.preventDefault();
        
        $('#newSession').modal('show');
      });


      /*Edit session*/
      $('.editSession').click(function(e){
        e.preventDefault();

        var url = $(this).attr('href');
        
        $.get(url,function(data){
          console.log(data);
          var session = data.session;
          $("#editSession").find('#id').val(session.id);
          $("#editSession").find('#name').val(session.name);

          $("#editSession").modal('show');
        });
      });

        
  /*Change table status*/
    $(document).on('click','.activateTerm',function(e){
      e.preventDefault();
      var that = $(this);
      var id = that.data('id');
      var url = that.attr('href');

      $.confirm({
        title:'Activate term',
        type:'orange',
        escapeKey: true,
        backgroundDismiss: true,
        icon:'fa fa-warning',
        content:'Are you sure you want to activate this term ?',
        buttons:{
          Yes : function(){
            $.post(url,{id:id},function(data){
              console.log(data);
              if(data.status===1){

                /*Display aax response*/
                $.dialog({
                  content:'Selected term activated successfully',
                  type:'green',
                  escapeKey: true,
                  backgroundDismiss: true,
                  title:'Term activated',
                  icon:'fa fa-check-circle'
                });



                location.reload();
              }
              else if(data==150){
                window.location="<?php echo e(url('150')); ?>";
              }
              else{
                alert(data.message);
              }
            });
          },

          No : function(){}

        }
      });
      
    });




		});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>