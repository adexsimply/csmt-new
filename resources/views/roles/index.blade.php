@extends('layouts.app')
@section('title','Role')
@section('content')
	<div class="container">
	    <div class="row">
	        <div class="col-md-10 center-block">
	            <div class="panel panel-success card">
	                <div class="panel-heading card-header"><strong>User roles</strong>
	                    <a href="{{route('roles.create')}}" onclick="oisNew(event)" data-title="Create new role" class="btn btn-success btn-xs pull-right"><i class="fa fa-plus-circle"></i> Add new</a>
	                </div>

	                <div class="panel-body card-body">
	                @if($roles)
	                <div class="table-responsive">
	                     <table class="table table-striped table-bordered table-hover">
	                       <thead>
	                       		<tr>
		                           <th>SN</th>
		                           <th>Role</th>
		                           <th>Permission</th>
		                           <th>Actions</th>
	                       		</tr>
	                   		</thead>    
	                       <tbody>
	                           @foreach($roles as $x => $role)
	                            <tr id="role{{$role->id}}">
	                                <td class="text-center">{{$x+1}}</td>
	                                <td>{{ucwords($role->name)}}</td>
	                                <td>
	                                	@foreach($role->permissions as $permission)
	                                		<span class="badge">{{ucwords($permission->name)}}</span>
	                                	@endforeach
	                                </td>
	                    			<td>
	                                    <a href="{{route('roles.edit',$role->id)}}" data-id="{{$role->id}}" onclick="oisEdit(event)" data-title="Update role" class="btn btn-success btn-xs edit"><i class="fa fa-edit"></i> Edit</a>

	                                    <a href="{{route('roles.destroy',$role->id)}}" data-method="delete" onclick="oisDelete(event)" data-hide="#role{{$role->id}}" class="btn btn-danger btn-xs delete"><i class="fa fa-times-circle"></i> Delete</a>
	                                </td>
	                            </tr>
	                           @endforeach
	                       </tbody>                   
	                   </table>

	                </div>
	                  
	                @else
	                    <div class="text-center">
	                        <h1>No role found </h1>
	                    </div>
	                    
	                @endif
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection