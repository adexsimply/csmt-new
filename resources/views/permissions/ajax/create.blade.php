<div class="col-xs-12">
	
		<form onsubmit="oisForm(event)" method="POST" action="{{route('permissions.store')}}">
			{{csrf_field()}}
			<div class="formAlert"></div>


			<div class="form-group @if ($errors->has('name')) has-error @endif">
				<label>Name</label>
				<input type="text" name="name" required="" placeholder="Enter permission name" class="form-control" />
				@if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
			</div>

			@if($roles)
				<div class="form-group">
					@foreach($roles as $role)
						<div class="checkbox">
						    <label><input name="roles[]" type="checkbox" value="{{$role->id}}"> {{$role->name}}</label>
						</div>
					@endforeach

					@if ($errors->has('roles'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('roles') }}</strong>
	                    </span>
                	@endif
				</div>
			@endif

			<button class="btn btn-success" type="submit">Submit</button>
		</form>
	
</div>