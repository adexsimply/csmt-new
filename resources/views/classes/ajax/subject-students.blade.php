    
    @if(count($students) > 0 )
    <div class="table-responsive">
            <table class="table table-lightborder">
                <thead>
                   <tr>
                      <th>S/N</th>
                       <th>Student's ID</th>
                       <th>Name</th>
                       <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
 

                                @foreach($students as $x => $student)
                                  <tr id="subjectStudent{{$student->pivot->id}}">
                                    <td>{{$x+1}}</td>

                                    <td><a class="studentDetails" href="{{url('students/show/'.$student->id)}}">{{$student->admission_no}}</a></td>

                                    <td>{{$student->surname.' '.$student->othernames}}</td>

                                    <td>
                                      <a data-type="dark" 
                                          onclick="oisDelete(event)" 
                                          data-hide="#subjectStudent{{$student->pivot->id}}"
                                          data-title="Remove {{$student->surname.' '.$student->othernames}}" 
                                          data-content="Are you sure you want to stop {{$student->surname.' '.$student->othernames}} from taking this subject ?" 
                                          data-toggle="tooltip" title="Remove student from subject" 
                                          data-id="{{$student->pivot->id}}" 
                                          href="{{url('classes/aagc/subject-student/destroy')}}"><i class="fas fa-trash text-danger"></i></a>
                                    </td>
                                    
                                  </tr>
                                @endforeach



                                    </tbody>
                    
                                   </table>
                                </div>
      @else
        <h3 class="text-center">No student found in selected subject</h3>
      @endif



<script type="text/javascript">
  $(document).ready(function(){
    studentDetails();
  });

</script>