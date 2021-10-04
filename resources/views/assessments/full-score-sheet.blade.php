@extends('layouts.app')
@section('title','Cummulative assessment')
@section('content')

<style type="text/css">
  th{
    text-align: center;
  }
  td{
    text-align: center;
  }

</style>

          <div class="content-i">
            <div class="content-box">
                <div class="element-wrapper">
                    
                    <h3 class="element-header">
                      {!! App\Aagc::name($aagc_id) !!} {{App\Student::categoryName($category_id)}}

                      @php
                          if($cummulative)
                            echo 'Cummulative result';

                          else if($term_id)
                            echo App\Session::find($session_id)->name.' '.App\Term::find($term_id)->name.' result';

                       @endphp

                     <!--  <div class="btn-group float-right">  


                        <a href="{{url('assessments/cummulative/'.$aagc_id.'/'.$session_id)}}" class="btn btn-primary"><i class="fas  fa-bar-chart"></i> Cummulative </a>

                      </div> -->
                      <a target="_blank" href="{{url('assessments/class-master-sheet-printer/'.$aagc_id.'/'.$category_id.'/'.$session_id.'/'.$term_id)}}"><button class="btn btn-danger">Print Master Sheet</button></a>
                      <a target="_blank" href="{{url('assessments/class-result-standing-printer/'.$aagc_id.'/'.$category_id.'/'.$session_id.'/'.$term_id)}}"><button class="btn btn-success">Print Result Standing</button></a>
                        <!-- <a href="#" class="moreOption float-right"><i class="fas  fa-search"></i>  </a> -->
                      <a target="_blank" href="{{url('assessments/class-assessment-pdf/'.$aagc_id.'/'.$category_id.'/'.$session_id.'/'.$term_id)}}"><button class="btn btn-primary">Print PDF</button></a>
                        <a href="#" class="moreOption float-right"><i class="fas  fa-search"></i>  </a>

                    </h3>

                    

                    <div class="element-box">


                     
                     @if( Addon::isEmpty($students))

                     <div class="table-responsive">
                      
                        <table class="table dataTableFull table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Students' ID</th>
                                    <th class="text-left">Name</th>
                                    <th>Position</th>
                                    @foreach( $subjects as $subject)
                                      <th>{{$subject->name}}</th>
                                    @endforeach
                                    <th>Total</th>
                                    <th class="no-print">Print</th>
                                </tr>
                            </thead>
                            <tbody>
                           <?php


                                  //$rank = 0;
                                  $last_score = false;
                                  $rows = 0;

                                  //$previousScore=0;
                                  $position = 0;
                                  //$doublePosition = false;
                               ?>
                              @foreach($students as $x => $student)
                                <?php 

                                  $rows++;

                                    if( $last_score!= $student->gp ){
                                      $last_score = $student->gp;
                                      $position++;
                                    }
                                      
                                      // if($x == 0){
                                      //   $position= $x +1;
                                      //   $previousScore = $student->gp; 
                                      // }

                                      // else {

                                      //   if($previousScore == $student->gp){
                                      //     $previousScore = $student->gp;
                                      //     $doublePosition = true; 
                                      //   }
                                      //   else{
                                            
                                      //       if($doublePosition){
                                      //           $position = $x;
                                      //       } else{
                                      //           $position = $x + 1;
                                      //       }
                                          
                                      //     $previousScore = $student->gp;
                                      //   }

                                      // }


                                  ?>
                                <tr>
                                  <td>{{$x+1}}</td>
                                  <td><a onclick="oisRead(event)" data-type="purple" href="{{url('students/show/'.$student->id)}}">{{$student->admission_no}}</a></td>
                                  <td class="text-left">{{$student->surname.' '.$student->othernames}}</td>
                                  <td>{!! Addon::position($position) !!}</td>

                                  @php $total=0 @endphp

                                  @foreach($subjects as $subject)
                                    <td>

                                      @php
                                        $score =  App\Assessment::stupidLoading($subject->id,$student->id,$aagc_id,$session_id,$term_id);
                                        $score2 =  App\Assessment::checkDuplicateScores($subject->id,$student->id,$aagc_id,$session_id,$term_id);


                                        $total+=$score;
                                        
                                      @endphp

                                      {{$score}}@if (count($score2) >1)<span class="badge badge-warning">(!!)</span>@endif

                                    </td>
                                  @endforeach

                                  <td>{{$total}}</td>


                                  <td class="text-center no-print">
                                    @can('print report')

                                        <a target="_blank" href="{{App\Assessment::printUrl($student->id,$aagc_id,$session_id,$position,$group_class_id,$term_id,$cummulative)}}"><i class="fas  fa-print"></i></a>

                                    @endcan
                                    
                                  </td>
                                </tr>

                              @endforeach
                                
                            </tbody>
                              

                        </table>

                      </div>

                      @else 
                        <h3 class="text-center">No assessment found!</h3>
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
          <form method="get" action="{{url('assessments/class-assessment-printer')}}">

                        

                      

                        
                        <div class="form-group">
                          <select class="form-control classOptions"></select>
                        </div>

                        
                        <div class="form-group">
                          <select class="form-control fullArmOptions" required="" name="aagc_id"></select>
                        </div>
                        
                        <div class="form-group">
                          <select class="form-control sessionOptions" required="" name="session_id"></select>
                        </div>

                        <div class="form-group">
                          <select class="form-control termOptions" required="" name="term_id"></select>
                        </div>

                        <input type="hidden" name="category_id" value="{{$category_id}}">

                        <div class="form-group">
                          <button class="btn btn-primary" type="submit">View Result</button>

                          
                        </div>

                      


                      </form>
        </div>

      </div>
    </div>
  </div>
@endsection


<?php

    $group_class_id = App\Aagc::find($aagc_id)->group_class->id;

?>


@section('script')
  

  <script type="text/javascript">
    $(document).ready(function(){


      $('.dataTableFull').DataTable({
      // "processing": true,
      // "ajax": 'server.php',
      "dom": 'lBfrtip',
      // "pageLength": 100,
      "bPaginate": false,
      // "responsive": true,
      "fixedHeader": true,
      "buttons": [
            {
                extend: 'collection',
                text: 'Export',
                buttons: [
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ]

    });


      $(".moreOption").click(function(e){
        e.preventDefault();
        sessionOptions('{{$session_id}}');
        termOptions('{{$term_id}}');
        classOptions('{{$group_class_id}}');
        fullArmOptions('{{$group_class_id}}','{{$aagc_id}}');


        $(".classOptions").change(function(){
          var group_class_id = $(this).val();
          fullArmOptions(group_class_id);
        });
  

        $("#moreOption").modal('show');
      });

    });
  </script>
@endsection




