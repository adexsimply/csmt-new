<div class="element-box">

@if(count($students) > 0 )
	<form action="{{url('assessments/store')}}" onsubmit="oisForm(event)" method="post" class="f-16">

		{{@csrf_field()}}

		<div class="formAlert"></div>


		<div class="row">

			<div class="col-md-6">
				<div class="form-group">
					<label>Session</label>
					<select name="session_id" required="" class="form-control sessionOptions"></select>
				</div>
			</div>


			<div class="col-md-6">
				<div class="form-group">
					<label>Term</label>
					<select name="term_id" required="" class="form-control termOptions"></select>
				</div>
			</div>


			<input type="hidden" name="aagc_id" value="{{$aagc_id}}">
			<input type="hidden" name="subject_id" value="{{$subject_id}}">
			<input type="hidden" name="category_id" value="{{$category_id}}">

		</div>
		<div class="table-responsive">
            <table style="width: 100%;" class="table table-lightborder">
                <thead>
                   <tr>
                      <th>S/N</th>
                       <th>Student's ID</th>
                      <th>Student name</th>
                       <th>First test</th>
                       <th>Second test</th>
                       <th>Third test</th>
                       <th>Micro Exam</th>
                       <th>Exam</th>
                    </tr>
                </thead>
                <tbody>
 

                @foreach($students as $x => $student)
                    <tr>
                        <td>{{$x+1}}</td>
                        <td><a class="studentDetails" href="" ef="{{url('students/show/'.$student->id)}}">{{$student->admission_no}}</a></td>
                        <td>{{$student->surname.' '.$student->othernames}}</td>
                        <td>
                            <input type="hidden" name="student_id[]" value="{{$student->id}}">
                            <input type="number" min="-1" placeholder="First test score" max="10" name="test1[]" class="form-control" />
                        </td>
                                    
                        <td> <input type="number" min="-1" placeholder="Second test score " max="10" name="test2[]" class="form-control" /></td>
                                    
                        <td> <input type="number" min="-1" placeholder="Third test score" max="10" name="test3[]" class="form-control" /></td>
                                    
                        <td> <input type="number" min="-1" placeholder="Micro Exam score" max="30" name="micro_exam[]" class="form-control" /></td>
                                    
                        <td> <input type="number" min="-1" placeholder="Exam score" max="85" name="exam[]" class="form-control" /> </td>
                                    
                        </tr>
                @endforeach



                </tbody>
                    
           	</table>
        </div>



		<div class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary btn-md"><i class="fas fa-upload"></i> Upload Assessment</button>
				<button type="reset" class="btn btn-sceondary btn-md">Clear fields</button>
			</div>
		</div>


	</form>

@else
	<h3 class="text-center text-danger"> <i class="fas fa-trash"></i> No unassessed student found</h3>
@endif
					  

</div>


<script type="text/javascript">
	
	termOptions('{{$term_id}}');
	sessionOptions('{{$session_id}}');
	studentDetails();
	// useDataTable('.subjectStudent');

</script>