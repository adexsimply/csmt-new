
					 <h4 class="mb-4">
					   <span>Students Information</span>
					   <button class="btn btn-outline-primary pull-right" data-target="#humanitiesModal" data-toggle="modal" type="button">Add New Student</button>
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
								<form action="" class="f-16">
								  <div class="row">
									<div class="col-md-12">
									  <div class="form-group">
										<label for="">Student Id</label>
										<input type="text" name="student_id" class="form-control" placeholder="e.g CSMT/SSS/01/123">
									  </div>
									  
									</div>
								  </div>
								  <div class="row">
									<div class="col-md-6">
									  <label for="">Surname</label>
									  <input type="text" name="surname" class="form-control" placeholder="Surname">
									</div>
									<div class="col-md-6">
									  <label for="">Other Names</label>
									  <input type="text" name="other_names" class="form-control" placeholder="Other Names">
									</div>
								  </div>

								  <div class="row mt-4">
									<div class="col-md-6">
									  <label for="">Date of Birth</label>
									  <input type="date" name="dob" class="form-control">
									</div>
									<div class="col-md-6">
									  <label for="">Gender</label>
									  <select name="gender" id="" class="form-control">
										<option value=""></option>
										<option value="male">Male</option>
										<option value="female">Female</option>
									  </select>
									</div>
								  </div>

								  <div class="row mt-4">
									<div class="col-md-12">
									  <label for="">Student's Address</label>
									  <textarea name="student_address" id="" class="form-control"></textarea>
									</div>
								  </div>

								  <div class="row mt-4">
									<div class="col-md-12">
									  <label for="">Full Names of Parents / Guardians</label>
									  <input type="text" name="parent_fullname" class="form-control">
									</div>
								  </div>

								  <div class="row mt-4">
									<div class="col-md-6">
									  <label for="">State of origin</label>
									  <select name="state" class="form-control">
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
									</div>
									<div class="col-md-6">
									  <label for="">LGA</label>
									  <input type="text" name="lga" class="form-control">
									</div>
								  </div>

								  <div class="row mt-4">
									<div class="col-md-6">
									  <label for="">Relationship to Student</label>
									  <input type="text" class="form-control">
									</div>
									<div class="col-md-6">
									  <label for="">Phone Number</label>
									  <input type="text" class="form-control">
									</div>
								  </div>

								  <div class="row mt-4">
									<div class="col-md-6">
									  <label for="">Alternate Phone Number</label>
									  <input type="text" class="form-control">
									</div>
									<div class="col-md-6">
									  <label for="">Club</label>
									  <select name="club" class="form-control">
										<option value=""></option>
										<option value="ICT">ICT</option>
										<option value="JET">JET</option>
										<option value="HEALTH">HEALTH</option>
										<option value="HOME MGRS">HOME MGRS</option>
										<option value="CODRAL">CODRAL</option>
										<option value="LITERARY">LITERARY</option>
									  </select>
									</div>
								  </div>

								  <div class="row mt-4">
									<div class="col-md-6">
									  <label for="">House</label>
									  <select name="house" class="form-control">
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
									</div>
									<div class="col-md-6">
									  <label for="">Session Name</label>
									  <select name="club" class="form-control">
										<option value=""></option>
										<option value="ICT">2014 / 2015</option>
										<option value="JET">2015 / 2016</option>
										<option value="HEALTH">2016 / 2017</option>
										<option value="HOME MGRS">2017 / 2018</option>
										
									  </select>
									</div>
								  </div>

								  <div class="row mt-4">
									<div class="col-md-6">
									  <label for="">Level Name</label>
									  <select name="house" class="form-control">
										<option value=""></option>
										<option value="">J.S.S.1</option>
										<option value="">J.S.S.2</option>
										<option value="">J.S.S.3</option>
										<option value="">S.S.S.1</option>
										<option value="">S.S.S.2</option>
										<option value="">S.S.S.3</option>
														  
									  </select>
									</div>
									<div class="col-md-6">
									  <label for="">Class Category</label>
									  <select name="club" class="form-control">
										<option value=""></option>
										<option value="junior">Junior</option>
										<option value="senior">Senior</option>
									  </select>
									</div>
								  </div>

								  <div class="row mt-4">
								  	<div class="col-md-6">
								  		<label for="">Student Category</label>
								  		<select name="" id="" class="form-control">
								  			<option value="">Day</option>
								  			<option value="">Boarding</option>
								  		</select>
								  	</div>
								  	<div class="col-md-6">
								  		<label for="">Class Arm</label>
								  		<select name="" id="" class="form-control">
								  			<option value=""></option>
								  			<option value="">A</option>
								  			<option value="">B</option>
								  			<option value="">C</option>
								  			<option value="">D</option>
								  			<option value="">E</option>
								  			<option value="">H</option>
								  		</select>
								  	</div>
								  </div>

								  <div class="row mt-4">
								  	<div class="col-md-6">
								  		<label for="">Blood Group</label>
								  		<select name="" id="" class="form-control">
								  			<option value=""></option>
								  			<option value="">A</option>
								  			<option value="">B</option>
								  			<option value="">AB</option>
								  			<option value="">O</option>
								  		</select>
								  	</div>
								  	<div class="col-md-6">
								  		<label for="">Genotype</label>
								  		<select name="" id="" class="form-control">
								  			<option value=""></option>
								  			<option value="">AS</option>
								  			<option value="">AA</option>
								  			<option value="">SS</option>
								  		</select>
								  	</div>
								  </div>

							  	<div class="row mt-4">
								  	<div class="col-md-12">
								  		<label for="">Any Health Challenge</label>
								  		<input type="text" class="form-control" placeholder="e.g Asthma">
								  	</div>
							  	</div>

								<div class="row mt-4">
								  	<div class="col-md-12">
								  		<div class="form-group row">
								            <label class="col-sm-8 col-form-label">Should the school treat your child in case of Emergency</label>
								            <div class="col-sm-4">
								              <div class="form-check">
								                <label class="form-check-label">
								                	<input checked="" class="form-check-input" name="optionsRadios" type="radio" value="yes">Yes</label>
								              </div>
								              <div class="form-check">
								                <label class="form-check-label"><input class="form-check-input" name="optionsRadios" type="radio" value="no">No</label>
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
								                	<input checked="" class="form-check-input" name="immunize" type="radio" value="yes">Yes</label>
								              </div>
								              <div class="form-check">
								                <label class="form-check-label"><input class="form-check-input" name="immunize" type="radio" value="no">No</label>
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
								                	<input checked="" class="form-check-input" name="labTests" type="radio" value="yes">Yes</label>
								              </div>
								              <div class="form-check">
								                <label class="form-check-label"><input class="form-check-input" name="labTests" type="radio" value="no">No</label>
								              </div>
								              
								            </div>
								          </div>
								  	</div>
							  	</div>


								</form>
							  </div>
							  <div class="modal-footer">
								<button class="btn btn-secondary" data-dismiss="modal" type="button"> Cancel</button><button class="btn btn-primary" type="button"> Register </button>
							  </div>
							</div>
							</form>
						  </div>
					  </div>
					 </h4>