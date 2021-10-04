
              <div class="element-box"> 
                              @if( count($students) > 0 )
                              <form method="post" onsubmit="oisForm(event)" action="{{url('comments/update-many-club')}}">

                                <div class="formAlert"></div>

                              <div class="table-responsive">
                               <table class="table table-lightborder">
                                  <thead>
                                    <tr>
                                      <th>S/N</th>
                                      <th>Student's ID</th>
                                      <th>Name</th>
                                      <th>Remark</th>
                                    </tr>
                                  </thead>
                                  <tbody>



                                       <input type="hidden" name="session_id" value="{{$session_id}}" /> 
                                       <input type="hidden" name="term_id" value="{{$term_id}}" /> 
                                       <input type="hidden" name="club_id" value="{{$club_id}}" /> 

                                @foreach($students as $x => $student)


                                  

                                  <tr>
                                    <td>{{$x+1}}
                                  <input type="hidden" name="student_id[]" value="{{$student->student_id}}" />

                                       <input type="hidden" name="aagc_id[]" value="{{$student->aagc_id}}" /> 
                                       <input type="hidden" name="category_id[]" value="{{$student->student_category_id}}" /> </td>
                                    <td><a class="studentDetails" href="{{url('students/show/'.$student->student_id)}}">{{$student->admission_no}}</a></td>
                                    <td>{{$student->surname.' '.$student->othernames}}</td>

                                    <td><input placeholder="Remark" class="form-control" name="remark[]" type="text" value="{{$student->remark}}" /></td>
                                    
                                  </tr>
                                @endforeach



                                    </tbody>
                    
                                   </table>
                                </div>

                                <button class="btn btn-primary" type="submit"><i class="fas fa-check-circle"></i> Submit Remark</button>

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