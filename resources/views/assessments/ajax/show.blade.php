<div class="element-box">
	
		<div class="table-responsive">
            <table id="assessmentTable" class="table table-lightborder">
                <thead>
                   <tr>
                      <th>S/N</th>
                      <th>Student name</th>
                       <th>Student's ID</th>
                       <th>First test</th>
                       <th>Second test</th>
                       <th>Third test</th>
                       <th>Micro Exam</th>
                       <th>Exam</th>
                       <th>Grade Point</th>
                    </tr>
                </thead>
                <tbody>
 

                @foreach($students as $student)
                    <tr>
                        <td>{{$x}}</td>
                        <td>{{$student->admission_no}}</td>
                        <td>{{$student->surname.' '.$student->othernames}}</td>
                        <td>{{$assessment->}}}</td>
                        <td>{{$assessment->}}}</td>
                        <td>{{$assessment->}}}</td>
                        <td>{{$assessment->}}}</td>
                        <td>{{$assessment->}}}</td>
                        <td>{{$assessment->}}}</td>
                                    
                        </tr>
                    @php ($x++) @endphp
                @endforeach



                </tbody>
                    
           	</table>
        </div>


					  

</div>


<script type="text/javascript">
	
	termOptions('{{$term_id}}');
	sessionOptions('{{$session_id}}');

	$("#assessmentTable").DataTable();

</script>