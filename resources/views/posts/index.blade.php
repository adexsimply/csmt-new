@extends('layouts.app')
@section('title','Posts')
@section('content')
	<div class="container">
	    <div class="row">
	        <div class="col-md-11 center-block">
	            <div class="panel panel-success card">
	                <div class="panel-heading card-header"><strong>Post manager</strong>
	                    <a href="{{route('posts.create')}}" onclick="oisNew(event)" class="btn btn-success btn-xs pull-right"><i class="fa fa-plus-circle"></i> Add new</a>
	                </div>

	                <div class="panel-body card-body">
	                @if($posts)
	                <div class="table-responsive">
	                     <table class="table table-striped table-bordered table-hover">
	                       <thead>
	                       		<tr>
		                           <th>SN</th>
		                           <th>Title</th>
		                           <th>Body</th>
		                           <th>Actions</th>
	                       		</tr>
	                   		</thead>    
	                       <tbody>
	                           @foreach($posts as $x => $post)
	                            <tr id="{{$post->id}}">
	                                <td>{{$x+1}}</td>
	                                <td>{{$post->title}}</td>
	                                <td>{{$post->body}}</td>
	                    			<td>
	                                    @can('edit post')
	                                    <a href="#" data-id="{{$post->id}}" url="{{url('#')}}" class="btn btn-success btn-xs edit"><i class="fa fa-edit"></i> Edit</a>
	                                    @endcan

	                                    @can('delete post')
	                                    <a href="{{url('#')}}" data-id="{{$post->id}}"  class="btn btn-danger btn-xs delete"><i class="fa fa-times-circle"></i> Delete</a>
	                                    @endcan
	                             
	                                </td>
	                            </tr>
	                           @endforeach
	                       </tbody>                   
	                   </table>

	                </div>
	                  
	                @else
	                    <div class="text-center">
	                        <h1>No post found </h1>
	                    </div>
	                    
	                @endif
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection