@extends('layouts.app')
@section('title','permission')
@section('content')
	<div class="container">
	    <div class="row">
	        <div class="col-md-8 center-block">
	            <div class="panel panel-success card">
	                <div class="panel-heading card-header"><strong>System permissions</strong>
	                    <a href="{{route('permissions.create')}}" onclick="oisNew(event)" class="btn btn-success btn-xs pull-right"><i class="fa fa-plus-circle"></i> Add new</a>
	                </div>

	                <div class="panel-body card-body">
	                @if($permissions)
	                <div class="table-responsive">
	                     <table class="table table-striped table-bordered table-hover">
	                       <thead>
	                       		<tr>
		                           <th>SN</th>
		                           <th>permission</th>
		                           <th>Actions</th>
	                       		</tr>
	                   		</thead>    
	                       <tbody>
	                           @foreach($permissions as $x => $permission)
	                            <tr id="permission{{$permission->id}}">
	                                <td>{{$x+1}}</td>
	                                <td>{{ucwords($permission->name)}}</td>
	                    			<td>
	                                    
	                                    <a href="{{route('permissions.edit',$permission->id)}}" data-id="{{$permission->id}}" onclick="oisEdit(event)" data-title="Edit permissions" class="btn btn-success btn-xs edit"><i class="fa fa-edit"></i> Edit</a>

	                                    <a href="{{route('permissions.destroy',$permission->id)}}" data-id="{{$permission->id}}" data-method="delete" onclick="oisDelete(event)" data-hide="#permission{{$permission->id}}" class="btn btn-danger btn-xs delete"><i class="fa fa-times-circle"></i> Delete</a>
	                             
	                                </td>
	                            </tr>
	                           @endforeach
	                       </tbody>                   
	                   </table>

	                </div>
	                  
	                @else
	                    <div class="text-center">
	                        <h1>No permission found </h1>
	                    </div>
	                    
	                @endif
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection