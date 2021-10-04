@extends('layouts.app')
@section('title','Create new role')
@section('content')
	<div class="container">
	    <div class="row">
	        <div class="col-md-8 center-block">
	            <div class="panel panel-success card">
	                <div class="panel-heading card-header">
	                	<strong>Create new role</strong>

	                	<a href="{{route('roles.index')}}" class="btn btn-success btn-xs pull-right"><i class="fa fa-eye"></i> Roles</a>
	                </div>

	                <div class="panel-body card-body">
	                	@include('roles.ajax.create')
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection