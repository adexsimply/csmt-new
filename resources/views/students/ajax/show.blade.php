<div class="element-box">

  <div class="os-tabs-w">
      <div class="os-tabs-controls">
        <ul class="nav nav-tab-sticky nav-tabs smaller">
          <li class="nav-item active">
            <a class="nav-link text-center active" data-toggle="tab" href="#basic"><i class="fas fa-user-circle"></i> <br/>Basic details</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-center" data-toggle="tab" href="#health"><i class="fas fa-heart"></i> <br/>Health</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-center" data-toggle="tab" href="#parent"><i class="fas fa-user-tie"></i> <br/>Parent</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-center" data-toggle="tab" href="{{url('students/performance/'.$student->id)}}" onclick="oisRead(event)" data-type="purple" data-title="{{$student->surname.' '.$student->othernames}} performance" data-size="xl"><i class="fas fa-chart-bar"></i> <br/>Performance</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-center" data-toggle="tab" href="#others"><i class="fas fa-quote-left"></i> <br/>Others</a>
          </li>
        </ul>
        
      </div>

      <div class="tab-content">
          
          <div class="tab-pane active" id="basic">
              <div class="tablo-with-chart">
                  <table class="table">
                      <tbody>
                        <tr>
                            <td>Student ID:</td>
                            <td>{{$student->admission_no ? $student->admission_no : ''}}</td>
                        </tr>


                        <tr>
                            <td>Surname</td>
                            <td>{{$student->surname}}</td>
                        </tr>

                        <tr>
                            <td>Other names</td>
                            <td>{{$student->othernames}}</td>
                        </tr>

                        <tr>
                          <td>Gender</td>
                          <td>{{$student->gender}}</td>
                        </tr>

                        <tr>
                            <td>Date of birth</td>
                            <td>{{$student->dob}}</td>
                        </tr>

                        <tr>
                            <td>Current Class</td>
                            <td>{{$student->spy? $student->spy->current_class.' '.$student->spy->arm : ''}}</td>
                        </tr>


                        <tr>
                            <td>Category</td>
                            <td>{{$student->category ? $student->category->name : ''}}</td>
                        </tr>

                        <tr>
                            <td>Admitted session</td>
                            <td>{{$student->admitted_session ? $student->admitted_session->name : ''}}</td>
                        </tr>

                        

                        <tr>
                            <td>State of Origin</td>
                            <td>{{$student->state ? $student->state->name : ''}}</td>
                        </tr>

                        <tr>
                            <td>Local Government</td>
                            <td>{{$student->lga ? $student->lga->name : ''}}</td>
                        </tr>

                        <tr>
                            <td>Club</td>
                            <td>{{$student->club ? $student->club->name : ''}}</td>
                        </tr>

                        <tr>
                            <td>House</td>
                            <td>{{$student->house ? $student->house->colour : ''}}</td>
                        </tr>

                        <tr>
                            <td>Status</td>
                            <td>{!! App\Student::status($student->status) !!} &nbsp; <a data-student_id="{{$student->id}}" href="{{url('students/status')}}" class="changeStatus"><i class="fas fa-edit"></i></a> </td>
                        </tr>
                        
                      </tbody>
                  </table>
              </div>
          </div>


         <div class="tab-pane" id="health">
              <div class="tablo-with-chart">
                  <table class="table">
                      <tbody>
                        <tr>
                            <td>Health Challenges</td>
                            <td>{{$student->health_challenges}}</td>
                        </tr>


                        <tr>
                            <td>Genotype</td>
                            <td>{{$student->genotype}}</td>
                        </tr>

                        <tr>
                            <td>Blood group</td>
                            <td>{{$student->blood_group}}</td>
                        </tr>

                        <tr>
                          <td>Emergency treatment</td>
                            <?php
                                $emergency_treatment = $student->emergency_treatment;
                                if($emergency_treatment == 1)
                                  $emergency_treatment = '<span class="badge badge-success">YES</span>';
                                else
                                  $emergency_treatment = '<span class="badge badge-danger">NO</span>';
                             ?>
                          <td>{!! $emergency_treatment !!}</td>
                        </tr>

                        
                        

                        <tr>
                          <td>Immunization</td>
                            <?php
                                $immunization = $student->immunization;
                                if($immunization == 1)
                                  $immunization = '<span class="badge badge-success">YES</span>';
                                else
                                  $immunization = '<span class="badge badge-danger">NO</span>';
                             ?>
                          <td>{!! $immunization !!}</td>
                        </tr>

                        
                        

                        <tr>
                          <td>Lab test</td>
                            <?php
                                $lab_test = $student->lab_test;
                                if($lab_test == 1)
                                  $lab_test = '<span class="badge badge-success">YES</span>';
                                else
                                  $lab_test = '<span class="badge badge-warning">NO</span>';
                             ?>
                          <td>{!! $lab_test !!}</td>
                        </tr>

                        
                        
                      </tbody>
                  </table>
              </div>
          </div>


         <div class="tab-pane" id="parent">
              <div class="tablo-with-chart">
                   <table class="table">
                      <tbody>
                        <tr>
                            <td><i class="fas fa-user-circle"></i> Name</td>
                            <td>{{$student->parent ? $student->parent->name : ''}}</td>
                        </tr>

                       <tr>
                            <td><i class="fas fa-map-marker"></i> Address</td>
                            <td>{{$student->parent ? $student->parent->address : ''}}</td>
                        </tr>

                       <tr>
                            <td><i class="fas fa-phone"></i> Phone number</td>
                            <td>{{$student->parent ? $student->parent->phone1 : ''}}</td>
                        </tr>

                       <tr>
                            <td><i class="fas fa-phone-square"></i> Alternate Phone number</td>
                            <td>{{$student->parent ? $student->parent->phone2 : ''}}</td>
                        </tr>

                       <tr>
                            <td><i class="fas fa-phone-square"></i> Email</td>
                            <td>{{$student->parent ? $student->parent->email : ''}}</td>
                        </tr>

                      </tbody>
                  </table>
              </div>
          </div>

         <div class="tab-pane" id="others" style="min-height: 200px;">
            <a class="btn btn-info" data-type="purple" data-size="s" data-title="Add Remark For {{$student->surname.' '.$student->othernames}}" onclick="oisNew(event)" href="{{url('students/new-remark/'.$student->id)}}"><i class="os-icon os-icon-ui-49"></i> Add New</a>
            <hr>
              <div class="tablo-with-chart">
                <?php foreach ($remarks as $remark) { ?>

                    <div>
                      <h5><?php echo $remark->remark_title; ?> </h5>
                      <h6>Date : <?php echo $remark->remark_date; ?> </h6>
                      <p>
                        Description:  <?php echo $remark->remark_description; ?> 
                      </p>
                      
                    </div>
                    <hr>
                  <?php } ?>
              </div>
          </div>


      </div>

    </div>

    <a class="btn btn-primary" data-type="purple" data-size="xl" data-title="Update {{$student->surname.' '.$student->othernames}}" onclick="oisEdit(event)" href="{{url('students/edit/'.$student->id)}}"><i class="os-icon os-icon-ui-49"></i> Update student details</a>
  
</div>



<script type="text/javascript">
    
    $(document).ready(function(){
       /*Edit student details*/
      $(".edit").click(function(e){
          e.preventDefault();

          var url = $(this).attr('href');

          dialog(url,'Student Update','xl');

      });
    });

</script>

