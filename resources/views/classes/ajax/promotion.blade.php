                      <div class="element-box">
                        @if(count($students) > 0 )
                          
                          @if($term_id == 3)
                        <form onsubmit="oisForm(event)" method="post" action="{{url('classes/aagc/promotion')}}">

                          <div class="formAlert"></div>

                          {{@csrf_field()}}

                          <input type="hidden" name="old_aagc_id" value="{{$aagc_id}}" />

                          <input type="hidden" name="old_session_id" value="{{$session_id}}" />



                          <div class="form-group">
                            <label>Select next session</label>
                            <select class="form-control sessionOptions" required="" name="session_id"></select>
                          </div>


                              <div class="table-responsive">
                                <table class="table table-lightborder">
                                  <thead>
                                    <tr>
                                      <th>S/N</th>
                                      <th>Student's ID</th>
                                      <th>Name</th>
                                      <th>Score</th>
                                      <th>Average</th>
                                      <th>Promotion Status</th>
                                      <th>Next class</th>
                                      <th>Next class arm</th>
                                    </tr>
                                  </thead>
                                  <tbody>


                                @foreach($students as $x => $student)
                                <input type="hidden" name="student_id[]" value="{{$student->student_id}}" />
                                <input type="hidden" name="student_category_id" value="{{$student->student_category_id}}" />
                                  <tr>
                                    <td>{{$x+1}}</td>

                                    <td><a class="studentDetails" href="{{url('students/show/'.$student->student_id)}}">{{$student->admission_no}}</a></td>

                                    <td>{{$student->surname.' '.$student->othernames.' '.$student->status}}</td>
                                    <td>{{$student->totalScore}}</td>
                                    <td>{{round($student->totalScore / $student->totalSubject,2)}}</td>
                                    
                                    <td>
                                      <?php
                                      $promotion_status = App\Assessment::getPromotionStatus($aagc_id,$session_id,$student->student_id);
                                       // if(!empty($promotion_status)) {
                                       //  echo $promotion_status->promotion_status;
                                       //  }
                                       //  else {
                                       //    echo "NOT SET";
                                       //  }
                                     

                                      ?>
                                      <select name="promotion_status[]" class="form-control" required="">
                                        <?php if (!empty($promotion_status) && ($promotion_status->promotion_status!=0)) { ?>
                                        <option value="<?php echo $promotion_status->promotion_status ?>">
                                          <?php if ($promotion_status->promotion_status==1) { echo "Promoted"; } else { echo "Promoted on Trial";} ?></option>
                                        <?php } ?>
                                        <option></option>
                                        <option value="1">Promoted</option>
                                        <option value="2">Promoted on trial</option>
                                        <option value="0">Repeat</option>
                                      </select>
                                    </td>

                                    <td><select class="form-control classOptions"></select></td>
                                    <td><select name="aagc_id[]" class="form-control fullArmOptions"></select></td>
                                  </tr>
                                @endforeach

                                </tbody>
                    
                                   </table>
                                </div>

                                <button class="btn btn-primary" type="submit"> Submit promotion </button>
                            </form>

                            @else
                                <h3 class="text-danger text-center"><i class="fa fa-warning"></i> Promotion not available until the end of third term... </h3>
                            @endif


                            @else
                              <h3 class="text-danger text-center"><i class="fa fa-warning"></i> No Student available for promotion... </h3>
                            @endif


                            </div>


  <script type="text/javascript">
    $(document).ready(function(){

      classOptions();
      sessionOptions();
      studentDetails();

      /*Authenticate next session*/
      $(".sessionOptions").change(function(){
        var session_id = $(this).val();
        var current_session = '{{$session_id}}';

          if(session_id <= current_session){

            $.confirm({
              content : 'Please select a higher academic session <p><strong>Click Create to add a higher session</strong></p>',
              title : 'Invalid session',
              type:'red',
              buttons:{
                Create : function(){
                  // window.open('{{url("sessions")}}','_blank');
                  $(".sessionOptions").prop('selectedIndex',0);
                  newTab('{{url("sessions")}}#newSession');
                },
                Close: function(){
                  $(".sessionOptions").prop('selectedIndex',0);
                }
              }
            });

          }
            
      });




      $(".classOptions").change(function(){

          var that = $(this).parent().next().children('select');

          var group_class_id = $(this).val();

          that.html("<option>Collecting class arms......</option>");

    
          $.get('{{url("select/full-arms")}}/'+group_class_id,function(data){
            console.log(data);
            var fullArmOptions = "<option value=''>Select class arm</option>";

            $.each(data.fullArms,function(i,value){

                fullArmOptions+="<option value='"+value.id+"'>"+value.arm+"</option>";

            });


            that.html(fullArmOptions);

          });



      });


    });
  </script>