@extends('layouts.app')
@section('title',$user->name)
@section('content')
	<div class="container">
	    <div class="row">
	        <div class="col-md-8 center-block">
	            <div class="panel panel-success card">
	                <div class="panel-heading card-header">
	                	<strong>Update account</strong>

	                	<a href="{{route('users.index')}}" class="btn btn-success btn-xs pull-right"><i class="fa fa-eye"></i> Users</a>
	                </div>

	                <div class="panel-body card-body">
	                	@include('users.ajax.edit')
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection