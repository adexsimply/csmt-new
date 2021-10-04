<div class="col-sm-12">
	@if($students)
		
		<form method="post" onsubmit="oisForm(event)" action="{{url('psychomotor/update')}}">
			<div class="formAlert"></div>
			{{csrf_field()}}
			<input type="hidden" name="aagc_id" value="{{$aagc_id}}">
			<input type="hidden" name="session_id" value="{{$session_id}}">
			<input type="hidden" name="term_id" value="{{$term_id}}">
						<input type="hidden" name="category_id" value="{{$category_id}}">
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
					@foreach($students as $x => $student)
						<tr>
							<input type="hidden" name="student_id[]" value="{{$student->student_id}}" />
							<td>{{$x+1}}</td>
							<td>{{$student->surname.' '.$student->othernames}}</td>
							<!-- <td>{{$student->admission_no}}</td> -->
							<td>
								<input type="text" value="{{$student->craft_skill}}" class="form-control" name="craft_skill[]" placeholder="Enter craft skill">
							</td>

							<td>
								<input type="text" value="{{$student->pet_project}}" class="form-control" name="pet_project[]" placeholder="Enter pet project">
							</td>

							<td>
								<input type="text" value="{{$student->sport}}" class="form-control" name="sport[]" placeholder="Enter sport">
							</td>

							<td>
								<input type="text" value="{{$student->remark}}" class="form-control" name="remark[]" placeholder="Enter remark">
							</td>


						</tr>
					@endforeach
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
	@else
		<div class="text-danger text-center">
			<i class="fas fa-trash"></i> No student found
		</div>
	@endif
</div>