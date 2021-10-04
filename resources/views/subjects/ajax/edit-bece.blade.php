
<div class="element-box">
	<form onsubmit="oisForm(event)" method="post" action="{{url('bece/update')}}">
		{{csrf_field()}}
		<div class="formAlert"></div>

		<input type="hidden" name="student_id" value="{{$student->id}}">
		<input type="hidden" name="session_id" value="{{$session_id}}">

		<div class="form-group">
			<label>Examination no:</label>
			<input type="text" required="" value="{{$examination_no}}" name="examination_no" placeholder="Enter examination no:" class="form-control" />
		</div>


		@foreach($subjects as $subject)
			<input type="hidden" name="subject_id[]" value="{{$subject->id}}">

			<div class="form-group">

				<label>{{$subject->name}}</label>

				 <?php
                        $score = App\Bece::score($student->id, $subject->id);
                        if($score)
                            $score = $score->score;
                        else
                            $score = 0;
                 ?>

				<input type="text" required="" class="form-control" name="score[]" value="{{$score}}" placeholder="Enter {{$subject->name}} score" />

			</div>
		@endforeach

		<div class="form-group">
			<label>Remark</label>
			<textarea name="remark" required="" placeholder="Enter remark" class="form-control">{{$remark}}</textarea>
		</div>

		<button class="btn btn-primary">Submit</button>
	</form>
</div>
<script type="text/javascript">
	formProcessor();
</script>