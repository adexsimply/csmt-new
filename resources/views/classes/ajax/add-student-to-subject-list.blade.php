    
    @if(count($students) > 0 )
    <form onsubmit="oisForm(event)" method="POST" action="{{url('classes/aagc/subject-student-addup')}}">

      {{@csrf_field()}}

      <div class="formAlert"></div>

      <input type="hidden" name="session_id" value="{{$session_id}}" />
      <input type="hidden" name="aagc_id" value="{{$aagc_id}}" />
      <input type="hidden" name="subject_id" value="{{$subject_id}}" />
      
    <div class="table-responsive">
            <table class="table table-lightborder">
                <thead>
                   <tr>
                      <th>S/N</th>
                      <th>Select</th>
                       <th>Student's ID</th>
                       <th>Name</th>
                    </tr>
                  </thead>
                  <tbody>
 

                                @foreach($students as $x => $student)
                                  <tr>
                                    <td>{{$x+1}}</td>

                                    <td><input type="checkbox" id="{{$x}}" name="student_id[]" value="{{$student->id}}" /></td>

                                    <td><a class="studentDetails" href="{{url('students/show/'.$student->id)}}">{{$student->admission_no}}</a></td>

                                    <td><label for="{{$x}}">{{$student->surname.' '.$student->othernames}}</label></td>
                                    
                                  </tr>
                                @endforeach



                                    </tbody>
                    
                                   </table>
                                </div>

                    <button class="btn btn-success" type="submit">Add selected student(s)</button>
            </form>
      @else
        <h3 class="text-center text-danger"><i class="fas fa-trash"></i> No data found</h3>
      @endif



<script type="text/javascript">
  $(document).ready(function(){
    studentDetails();
  });

</script>