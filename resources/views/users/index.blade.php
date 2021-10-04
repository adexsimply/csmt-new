@extends('layouts.app')
@section('title','Users')
@section('content')
	<div class="container">
	    <div class="row">
	        <div class="col-md-11 center-block">
	            <div class="panel panel-success card">
	                <div class="panel-heading card-header"><strong>User manager</strong>
	                    <a href="{{route('users.create')}}" onclick="oisNew(event)" data-title="Add new user" class="btn btn-success btn-xs pull-right"><i class="fa fa-plus-circle"></i> Add new</a>
	                </div>

	                <div class="panel-body card-body">
	                @if($users)
	                <div class="table-responsive">
	                     <table class="table table-striped table-bordered table-hover">
	                       <thead>
	                       		<tr>
		                           <th>SN</th>
		                           <th>Name</th>
		                           <th>Email</th>
		                           <th>Roles</th>
		                           <th>Actions</th>
	                       		</tr>
	                   		</thead>    
	                       <tbody>
	                           @foreach($users as $x => $user)
	                            <tr id="user{{$user->id}}">
	                                <td>{{$x+1}}</td>
	                                <td>{{$user->name}}</td>
	                                <td>{{$user->email}}</td>
	                                <td>
	                                	@foreach($user->roles as $role)
	                                		<span class="badge">{{ucwords($role->name)}}</span>
	                                	@endforeach
	                                </td>
	                    			<td>
	                                    
	                                    <a href="{{route('users.edit',$user->id)}}" onclick="oisEdit(event)" data-id="{{$user->id}}" data-title="Edit {{$user->name}}" class="btn btn-success btn-xs edit"><i class="fa fa-edit"></i> Edit</a>
	                                   

	                                    <a href="{{route('users.destroy',$user->id)}}" data-method="delete" data-hide="#user{{$user->id}}" onclick="oisDelete(event)" class="btn btn-danger btn-xs delete"><i class="fa fa-times-circle"></i> Delete</a>
	                                    
	                             
	                                </td>
	                            </tr>
	                           @endforeach
	                       </tbody>                   
	                   </table>

	                </div>
	                  
	                @else
	                    <div class="text-center">
	                        <h1>No user found </h1>
	                    </div>
	                    
	                @endif
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection