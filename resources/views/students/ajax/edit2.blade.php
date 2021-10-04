
<div class="element-box">
						
						<form action="{{url('students/update')}}" onsubmit="oisForm(event)" method="post" class="f-16">

							{{@csrf_field()}}

							<div class="formAlert"></div>

							<input type="hidden" name="id" value="{{$student->student_id}}">

							
							
				              <div class="table-responsive">
				              <table class="table table-striped table-bordered dataTable" style="width:100%">
				                <thead class="text-primary">
				              <tr>
				                <th class="text-center"><i class="fas fa-level-down"></i> S/N</th>
				                <th><i class="fas fa-user-circle"></i> Name</th>
				                <th><i class="fas fa-user-tie"></i> Parent's phone</th>
				                <th><i class="fas fa-user-tie"></i> Parent's phone2</th>
				                <th><i class="fas fa-user-tie"></i> Email</th>
				                <th><i class="fas fa-user-tie"></i> Address</th>
				                <th><i class="fas fa-plug"></i> Actions</th>
				              </tr>
				                </thead>
				                <tbody>

              					@foreach($parents as $x => $parent)



				              <tr id="parent{{$parent->id}}">
				                <td class="text-center">{{$x+1}}</td>

				                <td><a data-type="purple" data-title="{{$parent->name}} details" data-size="l" onclick="oisRead(event)" href="{{url('parents/show/'.$parent->id)}}">{{$parent->name}}</a></td>

				                <td>{{$parent->phone1}}</td>
				                <td>{{$parent->phone2}}</td>
				                <td>{{$parent->email}}</td>
				                <td>{{$parent->address}}</td>
				                <td class="text-center">

				                  <a data-type="purple" data-title="Update {{$parent->name}} details" data-size="xl" onclick="oisEdit(event)" href="{{url('students/edit_parent/'.$parent->id.'/'.$student->student_id)}}" title="Edit parent"><i class="fas fa-check"></i></a> &nbsp;
				                </td>
				              </tr>
				              @endforeach
              
              
                </tbody>
                
              </table>

              
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

