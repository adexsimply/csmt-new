@extends('layouts.app')
@section('title','Update system permission')
@section('content')
	<div class="container">
	    <div class="row">
	        <div class="col-md-8 center-block">
	            <div class="panel panel-success card bg-success">
	                <div class="panel-heading card-header">
	                	<strong>Update system permission</strong>

	                	<a href="{{route('permissions.index')}}" class="btn btn-success btn-xs pull-right"><i class="fa fa-eye"></i> System permissions</a>
	                </div>

	                <div class="panel-body card-body">
	                	@include('permissions.ajax.edit')
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection