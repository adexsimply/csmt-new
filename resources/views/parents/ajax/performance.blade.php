<style type="text/css">
  th{
    text-align: center;
  }

  td{text-align: center;}

</style>
@if($aagcs)
  <div class="col-xs-12">
    
    <!-- Start accordion -->
    <div id="performanceAccordion">

      <!-- Collect classes and session as accordion header -->
      @foreach($aagcs as $x => $value)

       @php 
        $aagc = App\Aagc::find($value->aagc_id); 

        $session = App\Session::find($value->session_id);
        $active = App\Aagc::active();

        $subjects = App\Assessment::studentClassSubject($student_id,$value->aagc_id,$value->session_id);

        $cummulativeDivider = 0;

       @endphp

       <div class="card rounded-0 no-border bottom-50" id="performance{{$x}}">

          <div class="card-header transparent clearfix">
             <div class="pull-left">
                 <a class="card-link" data-toggle="collapse" href="#performanceCollapse{{$x}}">
                     <h5>
                       <i class="os-icon text-primary os-icon-ui-23"></i> 
                       {{$aagc->group_class ? $aagc->group_class->name : ''}} ({{isset($session->name) ? $session->name : ''}})
                     </h5>
                 </a>
             </div>
          </div>
          <hr class="no-space">

         <!-- Class arms as accordion content -->
        <div id="performanceCollapse{{$x}}" class="collapse {{$x == 0 ? 'show' : ''}}" data-parent="#performanceAccordion">

           <!-- Collect class arms -->
          <div class="card-body">
            @if($subjects)
              <div class="os-tabs-w">
                <div class="os-tabs-controls">
                  <ul class="nav nav-tab-sticky nav-tabs smaller">
                    <li class="nav-item active">
                      <a class="nav-link active" data-toggle="tab" href="#firstTerm{{$x+1}}">First term</a>
                    </li>
                      
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#secondTerm{{$x+1}}">Second term</a>
                    </li>
                    
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#thirdTerm{{$x+1}}">Third term</a>
                    </li>
                      
                    <!-- <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#cummulative{{$x+1}}">Cummulative</a>
                    </li> -->
                  </ul>
                    
                </div>

                
                <div class="tab-content">
                  <div class="tab-pane active" id="firstTerm{{$x+1}}">
                     @if($subjects)
                        
                        <table style="width: 100%;" class="table table-striped table-bordered dataTable">
                          <thead>
                            <tr>
                               <th>S/N</th>
                               <th>Subjects</th>
                               <th>1<sup>st</sup> Test</th>
                               <th>2<sup>nd</sup> Test</th>
                               <th>3<sup>rd</sup> Test</th>
                               <th>Exam</th>
                               <th>Total</th>
                               <th>Grade</th>
                               <th>Remark</th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach($subjects as $i => $subject)
                                
                                <!-- Collect grades -->
                                @php
                                  $score = App\Assessment::stupidLoading($subject->id,$student_id,$value->aagc_id,$value->session_id,1,false,false);
                                @endphp

                                @if($score)
                                  @php
                                    $total = $score->test1 + $score->test2 + $score->test3 + $score->exam;
                                    $cummulativeDivider=1;
                                  @endphp
                                  <tr>
                                    <td>{{$i+1}}</td>
                                    <td class="text-left">{{$subject->name}}</td>
                                    <td>{{$score->test1}}</td>
                                    <td>{{$score->test2}}</td>
                                    <td>{{$score->test3}}</td>
                                    <td>{{$score->exam}}</td>
                                    <td>{{$total}}</td>
                                    <td>{{App\Assessment::grade($total)}}</td>
                                    <td>{{App\Assessment::remark($total)}}</td>
                                  </tr>
                                @endif
                              @endforeach
                          </tbody>

                          </table>
                        
                      
                      @else
                        <h3 class="text-center text-danger"><i class="fas fa-trash"></i> No assessment found</h3>
                      @endif
                  </div>


                  <div class="tab-pane" id="secondTerm{{$x+1}}">
                    @if($subjects)
                        
                        <table style="width: 100%;" class="table table-striped table-bordered dataTable">
                          <thead>
                            <tr>
                               <th>S/N</th>
                               <th>Subjects</th>
                               <th>1<sup>st</sup> Test</th>
                               <th>2<sup>nd</sup> Test</th>
                               <th>3<sup>rd</sup> Test</th>
                               <th>Exam</th>
                               <th>Total</th>
                               <th>Grade</th>
                               <th>Remark</th>
                            </tr>
                          </thead>
                           <tbody>
                              @foreach($subjects as $i => $subject)
                                
                                <!-- Collect grades -->
                                @php
                                  $score = App\Assessment::stupidLoading($subject->id,$student_id,$value->aagc_id,$value->session_id,2,false,false);
                                @endphp

                                @if($score)
                                  @php
                                    $total = $score->test1 + $score->test2 + $score->test3 + $score->exam;
                                    $cummulativeDivider=2;
                                  @endphp
                                  <tr>
                                    <td>{{$i+1}}</td>
                                    <td class="text-left">{{$subject->name}}</td>
                                    <td>{{$score->test1}}</td>
                                    <td>{{$score->test2}}</td>
                                    <td>{{$score->test3}}</td>
                                    <td>{{$score->exam}}</td>
                                    <td>{{$total}}</td>
                                    <td>{{App\Assessment::grade($total)}}</td>
                                    <td>{{App\Assessment::remark($total)}}</td>
                                  </tr>
                                @endif
                              @endforeach
                          </tbody>

                          </table>
                        
                      
                      @else
                        <h3 class="text-center text-danger"><i class="fas fa-trash"></i> No assessment found</h3>
                      @endif
                  </div>


                  <div class="tab-pane" id="thirdTerm{{$x+1}}">
                    @if($subjects)
                        
                        <table style="width: 100%;" class="table table-striped table-bordered dataTable">
                          <thead>
                            <tr>
                               <th>S/N</th>
                               <th>Subjects</th>
                               <th>1<sup>st</sup> Test</th>
                               <th>2<sup>nd</sup> Test</th>
                               <th>3<sup>rd</sup> Test</th>
                               <th>Exam</th>
                               <th>Total</th>
                               <th>Grade</th>
                               <th>Remark</th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach($subjects as $i => $subject)
                                
                                <!-- Collect grades -->
                                @php
                                  $score = App\Assessment::stupidLoading($subject->id,$student_id,$value->aagc_id,$value->session_id,3,false,false);
                                @endphp

                                @if($score)
                                  @php
                                    $total = $score->test1 + $score->test2 + $score->test3 + $score->exam;
                                    $cummulativeDivider=3;
                                  @endphp
                                  <tr>
                                    <td>{{$i+1}}</td>
                                    <td class="text-left">{{$subject->name}}</td>
                                    <td>{{$score->test1}}</td>
                                    <td>{{$score->test2}}</td>
                                    <td>{{$score->test3}}</td>
                                    <td>{{$score->exam}}</td>
                                    <td>{{$total}}</td>
                                    <td>{{App\Assessment::grade($total)}}</td>
                                    <td>{{App\Assessment::remark($total)}}</td>
                                  </tr>
                                @endif
                              @endforeach
                          </tbody>

                          </table>
                        
                      
                      @else
                        <h3 class="text-center text-danger"><i class="fas fa-trash"></i> No assessment found</h3>
                      @endif
                  </div>


                </div>

              </div>
            @else
              <h3 class="text-center text-danger"><i class="fas fa-trash"></i> No assessment found</h3>
            @endif
          </div>
        </div>

       </div>

     @endforeach
   </div>
  </div>
@else
  <h3 class="alert alert-danger text-center">No data found</h3>
@endif