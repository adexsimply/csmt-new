<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>BECE</title>
	<link href='http://fonts.googleapis.com/css?family=Michroma' rel='stylesheet' type='text/css'>
	<link href="{{asset('css/statement.css')}}" rel='stylesheet' type='text/css'>

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
			color: green;
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
		.sor {
			border:2px solid blue;
			color:blue !important; 
			font-size:30px; 
			font-weight:bold; 
			width:350px;
			margin-left:230px;
			font-family:'Tempus Sans ITC' !important;
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
	<div class="page" style="padding:35px;">
		<div class="main-top">
			<div>
			<img src="{{ asset('storage/images/logo.png') }}" width="300px">
				<h1>CSMT Staff Secondary School</h1>
				
				<p>Along Watchman Street, P.M.B. 147, Abakaliki, Ebonyi State, Nigeria<br>
				<strong>Email:</strong> csmtschools@gmail.com  <strong>Tel:</strong> 08032124870, 07060725882</p>
				<h2 style="margin-top:12px;margin-left:55px;">BASIC EDUCATION CERTIFICATE EXAMINATION</h2>
				<div class="sor" style="border:2px solid blue;color:blue; font-size:30px; font-weight:bold; width:350px;margin-left:230px;margin-top:5px;font-family:Tempus Sans ITC">STATEMENT OF RESULT</div>
			</div>
		</div>
		<div class="main">
			<table class="table table-bordered table-condensed" style="margin-top:px;padding:5px;">
				<tbody>
					<tr>


						<td class="input" style="padding:3px;">
							<strong>Examination&nbsp;No:</strong>&nbsp;<strong class="blue-st">{{$student->neco_details->examination_no}}</strong>
						</td>



						<td class="input" style="padding:3px;"><strong>Year of Exam:</strong>&nbsp;<strong class="blue-st">{{$session}}</strong></td>
			  		</tr>
				</tbody>
			</table>

			<table class="table table-bordered table-condensed" style="margin-top:-18px;">
				<tbody>
			  		<tr>
			  			<td>
			  				<strong>Name of Candidate:&nbsp;</strong><strong class="blue-st">
			  					{{$student->surname.' '.$student->othernames}}
			  				</strong>
			  			</td>


			  			<td>
			  				<strong>Sex:&nbsp;</strong><strong class="blue-st">
			  				{{$student->gender}}</strong>
			  			</td>


			  		</tr>
				</tbody>
			</table>
			<div class="panel panel-info" style="margin-top:-18px;line-height:1;">

				<table class="table table-bordered table-striped table-condensed" style="line-height:1px;border: 1px solid black;" width="100%">
			        <thead>
			          <tr style="border-bottom:2px solid black;">
			            <th class="blue-st">S/N</th>
			            <th class="blue-st">Subject</th>
			            <th style="padding-left:2%;"  class="blue-st">Grade</th>
			            <th style="padding-left:2%;" class="blue-st">Remarks</th>
			          </tr>
			        </thead>
			        <tbody class="input">
			        	<?php $credits = 0; $passes=0; $x=1; ?>
			         	@foreach($subjects as $subject)
			         		<?php $score = App\Neco::score($student->id,$subject->id)->score; ?>
			         		<tr>
					            <th style="">{{$x}}</th>
					            <td class="blue-subj">{{$subject->name}}</td>
					            <td class="blue-subj" style="padding-left:3%;" >{{App\Neco::grade($score)}}</strong></td>
					            <td>{{App\Neco::remark($score)}}</td>
					          </tr>
					        <tr>

					        <?php
					        	$x++;
					        	if($score >= 50)
					        		$credits++;
					        	else if($score >=40)
					        		$passes++;

					         ?>
			         	@endforeach			            
			        </tbody>
			      </table>
			<table class="table table-bordered table-condensed" style="margin-top:5px;padding:5px;">
				<tbody>
					<tr>
						<td class="input" style="padding:3px;"><strong>No of Subjects:</strong>&nbsp;<strong class="blue-st">{{$x-1}}</strong></td>
						<td class="input" style="padding:3px;"><strong>Total Credits</strong>&nbsp;<strong class="blue-st">{{$credits}}</strong></td>
						<td class="input" style="padding:3px;"><strong>Total Passes</strong>&nbsp;<strong class="blue-st">{{$passes}}</strong></td>
			  		</tr>
				</tbody>
			</table>
			</div>
			<div class=""></div>
				<div class="panel-heading" style=""><h4 style="margin:0">*** I Certify that this is a true copy of the result of the above mentioned Examination Council. Any erasure renders it invalid</h4></div>
			<div class=""></div>
				
					<div style="width:66%;font-size:20px;float:left;margin-top:5px;">					
						<p>Remarks: <span class="blue-com">{{$student->neco_details->remark}}</span><br/>
						Name of Principal: <span class="blue-com">NWIGWE INNOCENT A.</span></p>
						
					</div>
				<div style="height:250px;">
					<div style="width:66%;font-size:20px;float:left;margin-top:5px;">				
						<p>THIS IS A PROVISIONAL STATEMENT OF<br/>
						RESULT FOR USE BY THE CANDIDATE<br/> 
						NAMED ABOVE AND DOES NOT<br/> 
						REPRESENT A CERTIFICATE<br/>
						</p>
						
					</div>
					<div style="width:32%;float:right;margin-top:5px;">
						<div style="margin-bottom:0;border:1px solid black;" class="well well-lg"></div>
						<p class="text-center large" style="font-size:18px; font-weight:bold;">Signature & Date</p>
					</div>
				</div>
		</div>

		</div>
	</div>
</body>
</html>