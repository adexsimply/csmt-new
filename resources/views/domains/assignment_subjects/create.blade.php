<div class="col-sm-12">
	@if($students)
		<label>Previously marked</label>

		<div class="row">
			<div class="col-sm-6">
				<input type="date" id="classAssignmentSubject" class="form-control" />
			</div>
			<div class="col-sm-6">
				<select required="" class="form-control" data-type="purple" data-title="Previously marked" data-size="xl" data-url="{{url('assignment/subject/show/'.$aagc_id.'/'.$session_id.'/'.$term_id.'/'.$category_id)}}" onchange="viewAssignmentAttendance(event)">
						@if($subjects)
							<option value="">Select subject</option>
							@foreach($subjects as $subject)
								<option value="{{$subject->id}}">
									{{$subject->name}}
								</option>
							@endforeach
						@else
							<option>No subject found</option>
						@endif
					</select>
			</div>
		</div>
		
		<hr />

		<h3>Mark new </h3>
		<form method="post" onsubmit="oisForm(event)" action="{{url('assignment/subject/store')}}">
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
					<th class="text-center"><input type="radio" onclick="mark_early()" class="radio-lg" name="mark_all">Early</th>
					<th class="text-center"><input type="radio" onclick="mark_late()" class="radio-lg" name="mark_all">Late</th>
				</thead>

				<tbody>
					@foreach($students as $x => $student)
						<tr>
							<input type="hidden" name="student_id[{{$x}}]" value="{{$student->student_id}}" />
							<td>{{$x+1}}</td>
							<td>{{$student->surname.' '.$student->othernames}}</td>
							<td>{{$student->admission_no}}</td>
							<td class="text-center"><input type="radio" required class="radio-lg early" name="status[{{$x}}]" value="1"></td>

							<td class="text-center"><input type="radio" required class="radio-lg late" name="status[{{$x}}]" value="0"></td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<div class="row">
				<div class="col-sm-5">
					<label>Select date</label>
					<input type="date" required="" name="date" class="form-control">
				</div>

				<div class="col-sm-5">
					<label>Select Subject</label>
					<select required="" name="subject_id" class="form-control">
						@if($subjects)
							<option value="">Select subject</option>
							@foreach($subjects as $subject)
								<option value="{{$subject->id}}">
									{{$subject->name}}
								</option>
							@endforeach
						@else
							<option>No subject found</option>
						@endif
					</select>
				</div>

				<div class="col-sm-2">
					<br>
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

<script type="text/javascript">
	subjectOptions();
</script>
<script type="text/javascript">
	function mark_early() {
		$(".early").prop("checked", true);
		//alert('Shina');
	}
	function mark_late() {
		$(".late").prop("checked", true);
		//alert('Shina');
	}
</script>