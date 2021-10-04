
              <div class="element-box"> 
                              @if( count($students) > 0 )
                              <form method="post" onsubmit="oisForm(event)" action="{{url('comments/update-many')}}">

                                <div class="formAlert"></div>

                              <div class="table-responsive">
                               <table class="table table-lightborder">
                                  <thead>
                                    <tr>
                                      <th>S/N</th>
                                      <th>Student's ID</th>
                                      <th>Name</th>
                                      <th>Principal's Comment</th>
                                      <th>Teacher's Comment</th>
                                      <th>Hostel Parent's Comments</th>
                                    </tr>
                                  </thead>
                                  <tbody>


                                <input type="hidden" name="session_id" value="{{$session_id}}">
                                <input type="hidden" name="term_id" value="{{$term_id}}">
                                <input type="hidden" name="aagc_id" value="{{$aagc_id}}">
                                <input type="hidden" name="category_id" value="{{$category_id}}">

                                @foreach($students as $x => $student)


                                  <input type="hidden" name="student_id[]" value="{{$student->student_id}}" />
                                  

                                  <tr>
                                    <td>{{$x+1}}</td>
                                    <td><a class="studentDetails" href="{{url('students/show/'.$student->student_id)}}">{{$student->admission_no}}</a></td>
                                    <td>{{$student->surname.' '.$student->othernames}}</td>

                                    <td><input placeholder="Principal's comment" class="form-control" name="principal_comment[]" type="text" value="{{$student->principal_comment}}" /></td>

                                    <td><input placeholder="Teacher's comment" class="form-control" name="teacher_comment[]" type="text" value="{{$student->teacher_comment}}" /></td>

                                    <td><input placeholder="Hostel parent's comment" class="form-control" name="hostel_comment[]" type="text" value="{{$student->hostel_comment}}" /></td>
                                    
                                  </tr>
                                @endforeach



                                    </tbody>
                    
                                   </table>
                                </div>

                                <button class="btn btn-primary" type="submit"><i class="fas fa-check-circle"></i> Submit comment</button>

                              </form>

                              @else
                                  <h3 class="text-center text-danger"> <i class="fa fa-warning"></i> No active student found! </h3>
                              @endif
                            
                    </div>

<script type="text/javascript">
  $(document).ready(function(){
    formProcessor();
    studentDetails();
  });
</script>