<?php $__env->startSection('title','Class subject & students'); ?>
<?php $__env->startSection('content'); ?>



            <div class="col-sm-12">
	<?php if($students): ?>
		
		<form method="post" onsubmit="oisForm(event)" action="<?php echo e(url('psychomotor/update')); ?>">
			<div class="formAlert"></div>
			<?php echo e(csrf_field()); ?>

			<input type="hidden" name="aagc_id" value="<?php echo e($aagc_id); ?>">
			<input type="hidden" name="session_id" value="<?php echo e($session_id); ?>">
			<input type="hidden" name="term_id" value="<?php echo e($term_id); ?>">
			<table class="table table-hover table-padded">
				<thead>
					<th>SN</th>
					<th>Name</th>
					<!-- <th>Student ID</th> -->
					<th>Craft skill</th>
					<th>Pet project</th>
					<th>Sport</th>
					<th>Remark</th>
				</thead>

				<tbody>
					<?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<input type="hidden" name="student_id[]" value="<?php echo e($student->student_id); ?>" />
							<td><?php echo e($x+1); ?></td>
							<td><?php echo e($student->surname.' '.$student->othernames); ?></td>
							<!-- <td><?php echo e($student->admission_no); ?></td> -->
							<td>
								<input type="text" value="<?php echo e($student->craft_skill); ?>" class="form-control" name="craft_skill[]" placeholder="Enter craft skill">
							</td>

							<td>
								<input type="text" value="<?php echo e($student->pet_project); ?>" class="form-control" name="pet_project[]" placeholder="Enter pet project">
							</td>

							<td>
								<input type="text" value="<?php echo e($student->sport); ?>" class="form-control" name="sport[]" placeholder="Enter sport">
							</td>

							<td>
								<input type="text" value="<?php echo e($student->remark); ?>" class="form-control" name="remark[]" placeholder="Enter remark">
							</td>


						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
			<div class="row">
				<div class="col-xs-12">
					<button type="submit" class="btn btn-primary">
						<i class="fas fa-check"></i> Submit
					</button>
				</div>
				
			</div>
			
		</form>
	<?php else: ?>
		<div class="text-danger text-center">
			<i class="fas fa-trash"></i> No student found
		</div>
	<?php endif; ?>
</div>
                    

                    
          </div>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>




<?php $__env->startSection('modal'); ?>
  

  
  <!-- Create new subject modal -->
  <div class="modal fade" id="addNewSubject">
    <div class="modal-dialog modal-sm mx-auto">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-name">Add new subject</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form onsubmit="oisForm(event)" method="POST" action="<?php echo e(url('classes/aagc/subjects/addnew')); ?>">

            <div class="formAlert"></div>
            

          <input type="hidden" name="aagc_id" id="aagc_id">
          <input type="hidden" name="session_id" id="session_id">

          <div class="form-group">
              <label for=""> Subject school</label>
              <select required="" class="subjectOptions form-control" required name='subject_id'></select>
          </div>

          <button class="btn btn-primary" type="submit"> Add Subject</button>

             </form>
        </div>

      </div>
    </div>
  </div>







<?php $__env->stopSection(); ?>





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



      $('.studentTable').DataTable();

      $('.nav-tabs-sticky').stickyTabs();

      function fetchPromotionList(){
         $('#promotion').html('<p class="text-center"> <i class="fas  fa-spinner fa-spin fa-5x"></i> </p>');


        $.get('<?php echo e(url("classes/aagc/promotion/".$aagc_id."/".$session_id."/".$term_id)); ?>',function(data){
            $("#promotion").html(data);
        });
        
      }

      var promotion = false;

      /*Collect Promotion details*/
      $(".promotionToggle").click(function(){

          fetchPromotionList();
          promotion = true;
      });

      if(!promotion){
        var hash = location.hash;

        if(hash == '#promotion'){
          fetchPromotionList();
        }
      }
      


      /*Add new subjects*/
      $(".addNewSubject").click(function(e){
          e.preventDefault();
          subjectOptions();
          var aagc_id = $(this).data('aagc_id');
          var session_id = $(this).data('session_id');
          $('#aagc_id').val(aagc_id);
          $('#session_id').val(session_id);

          $("#addNewSubject").modal('show');
      });

    });
  </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>