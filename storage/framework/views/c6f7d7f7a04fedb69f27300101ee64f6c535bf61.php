<?php error_reporting(0); ?>
<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo e(config('app.name')); ?> Junior result</title>

  <link href='http://fonts.googleapis.com/css?family=Michroma' rel='stylesheet' type='text/css'>
        <link href="<?php echo e(asset('bower_components/bootstrap/bootstrap.css')); ?>" rel="stylesheet" >
          <style type="text/css">
          html, body {
            margin-top: auto;
            margin-right: auto;
            margin-left: auto;
            margin-bottom: 200px;
            page-break-inside: avoid;
            break-inside: avoid;
          }
          .page {
            width: 820px;
            margin-top: auto;
            margin-right: auto;
            margin-left: auto;
            margin-bottom: 200px;
              page-break-inside: avoid;
            break-inside: avoid;
          }
          table {
              page-break-inside: avoid;
            break-inside: avoid;
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
               page-break-inside: avoid;
            break-inside: avoid;
          }
          .page {
              page-break-inside: avoid;
            break-inside: avoid;

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
            font-size:18px;
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
<?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php
                                      if($x == 0){
                                        $position= $x +1;
                                        $previousScore = $student->gp; 
                                      }

                                      else {

                                        if($previousScore == $student->gp){
                                          
                                          $previousScore = $student->gp;
                                        }
                                        else{
                                          $position = $x + 1;
                                          $previousScore = $student->gp;
                                        }

                                      }


                                  ?>

    <body>
      <?php 
            $student = App\Student::find($student->id); 
            $total = 0;
            $aagc_info = App\Assessment::aagc_info($session_id,$student->id,$aagc_id);
            if (!empty($aagc_info)) {
            if ($aagc_info->promotion_status==0) {
              $promotion_status = "NOT PROMOTED";
            }
            elseif ($aagc_info->promotion_status==1) {
              $promotion_status = "PROMOTED";
            }
            else {
              $promotion_status = "PROMOTED ON TRIAL";
            }

            }
            $subject_count = count (App\Assessment::subject_count($aagc_id,$session_id,$term_id,$student->id));
            //echo $subject_count->subject_id;
            //echo count($subject_count);
        ?>
       <div class="page" style="padding:25px;">
          <div class="main-top">
            <div>
            <img src="<?php echo e(asset('storage/images/logo-lg.jpg')); ?>" width="300px">
              <h1>CSMT Staff Secondary School</h1>
              
              <p>Along Watchman Street, P.M.B. 147, Abakaliki, Ebonyi State, Nigeria<br>
              <strong>Email:</strong> csmtschools@gmail.com  <strong>Tel:</strong> 08032124870, 07060725882</p>
              <h2 style="margin-top:12px;margin-left:55px;"><?php echo e(App\Term::find($term_id)->name); ?> REPORT SHEET</h2>
            </div>
          </div>
          <div align="right" style="margin-top:-25px;font-size:13px;"><strong class="blue-st"><?php echo e(App\Session::find($session_id)->name); ?></strong><strong>&nbsp;Academic Session</strong></div>

                  <div class="main">
                  <table class="table table-bordered table-condensed" style="margin-top:px;padding:5px;">
                    <tbody>
                      <tr>
                        <td class="input" style="padding:3px;"><strong>Student's&nbsp;ID:</strong>&nbsp;<strong class="blue-st"><?php echo e($student->admission_no); ?></strong></td>
                        <td class="input" style="padding:3px;"><strong>Student's&nbsp;Name:</strong>&nbsp;<strong class="blue-st">
                        <?php echo e($student->surname.' '.$student->othernames); ?></strong></td>
                        <td class="input" style="padding:3px;"><strong>Class:&nbsp;</strong><strong class="blue-st">
                        <?php echo App\Aagc::name($aagc_id); ?></strong></td>
                        </tr>
                    </tbody>
                  </table>
                <table class="table table-bordered table-condensed" style="margin-top:-18px;">
                  <tbody>
                      <tr>
                        <td width="14%"><strong>House:&nbsp;</strong><strong class="blue-st">
                        <?php if(!empty($student->house->color)): ?> <?php echo e($student->house->colour); ?> <?php endif; ?></strong></td>
                        <td width="17%"><strong>Club:&nbsp;</strong><strong class="blue-st">
                        <?php echo e($student->club->name); ?></strong></td>
                        <td width="17%"><strong>No. in Class:&nbsp;</strong><strong class="blue-st">
                        <?php echo e(App\Assessment::classCount2($aagc_id,$session_id,$student->student_category_id,$term_id)); ?>

                        </strong></td>
                        <td width="27%"><strong>Next&nbsp;Term&nbsp;Begins:&nbsp;</strong><strong class="blue-st">
                 <?php

                    $ntb = App\Assessment::ntb($session_id,$term_id,$student->student_category_id);
                    if(!empty($ntb)) {
                    echo $ntb->begins;
                    }
                    else {
                      echo "NOT SET";
                    }


                  ?>
</strong></td>
                      </tr>
                  </tbody>
                </table>
                  <div class="panel panel-info" style="margin-top:-18px;line-height:1;">
                    <div class="panel-heading"><h4 style="margin:0;">ACADEMIC REPORT (COGNITIVE DOMAIN)</h4></div>


                  <!-- Grade head -->
              <table class="table table-bordered table-striped table-condensed" style="line-height:1px;border: 1px solid black;" width="100%">
                    <thead>
                      <tr style="border-bottom:2px solid black;">
                        <th class="blue-st"></th>
                        <th class="blue-st" colspan="2"></th>
                        <th style=" text-align:center" class="blue-st">1st<br/>Test</th>
                        <th style=" text-align:center" class="blue-st">2nd<br/>Test</th>
                        <th style=" text-align:center" width="5%" class="blue-st">3rd<br/>Test</th>
                        <th style=" text-align:center" width="5%" class="blue-st">Micro<br/>Exam</th>
                        <th style=" text-align:center" width="5%" class="blue-st">Exam</th>
                        <th style=" text-align:center" class="blue-st">Total<br/>Score</th>
                        <th style=" text-align:center" class="blue-st">Grd.</th>
                        <th style="" class="blue-st" width="12%">Remarks</th>
                      </tr>
                      <tr style="border-bottom:2px solid black;">
                        <th class="blue-st">S/N</th>
                        <th class="blue-st" colspan="2">Subject</th>
                        <th style=" text-align:center" class="blue-st">10</th>
                        <th style=" text-align:center" class="blue-st">10</th>
                        <th style=" text-align:center" class="blue-st">10</th>
                        <th style=" text-align:center" class="blue-st"><?php if ($session_id > 4) { echo "20"; } else { echo "10"; } ?></th>
                        <th style=" text-align:center" class="blue-st"><?php if ($session_id > 4) { echo "50"; } else { echo "60"; } ?></th>
                        <th style=" text-align:center" class="blue-st">100</th>
                        <th style=" text-align:center" class="blue-st"></th>
                        <th style=" text-align:center" class="blue-st"></th>
                      </tr>
                    </thead>
                    <tbody class="input">
                    <?php $j=1; $eternal=1;?>


                    <?php $__currentLoopData = App\Subject_category::where('subject_school_id',2)->withCount('subjects')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $Category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                      <!-- Print category name in the first loop -->
                      <?php if ($Category->name!="Others") {?>
                        <tr>
                          <td rowspan="<?php if ($Category->name=='NATIONAL VALUES EDUCATION') { echo $Category->subjects_count ; } else echo $Category->subjects_count +1;  ?>"><?php echo $j; $j++;?></td>
                          <td  rowspan="<?php if ($Category->name=='NATIONAL VALUES EDUCATION') { echo $Category->subjects_count ; } else echo $Category->subjects_count +1;  ?>" class="blue-subj" style="font-size:11.5px;">
                            <?php echo e($Category->name); ?>

                          </td>
                        </tr>
                      
                        
                      <?php $subjects = App\Assessment::classSubjectStudent($aagc_id,$session_id,$term_id,$student->id);


                       ?>
                         <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          
                            <?php if(App\Subject::categoryId($subject->id)->subject_category_id == $Category->id): ?>
                              <tr>
                                  <td class="blue-subj" style="font-size:12px;"><?php echo e($subject->name); ?></td>

                                  <?php $score = App\Assessment::termStudentScore($student->id,$subject->id,$aagc_id,$session_id,$term_id);
                                  
                             $practical = $score['scores']['practical'];
                             $exam = $score['scores']['exam'];
                             if (!is_null($practical) && !is_null($exam)) {
                              $exam_total = $practical + $exam;
                             }
                             elseif (!is_null($practical) && is_null($exam)) {
                              $exam_total = $practical;
                             }
                             elseif(empty($score['scores']['practical']) && empty($score['scores']['exam'])) {
                              $exam_total = "OK";
                             }
                             else {
                              $exam_total = $exam;
                             }


                                   ?>

                                  <td style=" text-align:center;border: 1px solid black;font-size:12px;"><?php echo e(!is_null($score['scores']['test1']) ? $score['scores']['test1'] : '-'); ?></td>
                                  <td style=" text-align:center;font-size:12px;"><?php echo e(!is_null($score['scores']['test2']) ? $score['scores']['test2'] : '-'); ?></td>
                                  <td style=" text-align:center;font-size:12px;"><?php echo e(!is_null($score['scores']['test3']) ? $score['scores']['test3'] : '-'); ?></td>
                                  <td style=" text-align:center;font-size:12px;"><?php echo e(!is_null($score['scores']['micro_exam']) ? $score['scores']['micro_exam'] : '-'); ?></td>
                                  <td style=" text-align:center;font-size:12px;"><?php echo e($exam_total); ?></td>
                                  <td style=" text-align:center;font-size:12px;"><strong class="blue-st"><?php echo e($score['gp']); ?></strong></td>
                                  <td class="blue-subj" style="font-size:12px;"><?php echo e($score['grade']); ?></td>
                                  <td style="font-size:12px;"><strong class="blue-st"><?php echo e($score['remark']); ?></strong></td>
                              </tr>

                              <?php 
                                    $total+= $score['gp'];
                                    $eternal++; 
                              ?>
                            <?php endif; ?>

                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                       <?php }
                       else {
                        ?>      

                         <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          
                            <?php if(App\Subject::categoryId($subject->id)->subject_category_id == $Category->id): ?>
                              <tr>
                                  <td><?php echo $j; $j++; 
                                  ?></td>
                                  <td class="blue-subj" colspan="2"><?php echo e($subject->name); ?></td>

                                  <?php $score = App\Assessment::termStudentScore($student->id,$subject->id,$aagc_id,$session_id,$term_id);


                                     $practical = $score['scores']['practical'];
                                     $exam = $score['scores']['exam'];
                                     if (!is_null($practical) && !is_null($exam)) {
                                      $exam_total = $practical + $exam;
                                     }
                                     elseif (!is_null($practical) && is_null($exam)) {
                                      $exam_total = $practical;
                                     }
                                     elseif(is_null($practical) && is_null($exam)) {
                                      $exam_total = "-";
                                     }
                                     else {
                                      $exam_total = $exam;
                                     }


                                   ?>

                                   <td style=" text-align:center;border: 1px solid black;font-size:12px;"><?php echo e(!is_null($score['scores']['test1']) ? $score['scores']['test1'] : '-'); ?></td>
                                  <td style=" text-align:center;font-size:12px;"><?php echo e(!is_null($score['scores']['test2']) ? $score['scores']['test2'] : '-'); ?></td>
                                  <td style=" text-align:center;font-size:12px;"><?php echo e(!is_null($score['scores']['test3']) ? $score['scores']['test3'] : '-'); ?></td>
                                  <td style=" text-align:center;font-size:12px;"><?php echo e(!is_null($score['scores']['micro_exam']) ? $score['scores']['micro_exam'] : '-'); ?></td>
                                  <td style=" text-align:center;font-size:12px;"><?php echo e($exam); ?></td>
                                  <td style="text-align:center;font-size:12px;"><strong class="blue-st"><?php echo e($score['gp']); ?></strong></td>
                                  <td class="blue-subj" style="font-size:12px;"><?php echo e($score['grade']); ?></td>
                                  <td style="font-size:12px;"><strong class="blue-st"><?php echo e($score['remark']); ?></strong></td>
                              </tr>

                              <?php 
                                    $total+= $score['gp'];
                                    $eternal++; 
                              ?>
                            <?php endif; ?>

                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                        <?php
                       }
                       ?> 


                      
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
              </tbody>
            </table>
                  <div class="panel-footer text-center" style="font-size:14px; color:blue !important; padding:3px; border:1px solid black;">
                    GRADE DETAILS: <strong>A</strong> = 70-100%, <strong>B</strong> = 60-69%, <strong>C</strong> = 50-59%, <strong>D</strong> = 45-49%, <strong>E</strong> = 40-44%, <strong>F</strong> = 0-39%
                  </div>
            <div class="panel-footer text-center" style="font-size:13px; margin-top:1px; padding:5px; border:1px solid black; letter-spacing: 2px">
              <strong>Total:</strong> <strong class="blue-st"><?php echo e($total); ?>&nbsp;</strong> <strong>Student's Average:</strong> <strong class="blue-st"><?php echo e(round($total / $subject_count)); ?></strong>
              <strong>&nbsp; Position in Class:</strong> <strong class="blue-st"><?php echo Addon::position($position); ?></strong>
              &nbsp;<strong>Result:</strong> <strong class="blue-st"><?php if($total / $subject_count >44): ?> PASS <?php else: ?> FAIL <?php endif; ?></strong>&nbsp; &nbsp;<?php if(App\Term::find($term_id)->name=='THIRD TERM'): ?><strong>Status: </strong> <strong class="blue-st">
              <?php echo e($promotion_status); ?></strong><?php endif; ?>
            </div>
      </div>




      <div class=""></div>
        <div class="panel-heading" style="width:49%;float:left;margin-top:-18px;line-height:1;"><h4 style="margin:0">CHARACTER REPORT(AFFECTIVE DOMAIN)</h4></div>
        <div class="panel-heading" style="width:49%;float:right;margin-top:-18px;line-height:1;"><h4 style="margin:0">SKILLS REPORT(PSYCHOMOTOR DOMAIN)</h4></div>

        <table class="table table-bordered table-condensed table-responsive" style="width:49%;float:left;">
          <tbody>
              <tr style="height: 50px;">
                <td style="padding-top: 10px">Punctuality</td><td style="padding-top: 10px">Classroom:&nbsp;<?php echo e(App\Assessment::remark(App\Assessment::cPunctuality($aagc_id,$session_id,$term_id,$student->id))); ?>

                                         <div><div id="span1" class="t">Resumption:&nbsp;
                                         <?php echo e(strtoupper(App\Assessment::rPunctuality($aagc_id,$session_id,$term_id,$student->id))); ?></div></div></td>
              </tr>
              <tr style="height: 30px;">
                <td>Attendance</td><td>Classroom:&nbsp;
                <?php echo e(App\Assessment::remark(App\Assessment::cAttendance($aagc_id,$session_id,$term_id,$student->id))); ?></td>
              </tr>
              <tr style="height: 25px;">
                <td>Carrying out Assignments</td><td>Classroom:&nbsp;<?php echo e(App\Assessment::remark(App\Assessment::sAssigment($aagc_id,$session_id,$term_id,$student->id))); ?><!-- <div><div id="span1" class="t">Hostel:&nbsp;<?php echo e(App\Assessment::remark(App\Assessment::hAssigment($aagc_id,$session_id,$term_id,$student->id))); ?>

                                         </div></div> --></td>
              </tr>
              <tr style="height: 50px;">
                <td style="padding-top: 10px">Others</td><td>Clinic:&nbsp; <?php if (App\Assessment::attendanceCount($aagc_id,$session_id,$term_id,$student->id) >0) { echo App\Assessment::remark2((App\Assessment::clinicCount($aagc_id,$session_id,$term_id,$student->id)*100)/App\Assessment::attendanceCount($aagc_id,$session_id,$term_id,$student->id)); } else { echo "NOT REGULAR"; } ?><div><div id="span1" class="t">Exeat:&nbsp; <?php if (App\Assessment::attendanceCount($aagc_id,$session_id,$term_id,$student->id)>0) { echo App\Assessment::remark2((App\Assessment::exeatCount($aagc_id,$session_id,$term_id,$student->id)*100)/App\Assessment::attendanceCount($aagc_id,$session_id,$term_id,$student->id)); } else { echo "NOT REGULAR"; } ?> </div></div></td>
              </tr>
          </tbody>
        </table>
        <table class="table table-bordered table-condensed table-responsive" style="width:49%;float:right;">
          <tbody>
                 <?php
                    $psychomotor = App\Assessment::psychomotor($aagc_id,$session_id,$term_id,$student->id);


                  ?>
              <tr>
                <td>Craft Skills</td><td> <?php echo e($psychomotor ? $psychomotor->craft_skill : '-'); ?></td>
              </tr>
             <!--  <tr>
                <td>Project Theme</td><td> <?php echo e($psychomotor ? $psychomotor->pet_project : '-'); ?></td>
              </tr> -->
              <tr>
                <td>Remark</td><td> <?php echo e($psychomotor ? $psychomotor->remark : '-'); ?></td>
              </tr>
              <tr>
                <td>Sporting Activities</td><td><?php echo e($psychomotor ? $psychomotor->sport : '-'); ?></td>
              </tr>
          </tbody>
        </table>
        <div class="panel-heading" style="width:49%;float:right;margin-top:-18px;line-height:1;"><h4 style="margin:0">CLUB REPORT</h4></div>
        <table class="table table-bordered table-condensed table-responsive" style="width:49%;float:right;">
          <tbody>
                 <?php
                    $performance = App\Assessment::performance($aagc_id,$session_id,$term_id,$student->id);
                    $club_remark = App\Assessment::club_remark($aagc_id,$session_id,$term_id,$student->id);
                  ?>
              <tr>
                <td>Club Performance</td><td> <?php echo e($performance ? App\Assessment::remark($performance->performance) : '-'); ?></td>
              </tr>
              <tr>
                <td>Project Theme</td><td>  <?php echo e($psychomotor ? $psychomotor->pet_project : '-'); ?></td>
              </tr>
              <tr>
                <td>Remark</td><td>  <?php echo e($club_remark ? $club_remark->remark : '-'); ?></td>
              </tr>
          </tbody>
        </table>
 
           
      <div style="width:66%;font-size:20px;float:left;margin-top:-15px;"> 
        
        <p>Comment by Form Teacher: <span class="blue-com"><?php echo e($aagc_info->teacher_comment ? $aagc_info->teacher_comment : 'NO COMMENT YET'); ?></span><br/>
          <?php 
          if ($student->student_category_id ==1) {?>
        Comment by Hostel Parent: <span class="blue-com"><?php echo e($aagc_info->hostel_comment ? $aagc_info->hostel_comment : 'NO COMMENT YET'); ?></span><br/>

        <?php } ?>
        Comment by Principal: <span class="blue-com"><?php echo e($aagc_info->principal_comment ? $aagc_info->principal_comment : 'NO COMMENT YET'); ?></span></p>
        
      </div>
      <div style="width:32%;float:right;margin-top:-15px;">
        <div style="margin-bottom:0;border:1px solid black;" class="well well-lg"><img src="<?php echo e(asset('storage/images/siggy.jpg')); ?>" width="200px" height="30px"></div>
        <p class="text-center large" style="font-size:18px; font-weight:bold;">Signature</p>
        </div>




        </div>
    </div>
      </body>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          
  </html>                      

