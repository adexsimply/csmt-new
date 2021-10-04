<div class="col-sm-12">
	@if($students)
		<label>Previously marked</label>
		<input data-type="purple" data-title="Previously marked" data-size="xl" type="date" data-url="{{url('punctuality/classroom/show/'.$aagc_id.'/'.$session_id.'/'.$category_id.'/'.$term_id)}}" onchange="viewAttendance(event)" class="form-control" />
		<hr />

		<h3>Mark new </h3>
		<form method="post" onsubmit="oisForm(event)" action="{{url('punctuality/classroom/store')}}">
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
					<th class="text-center"><input type="radio" onclick="mark_perm()" class="radio-lg" name="mark_all">Permission</th>
				</thead>

				<tbody>
					@foreach($students as $x => $student)
						<tr>
							<input type="hidden" name="student_id[{{$x}}]" value="{{$student->student_id}}" />
							<td>{{$x+1}}</td>
							<td>{{$student->surname.' '.$student->othernames}}</td>
							<td>{{$student->admission_no}}</td>
							<td class="text-center"><input type="radio" id="early" required class="radio-lg early" name="status[{{$x}}]" value="1"></td>

							<td class="text-center"><input type="radio" required class="radio-lg late" name="status[{{$x}}]" value="0"></td>

							<td class="text-center"><input type="radio" required class="radio-lg perm" name="status[{{$x}}]" value="2"></td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<div class="row">
				<div class="col-lg-4">
					<label>Select date</label>
					<input type="date" required name="date" class="form-control">
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
<script type="text/javascript">
	function mark_early() {
		$(".early").prop("checked", true);
		//alert('Shina');
	}
	function mark_late() {
		$(".late").prop("checked", true);
		//alert('Shina');
	}
	function mark_perm() {
		$(".perm").prop("checked", true);
		//alert('Shina');
	}
</script>