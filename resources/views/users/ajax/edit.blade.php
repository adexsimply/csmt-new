<div class="col-xs-12">
	@if($roles)
		<form method="POST" onsubmit="oisForm(event)" action="{{route('users.update',$user->id)}}">
			
			<div class="formAlert"></div>
			{{@csrf_field()}}
			<input type="hidden" name="_method" value="PUT" />
			<input type="hidden" name="id" value="{{$user->id}}" />
			<div class="form-group @if ($errors->has('name')) has-error @endif">
				<label class="sr-only">Name</label>
				<input type="text" name="name" value="{{$user->name}}" required placeholder="Enter full name" class="form-control" />
				@if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
			</div>

			<div class="form-group @if ($errors->has('email')) has-error @endif">
				<label class="sr-only">Email</label>
				<input type="email" required value="{{$user->email}}" name="email" placeholder="Enter email address" class="form-control" />
				@if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
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