<div class="col-xs-12">
	@if($permissions)
		<form onsubmit="oisForm(event)" method="POST" action="{{route('roles.store')}}">
			
			<div class="formAlert"></div>
			{{@csrf_field()}}
			<div class="form-group">
				<label class="sr-only">Role name</label>
				<input type="text" name="name" required="" placeholder="Enter role name" class="form-control" />
				@if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
			</div>

			<div class="form-group">
				<label>Grant permissions to:</label> <br>
				@foreach($permissions as $permission)
					<div class="checkbox-inline">
					    <label><input name="permissions[]" type="checkbox" value="{{$permission->id}}"> {{ucwords($permission->name)}}</label>
					</div>
				@endforeach
				
				@if ($errors->has('permissions'))
                    <span class="help-block">
                        <strong>{{ $errors->first('permissions') }}</strong>
                    </span>
                @endif
			</div>

			<button class="btn btn-success" type="submit">Submit</button>
		</form>
	@else
		{!! Addon::alertDanger('No permission found') !!}
		<div class="text-center">
			<a onclick="oisNew(event)" href="{{route('permissions.create')}}"><i class="fa fa-plus-circle"></i> Create permissions </a>
		</div>
		
	@endif
</div>