<div class="element-box">
						
						<form action="{{url('students/update')}}" onsubmit="oisForm(event)" method="post" class="f-16">

							{{@csrf_field()}}

							<div class="formAlert"></div>

							<input type="hidden" name="id" value="{{$student->student_id}}">
							<input type="hidden" name="parent_id" value="{{$student->parent_id}}">

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Student Id</label>
										<input type="text" name="admission_no" value="{{$student->admission_no}}" id="admission_no" class="form-control" placeholder="e.g CSMT/SSS/01/123">
									</div>
									
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<label for="">Surname</label>
									<input type="text" name="surname" value="{{$student->surname}}" id="surname" class="form-control" placeholder="Surname">
								</div>
								<div class="col-md-6">
									<label for="">Other Names</label>
									<input type="text" name="othernames" value="{{$student->othernames}}" id="othernames" class="form-control" placeholder="Other Names">
								</div>
							</div>

							<div class="row mt-4">
								<div class="col-md-6">
									<label for="">Date of Birth</label>
									<input name="dob" id="dob" value="{{$student->dob}}" type="date" class="form-control">
								</div>
								<div class="col-md-6">
									<label for="">Gender</label>
									<select name="gender" id="gender" class="form-control">
										<option value="">Select gender</option>
										<option value="male">Male</option>
										<option value="female">Female</option>
									</select>
								</div>
							</div>

							

							<div class="row mt-4">
								<div class="col-md-6">
									<label for="">State of origin</label>
									<select name="state_id" id="state_id" class="form-control stateOptions">
										
									</select>
								</div>
								<div class="col-md-6">
									<label for="">LGA</label>
									<select name="lga_id" id="lga_id" class="lgaOptions form-control"></select>
								</div>
							</div>



							<div class="row mt-4">

								<div class="col-md-6">
									<label for="">Student Category</label>
									<select name="student_category_id" id="student_category_id" class="form-control student_categoryOptions">
										<option value="1">Boarding</option>
										<option value="2">Day</option>
									</select>
								</div>


								<div class="col-md-6">
									<label for="">Current class</label>
									<select name="group_class_id" id="group_class_id" class="form-control classOptions group_class_id"></select>
								</div>

							</div>



							<div class="row mt-4">

								<div class="col-md-6">
									<label for="">Current class Arm</label>
									<select name="aagc_id" id="aagc_id" class="fullArmOptions form-control">
									</select>
								</div>

								<div class="col-md-6">
									<label for="">Admitted Session</label>
									<select name="admitted_session_id" class="form-control sessionOptions"></select>
								</div>


							</div>


							<div class="row mt-4">
								
								<div class="col-md-6">
									<label for="">Club</label>
									<select id="club_id" name="club_id" class="form-control clubOptions"></select>
								</div>


								<div class="col-md-6">
									<label for="">House</label>
									<select name="house_id" id="house_id" class="form-control houseOptions"></select>
								</div>
							</div>

							


							<div class="row mt-4">
								<div class="col-md-6">
									<label for="">Blood Group</label>
									<select name="blood_group" id="blood_group" class="form-control">
										<option value="">Select</option>
										<option value="A">A</option>
										<option value="A+">A+</option>
										<option value="A-">A-</option>
										<option value="B">B</option>
										<option value="AB">AB</option>
										<option value="O">O</option>
										<option value="O+">O+</option>
										<option value="O-">O-</option>
									</select>
								</div>
								<div class="col-md-6">
									<label for="">Genotype</label>
									<select name="genotype" id="genotype" class="form-control">
										<option value="">Select genotype</option>
										<option value="AS">AS</option>
										<option value="AA">AA</option>
										<option value="SS">SS</option>
									</select>
								</div>
							</div>




							<div class="row mt-4">
								<div class="col-md-8">
									<label for="">Any Health Challenge</label>
									<input type="text" name="health_challenges" value="{{$student->health_challenges}}" id="health_challenges" class="form-control" placeholder="e.g Asthma">
								</div>
								<div class="col-md-4">
									<label>Status</label>
									<select id="status" name="status" class="form-control" required="">
										<option value="1">Active</option>
										<option value="0">Withdawn</option>
									</select>
								</div>
							</div>





							<div class="row mt-4">
								<div class="col-md-12">
									<div class="form-group row">
										<label class="col-sm-8 col-form-label">Should the school treat your child in case of Emergency</label>
										<div class="col-sm-4">
											<div class="form-check">
												<label class="form-check-label">
													<input <?php echo $student->emergency_treatment == 1 ? 'checked':'' ?> class="form-check-input" name="emergency_treatment" type="radio" value="1">Yes</label>
												</div>
												<div class="form-check">
													<label class="form-check-label"><input <?php echo $student->emergency_treatment == 1 ? '':'checked' ?> class="form-check-input" name="emergency_treatment" type="radio" value="0">No</label>
												</div>
												
											</div>
										</div>
									</div>
								</div>



							<div class="row mt-4">
								<div class="col-md-12">
									<div class="form-group row">
										<label class="col-sm-8 col-form-label">Should the school immunize</label>

										<div class="col-sm-4">
											<div class="form-check">
												<label class="form-check-label">
													<input <?php echo $student->immunization == 1 ? 'checked':'' ?> class="form-check-input" name="immunization" type="radio" value="1">Yes</label>
												</div>

												<div class="form-check">
													<label class="form-check-label"><input <?php echo $student->immunization == 1 ? '':'checked' ?> class="form-check-input" name="immunization" type="radio" value="0">No</label>
												</div>
												
											</div>
										</div>
									</div>
								</div>

							<div class="row mt-4">
								<div class="col-md-12">
									<div class="form-group row">
										<label class="col-sm-8 col-form-label">Should the school conduct lab tests</label>
										<div class="col-sm-4">
											<div class="form-check">
												<label class="form-check-label">
													<input <?php echo $student->lab_test == 1 ? 'checked':'' ?> class="form-check-input" name="lab_test" type="radio" value="1">Yes
												</label>
											</div>
											<div class="form-check">
												<label class="form-check-label">
													<input <?php echo $student->lab_test == 1 ? '':'checked' ?> class="form-check-input" name="lab_test" type="radio" value="0">No
												</label>
											</div>
												
										</div>
									</div>
								</div>
							</div>


							


							<h3>Parent information</h3>
							<hr>

							<div class="row mt-4">
								<div class="col-md-12">
									<label for="">Address</label>
									<textarea name="parent_address" id="address" class="form-control">{{$student->address}}</textarea>
								</div>
							</div>
							<div class="row mt-4">
								<div class="col-md-12">
									<label for="">Parent full name</label>
									<input type="text" value="{{$student->name}}" name="parent_name" id="parent_name" class="form-control">
								</div>
							</div>

							

							<div class="row mt-4">
								<div class="col-md-3 form-group">
									<label for="">Relationship to Student</label>
									<input name="parent_relationship" value="{{$student->parent_relationship}}" id="parent_relationship" type="text" class="form-control">
								</div>
								<div class="col-md-3 form-group">
									<label for="">Phone Number</label>
									<input name="phone1" id="phone1" value="{{$student->phone1}}" type="text" class="form-control">
								</div>
								<div class="col-md-3 form-group">
									<label for="">Alternate Number</label>
									<input name="phone2" id="phone1" value="{{$student->phone2}}" type="text" class="form-control">
								</div>
								<div class="col-md-3 form-group">
									<label for="">Email</label>
									<input name="email" id="email" value="{{$student->email}}" type="text" class="form-control">
								</div>
							</div>



							<div class="row">
								<div class="col-md-12">
									<button type="submit" class="btn btn-primary btn-md">Update</button>
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