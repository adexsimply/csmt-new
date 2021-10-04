@extends('layouts.app')
@section('title','Subject assessment')
@section('content')

<style type="text/css">
  th{
    text-align: center;
  }

  td{
    text-align: center;
  }
</style>
  <ul class="breadcrumb">
             <li class="breadcrumb-item">
              <a href="{{url('home')}}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
              <a href="{{url('classes')}}">All classes</a>
            </li>
            <li class="breadcrumb-item">
              <span>{{$subject->name}} assessments</span>
            </li>
          </ul>
          <!--------------------
          END - Breadcrumbs
          -------------------->
          <div class="content-i">
            <div class="content-box">
                <div class="element-wrapper">
                    
                    <h5 class="element-header">
                  &nbsp;&nbsp;  <a target="_blank" href="{{url('assessments/printer-continuous/'.$subject->id.'/'.$aagc_id.'/'.$category_id.'/'.$session_id)}}"><button class="btn btn-danger float-right">Print</button></a>&nbsp;
                      {!! App\Aagc::name($aagc_id) !!} {{$subject->name}} Assessment
                      <a href="#" class="moreOption float-right"><i class="fa fa-search"></i> More Options </a>
                    </h5>



                    <!-- <div class="element-box">
                     
                    </div> -->

                    <div class="element-box table-responsive">


                     
                     @if(Addon::isEmpty($assessments))
                      
                        <table style="width: 100%;" class="table table-striped table-bordered dataTable">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Student's ID</th>
                                    <th>Name</th>
                                    <th>1<sup>st</sup> Test</th>
                                    <th>2<sup>nd</sup> Test</th>
                                    <th>3<sup>rd</sup> Test</th>
                                    <th>Cum. CAT</th>
                                    <th>OBJ</th>
                                    <th>Exam</th>
                                    <th>Total</th>
                                    <th>Grade</th>
                                    <th>Remark</th>
                                    <th class="no-print">Options</th>
                                </tr>
                            </thead>
                            <tbody>

                              @foreach($assessments as $x => $assessment)
                                  <?php

                                    $test1 = $assessment->test1;
                                    $test2 = $assessment->test2;
                                    $test3 = $assessment->test3;
                                    $practical = $assessment->practical;
                                    $micro_exam = $assessment->micro_exam;
                                   // $cum_cat = round(($test1+$test2+$test3)/2);

                                    $exam = $assessment->exam;
                                    $total_exam = $exam + $micro_exam;


                                    $gp = App\Assessment::gradeHelperCat($test1,$test2,$test3,$micro_exam,$practical,$exam);

                                    $cum_cat = App\Assessment::cumCat($test1,$test2,$test3);

                                   ?>
                                <tr id="{{$assessment->id}}">
                                  <td>{{$x+1}}</td>
                                  <td><a class="studentDetails" href="{{url('students/show/'.$assessment->student_id)}}">{{$assessment->admission_no}}</a></td>
                                  <td class="text-left">{{$assessment->surname.' '.$assessment->othernames}}</td>
                                  <td>{{is_null($test1) ? "-": $test1 }}</td>
                                  <td>{{is_null($test2) ? "-": $test2}}</td>
                                  <td>{{is_null($test3) ? "-": $test3}}</td>
                                  <td>{{App\Assessment::cumCat($test1,$test2,$micro_exam)}}</td>
                                  <td>{{is_null($micro_exam) ? "-": $micro_exam}}</td>
                                  <td>{{is_null($exam) ? "-": $exam}}</td>
                                  <?php 

                                    if (is_null($test1)) {
                                      $test1 = 0;
                                    }
                                     if (is_null($test2)) {
                                      $test2 = 0;
                                    }
                                     if (is_null($micro_exam)) {
                                      $micro_exam = 0;
                                    }
                                     if (is_null($exam)) {
                                      $exam = 0;
                                    }
                                  ?>
                                  <td>{{$cum_cat+$total_exam}}</td>
                                  <td>{{App\Assessment::grade($cum_cat+$total_exam)}}</td>
                                  <td>{{App\Assessment::remark($cum_cat+$total_exam)}}</td>
                                  <td class="no-print">
                                    <a onclick="oisDelete(event)" href="{{url('assessments/destroy')}}" data-id="{{$assessment->id}}"  class="text-danger delete" href="#" title="Delete">
                                      <i class="os-icon os-icon-ui-15"></i>
                                    </a>
                                    <a href="{{url('assessments/edit/'.$assessment->id)}}" title="Edit" class="edit">
                                      <i class="os-icon os-icon-ui-49"></i>
                                    </a>
                                  </td>
                                </tr>
                              @endforeach
                            </tbody>

                        </table>
                      
                    
                    @else
                      <h3 class="text-center text-danger"><i class="fas fa-trash"></i>  No assessment found</h3>
                    @endif

                    </div>
                </div>
              

              
            </div>
          </div>

@endsection


@section('modal')
  <!-- Create new subject modal -->
  <div class="modal fade" id="moreOption">
    <div class="modal-dialog modal-md ">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-name">Fetch assessment</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form method="get" action="{{url('assessments/printer')}}">

                        

                        <input type="hidden" name="aagc_id" value="{{$aagc_id}}" />

                        
                        <div class="form-group">
                          <select class="form-control sessionOptions" required="" name="session_id"></select>
                        </div>

                        <div class="form-group">
                          <select class="form-control termOptions" required="" name="term_id"></select>
                        </div>

                         <div class="form-group">
                            <select name="subject_id" required="" class="form-control subjectOptions"></select>
                         </div>

                        <div class="form-group">
                          <button class="btn btn-primary" type="submit">View Result</button>

                          
                        </div>

                      


                      </form>
        </div>

      </div>
    </div>
  </div>
@endsection



@section('script')
  <script type="text/javascript">
    $(document).ready(function(){

      $("#table").DataTable();


      $(".moreOption").click(function(e){
        e.preventDefault();
        sessionOptions('{{$session_id}}');
        termOptions('{{$term_id}}');
        var value = '{{$aagc_id}}';
        subjectOptions('{{$subject->id}}','id IN (SELECT subject_id FROM aagc_subject WHERE aagc_id='+value+')');

        $("#moreOption").modal('show');
      });


      $(".edit").click(function(e){
          e.preventDefault();
          var url = $(this).attr('href');
          
          $.dialog({
              content: function () {
                  var self = this;
                  return $.ajax({
                      url: url,
                      method: 'get',
                  }).done(function (data) {
                      self.setContent(data);
                      self.setTitle('Edit Assessment');
                  }).fail(function(){
                      self.setContent('Something went wrong');
                  });
              },
              columnClass: 'm',
          });


      });

    });
  </script>
@endsection

