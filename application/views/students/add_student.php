
					 <h4 class="mb-4">
					   <span>Students Information</span>
					   <button class="btn btn-outline-primary pull-right" onclick="clear_textbox_student()" data-target="#humanitiesModal" data-toggle="modal" type="button">Add New Student</button>
					 </h4>

					   <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="humanitiesModal" role="dialog" tabindex="-1">
						  <div class="modal-dialog modal-lg px-5" role="document">
						  	<form id="add-student">
							<div class="modal-content">
							  <div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">
								  Student Registration Form 
								</h5>
								<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"> &times;</span></button>
							  </div>
							  <div class="modal-body ">
								  <div class="row">
									<div class="col-md-12">
                                        <input type="text" class="form-control" name="id" placeholder=" Example JSS1">
									  <div class="form-group">
										<label for="">Student Id</label>
										<input type="text" name="student_id" class="form-control" placeholder="e.g CSMT/SSS/01/123">
                                      <div style="color: #ff0000;" class="form-control-feedback" data-field="student_id"></div>
									  </div>
									  
									</div>
								  </div>
								  <div class="row">
									<div class="col-md-6">
									  <label for="">Surname</label>
									  <input type="text" name="surname" class="form-control" placeholder="Surname">
                                      <div style="color: #ff0000;" class="form-control-feedback" data-field="surname"></div>
									</div>
									<div class="col-md-6">
									  <label for="">Other Names</label>
									  <input type="text" name="other_names" class="form-control" placeholder="Other Names">
                                      <div style="color: #ff0000;" class="form-control-feedback" data-field="other_names"></div>
									</div>
								  </div>

								  <div class="row mt-4">
									<div class="col-md-6">
									  <label for="">Date of Birth</label>
									  <input type="date" name="dob" id="dob" class="form-control">
                                      <div style="color: #ff0000;" class="form-control-feedback" data-field="dob"></div>
									</div>									
									<div class="col-md-6">
									  <label for="">Gender</label>
									  <select name="gender" id="gender" class="form-control">
										<option value=""></option>
										<option value="male">Male</option>
										<option value="female">Female</option>
									  </select>
                                      <div style="color: #ff0000;" class="form-control-feedback" data-field="gender"></div>
									</div>
								  </div>

								  <div class="row mt-4">
									<div class="col-md-12">
									  <label for="">Student's Address</label>
									  <textarea name="student_address" id="student_address" class="form-control"></textarea>
                                      <div style="color: #ff0000;" class="form-control-feedback" data-field="student_address"></div>
									</div>
								  </div>

								  <div class="row mt-4">
									<div class="col-md-12">
									  <label for="">Full Names of Parents / Guardians</label>
									  <input type="text" name="parent_fullname" class="form-control">
                                      <div style="color: #ff0000;" class="form-control-feedback" data-field="parent_fullname"></div>
									</div>
								  </div>

								  <div class="row mt-4">
									<div class="col-md-6">
									  <label for="">State of origin</label>
									  <select name="state" id="state" class="form-control">
										<option value=""></option>
										<option value="Abia">Abia</option>
										<option value="Adamawa">Adamawa</option>
										<option value="Akwa Ibom">Akwa Ibom</option>
										<option value="Anambra">Anambra</option>
										<option value="Bauchi">Bauchi</option>
										<option value="Bayelsa">Bayelsa</option>
										<option value="Benue">Benue</option>
										<option value="Borno">Borno</option>
										<option value="Cross River">Cross River</option>
										<option value="Delta">Delta</option>
										<option value="Ebonyi">Ebonyi</option>
										<option value="Edo">Edo</option>
										<option value="Ekiti">Ekiti</option>
										<option value="Enugu">Enugu</option>
										<option value="Gombe">Gombe</option>
										<option value="Imo">Imo</option>
										<option value="Jigawa">Jigawa</option>
										<option value="Kaduna">Kaduna</option>
										<option value="Kano">Kano</option>
										<option value="Katsina">Katsina</option>
										<option value="Kebbi">Kebbi</option>
										<option value="Kogi">Kogi</option>
										<option value="Kwara">Kwara</option>
										<option value="Lagos">Lagos</option>
										<option value="Nassarawa">Nassarawa</option>
										<option value="Niger">Niger</option>
										<option value="Ogun">Ogun</option>
										<option value="Ondo">Ondo</option>
										<option value="Osun">Osun</option>
										<option value="Oyo">Oyo</option>
										<option value="Plateau">Plateau</option>
										<option value="Rivers">Rivers</option>
										<option value="Sokoto">Sokoto</option>
										<option value="Taraba">Taraba</option>
										<option value="Yobe">Yobe</option>
										<option value="Zamfara">Zamfara</option>
										<option value="FCT Abuja">FCT Abuja</option>                  
									  </select>
                                      <div style="color: #ff0000;" class="form-control-feedback" data-field="state"></div>
									</div>
									<div class="col-md-6">
									  <label for="">LGA</label>
									  <input type="text" name="lga" class="form-control">
                                      <div style="color: #ff0000;" class="form-control-feedback" data-field="lga"></div>
									</div>
								  </div>

								  <div class="row mt-4">
									<div class="col-md-6">
									  <label for="">Relationship to Student</label>
									  <input type="text" name="relationship" class="form-control">
                                      <div style="color: #ff0000;" class="form-control-feedback" data-field="relationship"></div>
									</div>
									<div class="col-md-6">
									  <label for="">Phone Number</label>
									  <input type="text" name="phone" class="form-control">
                                      <div style="color: #ff0000;" class="form-control-feedback" data-field="phone"></div>
									</div>
								  </div>

								  <div class="row mt-4">
									<div class="col-md-6">
									  <label for="">Alternate Phone Number</label>
									  <input type="text" name="phone_2" class="form-control">
									</div>
									<div class="col-md-6">
									  <label for="">Club</label>
									  <select name="club" id="club" class="form-control">
										<option value=""></option>
										<?php foreach ($club_lists as $club_list) { ?>
										<option value="<?php echo $club_list->id; ?>"><?php echo $club_list->club_name; ?></option>
										<?php } ?>
									  </select>
                                      <div style="color: #ff0000;" class="form-control-feedback" data-field="club"></div>
									</div>
								  </div>

								  <div class="row mt-4">
									<div class="col-md-6">
									  <label for="">House</label>
									  <select name="house" id="house" class="form-control">
										<option value=""></option>
										<option value="Red">Red</option>
										<option value="Yellow">Yellow</option>
										<option value="Orange">Orange</option>
										<option value="White">White</option>
										<option value="Purple">Purple</option>
										<option value="Blue">Blue</option>
										<option value="Green">Green</option>
										<option value="Pink">Pink</option>                    
									  </select>
                                      <div style="color: #ff0000;" class="form-control-feedback" data-field="house"></div>
									</div>
									<div class="col-md-6">
									  <label for="">Session of Admission</label>
									  <select name="sess_name" id="sess_name" class="form-control">
										<option value=""></option>
										<?php foreach ($session_list as $sess) { ?>
										<option value="<?php echo $sess->id; ?>"><?php echo $sess->sess_name; ?></option>
										<?php } ?>
										
									  </select>
                                      <div style="color: #ff0000;" class="form-control-feedback" data-field="sess_name"></div>
									</div>
								  </div>

								  <div class="row mt-4">
									<div class="col-md-6">
									  <label for="">Class Category</label>
									  <select name="class_category"  id="group" class="form-control" onchange="get_class_list(group)">
										<option value=""></option>
										<?php foreach ($group_lists as $group_list) { ?>
										<option value="<?php echo $group_list->id; ?>"><?php echo $group_list->group_name; ?></option>
										<?php } ?>
									  </select>
                                      <div style="color: #ff0000;" class="form-control-feedback" data-field="class_category"></div>
									</div>
									<div class="col-md-6">
									  <label for="">Level Name</label>
									  <select id="class_info" name="class_name" class="form-control">
										<option value=""></option>														  
									  </select>
                                      <div style="color: #ff0000;" class="form-control-feedback" data-field="class_name"></div>
									</div>
								  </div>

								  <div class="row mt-4">
								  	<div class="col-md-6">
								  		<label for="">Student Category</label>
								  		<select name="student_category" id="student_category" class="form-control">
								  			<option ></option>
								  			<option value="Day">Day</option>
								  			<option value="Boarding">Boarding</option>
								  		</select>
                                      <div style="color: #ff0000;" class="form-control-feedback" data-field="student_category"></div>
								  	</div>
								  	<div class="col-md-6">
								  		<label for="">Any Health Challenge</label>
								  		<input type="text" name="health_challenge" class="form-control" placeholder="e.g Asthma">
                                      <div style="color: #ff0000;" class="form-control-feedback" data-field="health_challenge"></div>
								  	</div>
								  </div>

								  <div class="row mt-4">
								  	<div class="col-md-6">
								  		<label for="">Blood Group</label>
								  		<select name="blood_group" id="blood_group" class="form-control">
								  			<option value=""></option>
								  			<option value="A">A</option>
								  			<option value="B">B</option>
								  			<option value="AB">AB</option>
								  			<option value="O">O</option>
								  		</select>
                                      <div style="color: #ff0000;" class="form-control-feedback" data-field="blood_group"></div>
								  	</div>
								  	<div class="col-md-6">
								  		<label for="">Genotype</label>
								  		<select name="genotype" id="genotype" class="form-control">
								  			<option value=""></option>
								  			<option value="AS">AS</option>
								  			<option value="AA">AA</option>
								  			<option value="SS">SS</option>
								  		</select>
                                      <div style="color: #ff0000;" class="form-control-feedback" data-field="genotype"></div>
								  	</div>
								  </div>

								<div class="row mt-4">
								  	<div class="col-md-12">
								  		<div class="form-group row">
								            <label class="col-sm-8 col-form-label">Should the school treat your child in case of Emergency
								              
                                      		<div style="color: #ff0000;" class="form-control-feedback" data-field="emergency"></div></label>
								            <div class="col-sm-4">
								              <div class="form-check">
								                <label class="form-check-label">
								                	<input class="form-check-input" id="emergencyYes" name="emergency" type="radio" value="yes">Yes</label>
								              </div>
								              <div class="form-check">
								                <label class="form-check-label"><input id="emergencyNo" class="form-check-input" name="emergency" type="radio" value="no">No</label>
								              </div>
								            </div>
								          </div>
								  	</div>
							  	</div>

							  	<div class="row mt-4">
								  	<div class="col-md-12">
								  		<div class="form-group row">
								            <label class="col-sm-8 col-form-label">Should the school immunize
                                      		<div style="color: #ff0000;" class="form-control-feedback" data-field="immunize"></div></label>
								            <div class="col-sm-4">
								              <div class="form-check">
								                <label class="form-check-label">
								                	<input class="form-check-input" id="immunizeYes" name="immunize" type="radio" value="yes">Yes</label>
								              </div>
								              <div class="form-check">
								                <label class="form-check-label"><input id="immunizeNo" class="form-check-input" name="immunize" type="radio" value="no">No</label>
								              </div>
								              
								            </div>
								          </div>
								  	</div>
							  	</div>

							  	<div class="row mt-4">
								  	<div class="col-md-12">
								  		<div class="form-group row">
								            <label class="col-sm-8 col-form-label">Should the school conduct lab tests
                                      		<div style="color: #ff0000;" class="form-control-feedback" data-field="lab_tests"></div></label>
								            <div class="col-sm-4">
								              <div class="form-check">
								                <label class="form-check-label">
								                	<input class="form-check-input" id="labYes" name="lab_tests" type="radio" value="yes">Yes</label>
								              </div>
								              <div class="form-check">
								                <label class="form-check-label"><input class="form-check-input" id="labNo" name="lab_tests" type="radio" value="no">No</label>
								              </div>
								              
								            </div>
								          </div>
								  	</div>
							  	</div>
							  </div>
							  <div class="modal-footer">
								<button class="btn btn-secondary" data-dismiss="modal" type="button"> Cancel</button><button class="btn btn-primary" type="button" title="add_student" onclick="form_routes_add_student('add_student')"> Register </button>
							  </div>
							</div>
							</form>
						  </div>
					  </div>