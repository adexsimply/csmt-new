<div class="element-box">
						
	<form action="{{url('assessments/update')}}" onsubmit="oisForm(event)" method="post" class="f-16">

		{{@csrf_field()}}

		<div class="formAlert"></div>

		<input type="hidden" name="id" value="{{$assessment->id}}">
		

		<div class="form-group">
			<label>First test score</label>
			<input type="number" min="-1" max="100" class="form-control" value="{{$assessment->test1}}" name="test1" />
		</div>
			

		<div class="form-group">
			<label>Second test score</label>
			<input type="number" min="-1" max="100" class="form-control" value="{{$assessment->test2}}" name="test2" />
		</div>
			

		<div class="form-group">
			<label>Third test score</label>
			<input type="number" min="-1" max="100" class="form-control" value="{{$assessment->test3}}" name="test3" />
		</div>
			
			

		<div class="form-group">
			<label>Micro score</label>
			<input type="number" min="-1" max="100" class="form-control" value="{{$assessment->micro_exam}}" name="micro_exam" />
		</div>


		<div class="form-group">
			<label>Practical score</label>
			<input type="number" min="-1" max="100" class="form-control" value="{{$assessment->practical}}" name="practical" />
		</div>
			

		<div class="form-group">
			<label>Examination score</label>
			<input type="number" min="-1" max="100" class="form-control" value="{{$assessment->exam}}" name="exam" />
		</div>
			

		<div class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary btn-md">Save changes</button>
			</div>
		</div>


	</form>
					  

</div>
