
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>CONTINUOUS ASSESSMENT SHEET | CSMT Schools</title>

        
  <link href='http://fonts.googleapis.com/css?family=Michroma' rel='stylesheet' type='text/css'>
        <link href="{{ asset('bower_components/bootstrap/bootstrap.css') }}" rel="stylesheet" >
          <style type="text/css">
          html, body {
            margin: 0;
            padding: 0;
          }
          .page {
            width: 820px;
            margin: auto;
          }
          
          .main-top {
            background-color: #fff;
            padding: 15px 20px;
          }
          .main-top img {
            width: 120px;
            float: left;
            height: 90px;
          }
          .main-top div {
            //width: 70%;
            text-align: center;
            margin: auto;
          }
          .main-top h1 {
            margin: 0;
            font-size: 28px;
            font-family: "Times New Roman", Times, serif;
            text-transform: uppercase;
            font-weight: bold;
            color: blue;
          }
          .main-top h2 {
            margin-bottom: 0;
            margin-left: 25px;
            font-size:19px;
            font-family: 'Sakkal Majalla', bold;
            letter-spacing: 0.5px;
            color: blue;
            font-weight: bold;
            line-height: 10px;
          }
          .main-top p {
            font-family: 'Sakkal Majalla', bold;
            margin: 0;
            font-size: 19px;
            font-weight: bold;
            line-height: 20px;
          }

          .input {
            font-family: 'Courier New', monospace;
            text-transform: uppercase;
          }
          .main td{
            font-family: 'Sakkal Majalla', bold;
            font-size: 13px;
            line-height: 1px;
            letter-spacing: 1px;
          }
          .blue-st {
            color: blue;
          } 
          .blue-com {
            font-family: "Comic Sans MS", cursive, sans-serif;
            text-transform: uppercase;
            font-size: 13px;
            color: blue;
          } 
          .blue-subj {
            color: blue !important;
          } 
      .panel-heading {
         background-color:#6A0691 !important;
         //box-shadow: 5px 5px 5px black;
      }
      .panel-heading h4{
         color:yellow !important;
        font-family: 'Sakkal Majalla', bold !important;
        font-weight: bold;
        font-size: 15px;
        text-align: center;
        line-height: 5px;
      }
      p{
        font-family: 'Sakkal Majalla', bold !important; 
        font-size: 15px;
      }
      .table-bordered > thead > tr > th,
      .table-bordered > tbody > tr > th,
      .table-bordered > tfoot > tr > th,
      .table-bordered > thead > tr > td,
      .table-bordered > tbody > tr > td,
      .table-bordered > tfoot > tr > td {
        border: 1px solid black !important;
        padding: 3px;
      }
          
        </style>
          <style type="text/css" media="print">
          @page 
          {
              size: auto;   /* auto is the initial value */
              margin: 1mm;  /* this affects the margin in the printer settings */
          }
          .main-top img {
            width: 120px;
            float: left;
            height: 90px;
          }
          .main-top div {
            //width: 70%;
            text-align: center;
            margin: auto;
          }
          .main-top h1 {
            margin: 0;
            font-size: 30px;
            font-family: "Times New Roman", Times, serif;
            text-transform: uppercase;
            font-weight: bold;
            color: blue !important;
          }
          .main-top h2 {
            margin-bottom: 0;
            font-size:23px;
            font-family: 'Sakkal Majalla', bold;
            letter-spacing: 0.5px;
            color: blue !important;
            font-weight: bold;
            line-height: 10px;
          }
          .main-top p {
            font-family: 'Sakkal Majalla', bold !important;
            margin: 0;
            font-size: 20px;
            font-weight: bold;
            line-height: 20px;
          }

          .input {
            font-family: 'Courier New', monospace;
            text-transform: uppercase;
          }
          .main td{
            font-family: 'Sakkal Majalla', bold;
            font-size: 15px;
            line-height: 1px;
            letter-spacing: 0.001px;
            border: 1px solid black;
            padding: 2px;
          }
          
          .blue-st {
            color: blue !important;
          } 
          .blue-com {
            font-family: "Comic Sans MS", sans-serif;
            font-size: 13px;
            text-transform: uppercase;
            color: blue !important;
          } 
          .blue-subj {
            color: blue !important;
          } 
      .panel-heading {
         background-color:#6A0691 !important;
         //box-shadow: 10px 10px 5px #888888;
      }
      .panel-heading h4{
         color:yellow !important;
        font-family: 'Sakkal Majalla', bold !important;
        font-weight: bold;
        font-size: 15px;
        text-align: center;
        line-height: 5px;
      }
      .table-bordered > thead > tr > th,
      .table-bordered > tbody > tr > th,
      .table-bordered > tfoot > tr > th,
      .table-bordered > thead > tr > td,
      .table-bordered > tbody > tr > td,
      .table-bordered > tfoot > tr > td {
        border: 1px solid black !important;
        padding: 3px;
      }
       body 
          {
              background-color:#FFFFFF; 
              border: solid 0px black ;
              margin: 1px;  /* this affects the margin on the content before sending to printer */

         }
      </style>
    </head>
    <body>

  <div class="page" style="padding:25px;">
    <div class="main-top">
      <div>
      <img src="{{ asset('storage/images/logo-lg.jpg') }}" width="300px">
        <h1>CSMT Staff Secondary School</h1>
        
        <p>Along Watchman Street, P.M.B. 147, Abakaliki, Ebonyi State, Nigeria<br>
        <strong>Email:</strong> csmtschools@gmail.com  <strong>Tel:</strong> 08032124870, 07060725882</p>
        <h2 style="margin-top:12px;margin-left:55px;">CONTINUOUS ASSESSMENT SHEET</h2>
      </div>
    </div>
    <div class="main">
      <table class="table table-bordered table-condensed" style="margin-top:-10px;">
        <tbody>
            <tr>
              <td><strong>Term:&nbsp;</strong><strong class="blue-st"></strong>{{App\Term::find($term_id)->name}}</td>
              <td><strong>Class:&nbsp;</strong><strong class="blue-st">{!! App\Aagc::name($aagc_id) !!}</strong></td>
              <td><strong>Category:&nbsp;</strong><strong class="blue-st">{{App\Student::categoryName($category_id)}} </strong></td>
              <td><strong>Session:&nbsp;</strong><strong class="blue-st">{{App\Session::find($session_id)->name}}</strong></td>
            </tr>
        </tbody>
      </table>

      <div class="panel panel-info" style="line-height:1;">
        <div class="panel-heading" style="background-color:#6A0691;"><h4 style="margin:0;">
          @php
          $subject = App\Assessment::subject_name($subject_id);
          @endphp
          {{$subject->name}}</h4></div>

          
                     
                     @if(Addon::isEmpty($assessments))
                      
                      <table class="table table-bordered table-striped table-condensed" style="line-height:1px;border: 1px solid black;" width="100%">
                          <thead>
                          <tr style="border-bottom:1px solid black;">
                            <th rowspan="2" class="blue-st">S/N</th>
                            <th rowspan="2" class="blue-st">Student ID</th>
                            <th rowspan="2" width="50%" style=" text-align:center" class="blue-st">Student Names</th>
                            <th colspan="7" style=" text-align:center" class="blue-st">Score</th>
                            <th rowspan="2" style=" text-align:center" class="blue-st">Grade</th>
                            <th rowspan="2" style=" text-align:center" class="blue-st">Remarks</th>
                          </tr>
                        <tr style="border-bottom:2px solid black;">
                          <th style=" text-align:center" class="blue-st">1st<br/>Test</th>
                          <th style=" text-align:center" class="blue-st">2nd<br/>Test</th>
                          <th style=" text-align:center" class="blue-st">3rd<br/>Test</th>
                          <th style=" text-align:center" class="blue-st">CUM<br/>CAT</th>
                          <th style=" text-align:center" class="blue-st">OBJ</th>
                          <th style=" text-align:center" class="blue-st">Exam&nbsp;</th>
                          <th style=" text-align:center" class="blue-st">Total&nbsp;</th>
                        </tr>
                           <!--  <tr style="border-bottom:1px solid black;">
                                    <th>S/N</th>
                                    <th>Student's ID</th>
                                    <th>Name</th>
                                    <th>1<sup>st</sup> Test</th>
                                    <th>2<sup>nd</sup> Test</th>
                                    <th>3<sup>rd</sup> Test</th>
                                    <th>Micro Exam</th>
                                    <th>Exam</th>
                                    <th>Total</th>
                                    <th>Grade</th>
                                    <th>Remark</th>
                                    <th class="no-print">Options</th>
                                </tr> -->
                            </thead>
                            <tbody class="input">

                              @foreach($assessments as $x => $assessment)
                                  <?php

                                    $test1 = $assessment->test1;
                                    $test2 = $assessment->test2;
                                    $test3 = $assessment->test3;
                                    $practical = $assessment->practical;
                                    $microexam = $assessment->micro_exam;

                                    $cum_cat = round(($test1+$test2+$microexam)/2);
                                    $exam = $assessment->exam;
                                    $total_exam = $exam + $microexam;


                                    $gp = App\Assessment::gradeHelper($test1,$test2,$test3,$practical,$microexam,$exam);

                                   ?>
                                <tr id="{{$assessment->id}}">
                                  <td>{{$x+1}}</td>
                                  <td class="blue-subj">{{$assessment->admission_no}}</td>
                                  <td width="50%" style="border: 1px solid black;" >{{$assessment->surname.' '.$assessment->othernames}}</td>
                                  <td>{{!is_null($test1) ? $test1 : '-'}}</td>
                                  <td>{{!is_null($test2) ? $test2 : '-'}}</td>
                                  <td>{{!is_null($test3) ? $test3 : '-'}}</td>
                                  <td>{{!is_null($cum_cat) ? $cum_cat : '-'}}</td>
                                  <td>{{!is_null($microexam) ? $microexam : '-'}}</td>
                                  <td>{{!is_null($exam) ? $exam : '-'}}</td>
                                  <td>{{round($cum_cat+$total_exam)}}</td>
                                  <td>{{App\Assessment::grade(round($cum_cat + $total_exam))}}</td>
                                  <td>{{App\Assessment::remark(round($cum_cat + $total_exam))}}</td>
                                </tr>
                              @endforeach
                    
              </tbody>
            </table>
                    @else
                      <h3 class="text-center text-danger"><i class="fas fa-trash"></i> No assessment found</h3>
                    @endif
      </div>
    </div>
  </div>
  
</body>
</html>
