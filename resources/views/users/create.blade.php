@extends('layouts.app')
@section('title','Add new user')
@section('content')
	<div class="container">
	    <div class="row">
	        <div class="col-md-8 center-block">
	            <div class="panel panel-success card">
	                <div class="panel-heading card-header">
	                	<strong>Add new user</strong>

	                	<a href="{{route('users.index')}}" class="btn btn-success btn-xs pull-right"><i class="fa fa-eye"></i> Users</a>
	                </div>

	                <div class="panel-body card-body">
	                	@include('users.ajax.create')
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection