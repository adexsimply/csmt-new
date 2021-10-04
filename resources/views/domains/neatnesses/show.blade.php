<div class="col-sm-12">
	@if($attendances)
		
		<form method="post" onsubmit="oisForm(event)" action="{{url('neatness/update')}}">
			<div class="formAlert"></div>
			{{csrf_field()}}
			<input type="hidden" name="aagc_id" value="{{$aagc_id}}">
			<input type="hidden" name="session_id" value="{{$session_id}}">
			<input type="hidden" name="term_id" value="{{$term_id}}">
			<table class="table table-hover table-padded">
				<thead>
					<th>SN</th>
					<th>Name</th>
					<th>Student ID</th>
					<th class="text-center">Corporate</th>
					<th class="text-center">Not corporate</th>
				</thead>

				<tbody>
					@foreach($attendances as $x => $student)
						<tr>
							<input type="hidden" name="student_id[{{$x}}]" value="{{$student->student_id}}" />
							<td>{{$x+1}}</td>
							<td>{{$student->surname.' '.$student->othernames}}</td>
							<td>{{$student->admission_no}}</td>
							<td>

								@if($student->status == 1)
									<input checked="" type="radio" required class="radio-lg" name="status[{{$x}}]" value="1">
								@else
									<input type="radio" required class="radio-lg" name="status[{{$x}}]" value="1">
								@endif
							</td>

							<td>
								@if($student->status == 0)
									<input checked="" type="radio" required class="radio-lg" name="status[{{$x}}]" value="0">
								@else
									<input type="radio" required class="radio-lg" name="status[{{$x}}]" value="0">
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<div class="row">
				<div class="col-lg-4">
					<label>Select date</label>
					<input type="date" required value="{{$date}}" name="date" class="form-control">
				</div>
				
				<div class="col-lg-8 text-right">
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