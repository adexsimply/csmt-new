<div class="element-box">
						
						<form action="<?php echo e(url('clinic/update')); ?>" onsubmit="oisForm(event)" method="post" class="f-16">

							<?php echo e(@csrf_field()); ?>


							<div class="formAlert"></div>

							<input type="hidden" name="id" value="<?php echo e($student->student_id); ?>">

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Select Date</label>
										<input type="date" name="clinic_date" id="clinic_date" class="form-control" placeholder="">
									</div>
									
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<button type="submit" class="btn btn-primary btn-md">Mark</button>
									<button type="reset" class="btn btn-sceondary btn-md">Reset fields</button>
								</div>
							</div>


						</form>
					  

					</div>


<script type="text/javascript">

	stateOptions('<?php echo e($student->state_id); ?>');
	sessionOptions('<?php echo e($student->admitted_session_id); ?>');
	clubOptions('<?php echo e($student->club_id); ?>');
	houseOptions('<?php echo e($student->house_id); ?>');
	lgaOptions('<?php echo e($student->state_id); ?>','<?php echo e($student->lga_id); ?>');
	fullArmOptions('<?php echo e($student->group_class_id); ?>','<?php echo e($student->aagc_id); ?>');
	$("#blood_group").val('<?php echo e($student->blood_group); ?>');
	$("#genotype").val('<?php echo e($student->genotype); ?>');
	$("#student_category_id").val('<?php echo e($student->student_category_id); ?>');
	$("#gender").val('<?php echo e($student->gender); ?>');
	$("#status").val('<?php echo e($student->status); ?>');
	classOptions('<?php echo e($student->group_class_id); ?>');

	/*Collect new class arms when class is changed*/
	$(".classOptions").change(function(){
		var group_class_id = $(this).val();
		fullArmOptions(group_class_id);
	});

</script>