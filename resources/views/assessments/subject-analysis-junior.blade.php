<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>SUBJECT ANALYSIS| CSMT Schools</title>
	<link href='http://fonts.googleapis.com/css?family=Michroma' rel='stylesheet' type='text/css'>
        <link href="{{ asset('bower_components/bootstrap/bootstrap.css') }}" rel="stylesheet" >
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
  padding: 2px;
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
				<h2 style="margin-top:12px;margin-left:55px;">SUBJECT ANALYSIS</h2>
			</div>
		</div>
		<div class="main">
			<table class="table table-bordered table-condensed" style="margin-top:-10px;">
				<tbody>
			  		<tr>
			  			<td><strong>Term:&nbsp;</strong><strong class="blue-st">{{App\Term::find($term_id)->name}}</strong></td>
			  			<td><strong>Class:&nbsp;</strong><strong class="blue-st">{!! App\Aagc::name($aagc_id) !!} {{App\Student::categoryName($category_id)}}</strong></td>
			  			<td><strong>Session:&nbsp;</strong><strong class="blue-st">{{App\Session::find($session_id)->name}}</strong></td>
			  		</tr>
				</tbody>
			</table>

			<div class="panel panel-info" style="margin-top:-18px;line-height:1;">
				<div class="panel-heading" style="background-color:#6A0691;"><h4 style="margin:0;"> {{$subject->name}}</h4></div>

				<table class="table table-bordered table-condensed table-responsive" style="margin-bottom:1%;margin-top:1%;">
				<thead>
				<tr><th colspan="3">Total No of Students: {{App\Assessment::classCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)}}</th></tr>
			        </thead>
				</table>
				<table class="table table-bordered table-condensed table-responsive" style="width:49%;float:left;">
				<thead>
				<tr><th colspan="3">Score Analysis</th></tr>
			          <tr>
			            <th class="blue-st">Range</th>
			            <th class="blue-st">No.&nbsp;of&nbsp;Students</th>
			            <th style=" text-align:center" class="blue-st">%</th>
			          </tr>
			        </thead>
					<tbody>
				     <tr><td>90 and Above</td><td>{{App\Assessment::ninetyCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)}}</td><td>{{round((App\Assessment::ninetyCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)*100)/App\Assessment::classCount($aagc_id,$session_id,$category_id,$term_id,$subject_id),2)}}%</td></tr>
				     <tr><td>80-89</td><td>{{App\Assessment::eightyCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)}}</td><td>{{round((App\Assessment::eightyCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)*100)/App\Assessment::classCount($aagc_id,$session_id,$category_id,$term_id,$subject_id),2)}}%</td></tr>
				     <tr><td>70-79</td><td>{{App\Assessment::seventyCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)}}</td><td>{{round((App\Assessment::seventyCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)*100)/App\Assessment::classCount($aagc_id,$session_id,$category_id,$term_id,$subject_id),2)}}%</td></tr>
				     <tr><td>60-69</td><td>{{App\Assessment::sixtyCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)}}</td><td>{{round((App\Assessment::sixtyCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)*100)/App\Assessment::classCount($aagc_id,$session_id,$category_id,$term_id,$subject_id),2)}}%</td></tr>
				     <tr><td>50-59</td><td>{{App\Assessment::fiftyCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)}}</td><td>{{round((App\Assessment::fiftyCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)*100)/App\Assessment::classCount($aagc_id,$session_id,$category_id,$term_id,$subject_id),2)}}%</td></tr>
				     <tr><td>40-49</td><td>{{App\Assessment::fortyCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)}}</td><td>{{round((App\Assessment::fortyCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)*100)/App\Assessment::classCount($aagc_id,$session_id,$category_id,$term_id,$subject_id),2)}}%</td></tr>
				     <tr><td>30-39</td><td>{{App\Assessment::thirtyCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)}}</td><td>{{round((App\Assessment::thirtyCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)*100)/App\Assessment::classCount($aagc_id,$session_id,$category_id,$term_id,$subject_id),2)}}%</td></tr>
				     <tr><td>20-29</td><td>{{App\Assessment::twentyCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)}}</td><td>{{round((App\Assessment::twentyCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)*100)/App\Assessment::classCount($aagc_id,$session_id,$category_id,$term_id,$subject_id),2)}}%</td></tr>
				     <tr><td>10-19</td><td>{{App\Assessment::tenCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)}}</td><td>{{round((App\Assessment::tenCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)*100)/App\Assessment::classCount($aagc_id,$session_id,$category_id,$term_id,$subject_id),2)}}%</td></tr>
				     <tr><td>Below 10</td><td>{{App\Assessment::unitCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)}}</td><td>{{round((App\Assessment::unitCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)*100)/App\Assessment::classCount($aagc_id,$session_id,$category_id,$term_id,$subject_id),2)}}%</td></tr>
				    </tbody>
				</table>
				<table class="table table-bordered table-condensed table-responsive" style="width:49%;float:right;">
				<thead>
				<tr><th colspan="3">Grade Analysis</th></tr>
			          <tr>
			            <th style=" text-align:center" class="blue-st">Grade</th>
			            <th style=" text-align:center" class="blue-st">No.&nbsp;of&nbsp;Students</th>
			          </tr>
			        </thead>
					<tbody>
				     <tr><td>EXCELLENT</td><td>{{App\Assessment::ninetyCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)+App\Assessment::eightyCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)+App\Assessment::seventyCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)}}</td></tr>
				     <tr><td>VERY GOOD</td><td>{{App\Assessment::sixtyCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)}}</td></tr>
				     <tr><td>GOOD</td><td>{{App\Assessment::fiftyCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)}}</td></tr>
				     <tr><td>FAIRLY GOOD</td><td>{{App\Assessment::fgoodCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)}}</td></tr>
				     <tr><td>FAIR</td><td>{{App\Assessment::fairCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)}}</td></tr>
				     <tr><td>POOR</td><td>{{App\Assessment::vpoorCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)}}</td></tr>
					</tbody>
				</table>
				<table class="table table-bordered table-condensed table-responsive" style="width:49%;float:right; margin-top:2%;">
				<thead>
				<tr><th colspan="3">Percentage</th></tr>
			          <tr>
			            <th class="blue-st">FAIL</th>
			            <th class="blue-st">PASS</th>
			          </tr>
			        </thead>
					<tbody>
				     <tr><td>{{round((App\Assessment::failedCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)*100)/App\Assessment::classCount($aagc_id,$session_id,$category_id,$term_id,$subject_id),2)}}%</td><td>{{round((App\Assessment::passedCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)*100)/App\Assessment::classCount($aagc_id,$session_id,$category_id,$term_id,$subject_id),2)}}%</td></tr>
					</tbody>
				</table>
				<table class="table table-bordered table-condensed table-responsive" style="width:49%;float:right; margin-top:2%;">
				<thead>
			          <tr>
			            <th class="blue-st">Class Average</th>
			            <th>{{round(App\Assessment::classTotalScores($aagc_id,$session_id,$category_id,$term_id,$subject_id)->score/App\Assessment::classCount($aagc_id,$session_id,$category_id,$term_id,$subject_id),2)}}</th>
			          </tr>
			        </thead>
					<!-- <tbody>
				     <tr><td>{{round((App\Assessment::failedCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)*100)/App\Assessment::classCount($aagc_id,$session_id,$category_id,$term_id,$subject_id),2)}}%</td><td>{{round((App\Assessment::passedCount($aagc_id,$session_id,$category_id,$term_id,$subject_id)*100)/App\Assessment::classCount($aagc_id,$session_id,$category_id,$term_id,$subject_id),2)}}%</td></tr>
					</tbody> -->
				</table>
			</div>
		</div>
	</div>
  
</body>
</html>