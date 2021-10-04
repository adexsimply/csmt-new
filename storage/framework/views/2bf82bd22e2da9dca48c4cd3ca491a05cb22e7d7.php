<?php
// $link = mysqli_connect("localhost","root","","csmt-13") or die("ERROR CONNECTING TO DATBASE"); 
// $query_term_session =  mysqli_query($link, "SELECT * FROM session_term WHERE status='1' ");
// $row_t_s = mysqli_fetch_array($query_term_session);
// $ts_id = $row_t_s['id'];
// $t = $row_t_s['term_id'];
// $s = $row_t_s['session_id'];

// $i=1;
// $query = mysqli_query($link, "SELECT distinct student_id FROM assessments ORDER BY student_id ASC");
// while ($row=mysqli_fetch_array($query)) {
//   $student_id = $row['student_id'];
// $get_aagc = mysqli_query($link, "SELECT * FROM aagc_session_student WHERE session_id='$s' AND student_id='$student_id' ");
// $row_aagc = mysqli_fetch_array($get_aagc);
// $aagc_id = $row_aagc['aagc_id'];
//   //echo $row['student_id'].'-'.$aagc_id."<br/>";
//   $get_scores = mysqli_query($link, "SELECT * FROM assessments WHERE student_id='$student_id' AND aagc_id='$aagc_id' AND session_id='$s' AND term_id='$t' ");
//   $subject_total_overall = 0;
//   while ($row_scores = mysqli_fetch_array($get_scores)) {
//     $subject_total = $row_scores['test1'] + $row_scores['test2'] + $row_scores['test3'] + $row_scores['micro_exam'] + $row_scores['exam'];
//     //echo '('.$i.')'.$student_id.'=>'.$row_scores['subject_id'].'%'.$row_scores['test1'].'-'.$row_scores['test2'].'-'.$row_scores['test3'].'-'.$row_scores['micro_exam'].'-'.$row_scores['exam'].' Total:'.$subject_total."<br/>";
//     $subject_total_overall += $subject_total;
//   }
//   //echo $subject_total_overall;
//   //mysqli_query($link, "TRUNCATE TABLE cummulative_assessements2");
//   $check_db = mysqli_query($link, "SELECT * FROM cummulative_assessements2 WHERE student_id='$student_id' AND aagc_id='$aagc_id' AND session_id='$s' AND term_id='$t' ");
//   if (mysqli_num_rows($check_db)==0) {

//   $query_insert = mysqli_query($link, "INSERT INTO cummulative_assessements2(score,student_id,aagc_id,session_id,term_id) VALUES ('$subject_total_overall','$student_id','$aagc_id','$s','$t')");
//   }
// $i++;

// }
// $query_get_scores = mysqli_query($link, "SELECT * FROM cummulative_assessements2 where session_id=1 AND term_id=1 AND aagc_id=7 ORDER by score DESC ");
// while ($row_get_scores=mysqli_fetch_array($query_get_scores)) {
//  // echo $row_get_scores['student_id'].'-'.$row_get_scores['score']."<br/>";
// }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Result Standing | CSMT Schools</title>
  <link href='http://fonts.googleapis.com/css?family=Michroma' rel='stylesheet' type='text/css'>
  <link href="<?php echo e(asset('bower_components/bootstrap/bootstrap.css')); ?>" rel='stylesheet' type='text/css'>
  <style type="text/css">
    html, body {
      margin: 0;
      padding: 0;
    }
    .page {
      width: 800px;
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
      font-size: 30px;
      font-family: "Times New Roman", Times, serif;
      text-transform: uppercase;
      font-weight: bold;
      color: blue;
    }
    .main-top h2 {
      margin-bottom: 0;
      margin-left: 25px;
      font-size:23px;
      font-family: 'Sakkal Majalla', bold;
      letter-spacing: 0.5px;
      color: blue;
      font-weight: bold;
      line-height: 10px;
    }
    .main-top p {
      font-family: 'Sakkal Majalla', bold;
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
      font-size: 16px;
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
  font-size: 17px;
  text-align: center;
  line-height: 5px;
}
.bold-font {
  font-weight: bold;
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
  padding: 4px;
}
    
  </style>
    <style type="text/css" media="print">
    @page  
    {
        size: auto;   /* auto is the initial value */
        margin: 1mm;  /* this affects the margin in the printer settings */
        margin-top: 20px;
        margin-bottom: 10px;
        margin-right: 15px;
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
.bold-font {
  font-weight: bold;
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
      line-height: 0.5px;
      letter-spacing: 0.001px;
      border: 1px solid black;
      padding: 1px;
    }
    
    .blue-st {
      color: blue !important;
    } 
    .blue-com {
      font-family: "Comic Sans MS", sans-serif;
      font-size: 1px;
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
  font-size: 17px;
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
  padding: 4px;
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
      <img src="<?php echo e(asset('storage/images/logo-lg.jpg')); ?>" width="300px">
        <h1>CSMT Staff Secondary School</h1>
        
        <p>Along Watchman Street, P.M.B. 147, Abakaliki, Ebonyi State, Nigeria<br>
        <strong>Email:</strong> csmtschools@gmail.com  <strong>Tel:</strong> 08032124870, 07060725882</p>
        <h2 style="margin-top:12px;margin-left:55px;">RESULT STANDING</h2>
      </div>
    </div>
<div class="panel"> 
  <div class="example-box-wrapper">
      <table class="table table-bordered table-condensed" style="margin-top:-10px;">
        <tbody>
            <tr>
              <td><strong>Term:&nbsp;</strong><strong class="blue-st"><?php echo e(App\Term::find($term_id)->name); ?></strong></td>
              <td><strong>Class:&nbsp;</strong><strong class="blue-st">
                      <?php echo App\Aagc::name($aagc_id); ?> <?php echo e(App\Student::categoryName($category_id)); ?></strong></td>
              <td><strong>Session:&nbsp;</strong><strong class="blue-st"><?php echo e(App\Session::find($session_id)->name); ?></strong></td>
            </tr>
        </tbody>
      </table>

          <div class="content-i">
            <div class="content-box">
                <div class="element-wrapper">
                    <div class="element-box">


                     
                     <?php if( Addon::isEmpty($students)): ?>

                     <div class="table-responsive">
                      
                        <table class='table table-bordered' border='1'>
                            <thead>
                                <tr>
                                    <th width="1px">S/N</th>
                                    <th width="10%">Students' ID</th>
                                    <th width="37%" class="text-left">Name</th>
                                    <th width="1%">Pos</th>
                                    <th width="1%">Total</th>
                                    <th width="1%">Avg</th>
                                    <th>Remark</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php

                                  $previousScore=0;
                                  $position = 0;
                               ?>
                              <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php 
                                  $subject_count = count (App\Assessment::subject_count($aagc_id,$session_id,$term_id,$student->id));
                                      
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
                                <tr>
                                  <td><?php echo e($x+1); ?></td>
                                  <td><?php echo e($student->admission_no); ?></td>
                                  <td class="text-left"><?php echo e($student->surname.' '.$student->othernames); ?></td>
                                  <td><?php echo Addon::position($position); ?></td>

                                  <?php $total=0 ?>

                                  <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                      <?php
                                        $score =  App\Assessment::cumCatstupidLoading($subject->id,$student->id,$aagc_id,$session_id,$term_id,$cummulative);

                                        $total+=$score;
                                      ?>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                  <td><?php echo e($total); ?></td>
                                  <td><?php echo e(round($total/$subject_count)); ?></td>
                                  <td></td>
                                </tr>

                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                            </tbody>
                              

                        </table>

                      </div>

                      <?php else: ?> 
                        <h3 class="text-center">No assessment found!</h3>
                      <?php endif; ?>
                    
                    </div>
                </div>
              

              
            </div>
          </div>
<?php

    $group_class_id = App\Aagc::find($aagc_id)->group_class->id;

?>


<?php $__env->startSection('script'); ?>
  

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
        sessionOptions('<?php echo e($session_id); ?>');
        termOptions('<?php echo e($term_id); ?>');
        classOptions('<?php echo e($group_class_id); ?>');
        fullArmOptions('<?php echo e($group_class_id); ?>','<?php echo e($aagc_id); ?>');


        $(".classOptions").change(function(){
          var group_class_id = $(this).val();
          fullArmOptions(group_class_id);
        });
  

        $("#moreOption").modal('show');
      });

    });
  </script>
<?php $__env->stopSection(); ?>




