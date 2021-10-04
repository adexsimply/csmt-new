<div class="col-xs-12">
	
		<form onsubmit="oisForm(event)" method="POST" action="{{route('permissions.update',$permission->id)}}">
			{{csrf_field()}}
			{{method_field('PUT')}}
			<!-- <input type="hidden" name="_method" value="PUT" /> -->
			<div class="formAlert"></div>


			<div class="form-group @if ($errors->has('name')) has-error @endif">
				<label>Name</label>
				<input type="text" required="" value="{{$permission->name}}" name="name" placeholder="Enter permission name" class="form-control" />
				@if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
			</div>

			<button class="btn btn-success" type="submit">Submit</button>
		</form>
	
</div>