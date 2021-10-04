<div class="element-box">
     
     <form action="{{url('students/store/graduate')}}" onsubmit="oisForm(event)" method="post" class="f-16">

     	{{@csrf_field()}}

     	<div class="formAlert"></div>

        <input type="hidden" name="status" value="{{$status}}" />
     	@if($students)
     		<table class="table table-striped table-bordered newStudent studentTable" style="width:100%">
     			<thead class="text-primary">
                  <tr>
                    <th class="text-center"><i class="fas fa-level-down"></i> S/N</th>
                    <th><i class="fas fa-user"></i> Student's ID</th>
                    <th><i class="fas fa-user-circle"></i> Name</th>
                    <th><i class="fas fa-users"></i> Class</th>
                    <th><i class="fas fa-tint"></i> Status</th>
                  </tr>
                </thead>
                <tbody>
		     		@foreach($students as $x => $student)
		     			
						<tr id="student{{$student->id}}">
	                    <td class="text-center">{{$x+1}}</td>
	                    <td>
	                    	<a data-type="purple" data-title="{{$student->surname.' '.$student->othernames}} details" data-size="l" onclick="oisRead(event)" href="{{url('students/show/'.$student->id)}}">{{$student->admission_no}}</a>
	                    </td>

	                    <td>
	                      	<div class="form-check">
							    <input type="checkbox" value="{{$student->id}}" name="student_ids[]" checked="" class="form-check-input" id="exampleCheck1{{$x+1}}">
							    <label class="form-check-label" for="exampleCheck1{{$x+1}}">{{$student->surname.' '.$student->othernames}}</label>
							</div>
	                    </td>

	                    <td>{{$student->current_class.' '.$student->arm}}</td>

	                    <td class="text-center">
	                        <a data-student_id="{{$student->id}}" href="{{url('students/status')}}" class="changeStatus">{!! App\Student::status($student->status) !!}</a> 
	                    </td>
	                    
	                  </tr>
		     		@endforeach
	     		</tbody>
     		</table>
     	@else
     		<h3 class="alert alert-danger text-center"><i class="fas fa-trash"></i> No student found</h3>
     	@endif

     	<div class="row">
     		<div class="col-md-12 mt-2">
     			<button type="submit" class="btn btn-primary btn-md"><i class="fas fa-check-circle"></i> Submit</button>
     		</div>
     	</div>


     </form>
					  
</div>

<script type="text/javascript">
	$('.studentTable').DataTable({
      // "processing": true,
      // "ajax": 'server.php',
      "dom": 'lBfrtip',
      // "pageLength": 100,
      // "bPaginate": false,
      // "responsive": true,
      "fixedHeader": true,
      "buttons": [
            {
                extend: 'collection',
                text: 'Export',
                buttons: [
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ]

    });
</script>