<div class="element-box">
						
						<form action="{{url('parents/update')}}" onsubmit="oisForm(event)" method="post" class="f-16">

							{{@csrf_field()}}

							<div class="formAlert"></div>

							<input type="hidden" name="parent_id" value="{{$parent->id}}">

							
							<h3>Parent information</h3>
							<hr>

							<div class="row mt-4">
								<div class="col-md-12">
									<label for="">Address</label>
									<textarea name="parent_address" id="address" class="form-control">{{$parent->address}}</textarea>
								</div>
							</div>
							<div class="row mt-4">
								<div class="col-md-12">
									<label for="">Parent full name</label>
									<input type="text" value="{{$parent->name}}" name="parent_name" id="parent_name" class="form-control">
								</div>
							</div>

							

							<div class="row mt-4">
								<div class="col-md-4 form-group">
									<label for="">Phone Number</label>
									<input name="phone1" id="phone1" value="{{$parent->phone1}}" type="text" class="form-control">
								</div>
								<div class="col-md-4 form-group">
									<label for="">Alternate Number</label>
									<input name="phone2" id="phone1" value="{{$parent->phone2}}" type="text" class="form-control">
								</div>
								<div class="col-md-4 form-group">
									<label for="">Email</label>
									<input name="email" id="email" value="{{$parent->email}}" type="text" class="form-control">
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
