@extends('layouts.master')

@section('content')

<div class="panel panel-primary">
	<div class="panel-heading panel-title">Create User</div>
		<div class="panel-body">
			{!! Form::open(['route'=>['users.store'], 'class'=>'form-horizontal']) !!}
				@include('users.partials.form', array('submitButtonText'=>'Create User', 'enterPassword'=>true))	
			{!! Form::close() !!}
		</div>
	</div>
</div>

@stop