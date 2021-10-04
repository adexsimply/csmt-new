<div class="element-box">
						
						<form action="{{url('clinic/update')}}" onsubmit="oisForm(event)" method="post" class="f-16">

							{{@csrf_field()}}

							<div class="formAlert"></div>

							<input type="hidden" name="id" value="{{$student->student_id}}">

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

	stateOptions('{{$student->state_id}}');
	sessionOptions('{{$student->admitted_session_id}}');
	clubOptions('{{$student->club_id}}');
	houseOptions('{{$student->house_id}}');
	lgaOptions('{{$student->state_id}}','{{$student->lga_id}}');
	fullArmOptions('{{$student->group_class_id}}','{{$student->aagc_id}}');
	$("#blood_group").val('{{$student->blood_group}}');
	$("#genotype").val('{{$student->genotype}}');
	$("#student_category_id").val('{{$student->student_category_id}}');
	$("#gender").val('{{$student->gender}}');
	$("#status").val('{{$student->status}}');
	classOptions('{{$student->group_class_id}}');

	/*Collect new class arms when class is changed*/
	$(".classOptions").change(function(){
		var group_class_id = $(this).val();
		fullArmOptions(group_class_id);
	});

</script>