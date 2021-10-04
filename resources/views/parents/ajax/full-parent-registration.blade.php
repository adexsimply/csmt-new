<div class="element-box">
						
						<form action="{{url('parents/store')}}" onsubmit="oisForm(event)" method="post" class="f-16">

							{{@csrf_field()}}

							<div class="formAlert"></div>


							<!-- Parent information -->

							<h3>Parent information</h3>
							<hr>

							<div class="row mt-4">
								<div class="col-md-12">
									<label for="">Address</label>
									<textarea name="parent_address" id="address" class="form-control"></textarea>
								</div>
							</div>
							<div class="row mt-4">
								<div class="col-md-12">
									<label for="">Parent full name</label>
									<input type="text" name="parent_name" id="parent_name" class="form-control">
								</div>
							</div>

							

							<div class="row mt-4">
								<div class="col-md-4 form-group">
									<label for="">Phone Number</label>
									<input name="phone1" id="phone1" type="text" class="form-control">
								</div>
								<div class="col-md-4 form-group">
									<label for="">Alternate Number</label>
									<input name="phone2" id="phone2" type="text" class="form-control">
								</div>
								<div class="col-md-4 form-group">
									<label for="">Email Address</label>
									<input name="email" id="email" type="email" class="form-control">
								</div>
							</div>



							<div class="row">
								<div class="col-md-12">
									<button type="submit" class="btn btn-primary btn-md">Register</button>
									<button type="reset" class="btn btn-sceondary btn-md">Reset fields</button>
								</div>
							</div>


						</form>
					  

					</div>


<script type="text/javascript">
	stateOptions();
	sessionOptions();
	clubOptions();
	houseOptions();


	/*Collect the class group ID in order to get all the assigned arms and aliases*/

	$(".group_class_id").change(function(){

		group_class_id = $(this).val();

		fullArmOptions(group_class_id);
	});



	$(".stateOptions").change(function(){
		var id = $(this).val();
		lgaOptions(id);
	});


</script>