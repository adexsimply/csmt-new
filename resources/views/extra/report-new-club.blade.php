
              <div class="element-box"> 
                              <form method="post" onsubmit="oisForm(event)" action="{{url('extra/store-club-report')}}">

                                <div class="formAlert"></div>
                <h1>Comment Club</h1>

                              <div class="table-responsive">
                               <table class="table table-lightborder">
                                  <thead>
                                    <tr>
                                      <th>S/N</th>
                                      <th>Student's ID</th>
                                      <th>Name</th>
                                      <th>Performance</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                       <input hidden="" name="session_id" value="{{$session_id}}" /> 
                                       <input hidden="" name="term_id" value="{{$term_id}}" /> 
                                       <input hidden="" name="club_id" value="{{$club_id}}" /> 


                                @foreach($students as $x => $student)


                                  

                                  <tr>
                                    <td>{{$x+1}}
                                        <input hidden="" name="student_id[]" value="{{$student->id}}" />

                                       <input hidden="" name="aagc_id[]" value="{{$student->aagc_id}}" /> 
                                       <input hidden="" name="category_id[]" value="{{$student->student_category_id}}" /> 
                                  </td>
                                    <td><a class="studentDetails" href="{{url('students/show/'.$student->id)}}">{{$student->admission_no}}</a></td>
                                    <td>{{$student->surname.' '.$student->othernames}}</td>

                                    <td><input placeholder="Principal's comment" value="{{rand(20,100)}}" class="form-control" type="number" name="performance[]" type="number" /></td>
                                    
                                  </tr>
                                @endforeach



                                    </tbody>
                    
                                   </table>
                                </div>

                                <button class="btn btn-primary" type="submit"><i class="fas fa-check-circle"></i> Submit Report</button>

                              </form>
                    </div>

<script type="text/javascript">
  $(document).ready(function(){
    formProcessor();
    studentDetails();
  });
</script>