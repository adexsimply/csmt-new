<div class="col-xs-12">
	@if($roles)
		<form onsubmit="oisForm(event)" method="POST" action="{{route('users.store')}}">
			
			<div class="formAlert"></div>
			{{@csrf_field()}}

			<div class="form-group @if ($errors->has('name')) has-error @endif">
				<label class="sr-only">Name</label>
				<input type="text" name="name" required placeholder="Enter full name" class="form-control" />
				@if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
			</div>

			<div class="form-group @if ($errors->has('email')) has-error @endif">
				<label class="sr-only">Email</label>
				<input type="email" required name="email" placeholder="Enter email address" class="form-control" />
				@if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
			</div>

			<div class="form-group  @if ($errors->has('password')) has-error @endif">
				<label class="sr-only">Password</label>
				<input type="password" required name="password" placeholder="Enter password" class="form-control" />
				@if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
			</div>


			<div class="form-group">
				<label class="sr-only">Confirm password</label>
				<input type="password" required name="password_confirmation" placeholder="Confirm password" class="form-control" />
			</div>

			<div class="form-group">
				<label>Assign roles</label> <br>
				@foreach($roles as $role)
					<div class="checkbox-inline">
					    <label><input name="roles[]" type="checkbox" value="{{$role->id}}"> {{ucwords($role->name)}}</label>
					</div>
				@endforeach
				
				@if ($errors->has('roles'))
                    <span class="help-block">
                        <strong>{{ $errors->first('roles') }}</strong>
                    </span>
                @endif
			</div>

			<button class="btn btn-success" type="submit">Submit</button>
		</form>
	@else
		{!! Addon::alertDanger('No role found') !!}
		<div class="text-center">
			<a onclick="oisNew(event)" href="{{route('roles.create')}}"><i class="fa fa-plus-circle"></i> Create roles </a>
		</div>
		
	@endif
</div>