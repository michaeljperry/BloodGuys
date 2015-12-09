@extends('layouts.master')

@section('content')

<div class="panel panel-primary">
	<div class="panel-heading panel-title">Edit User: {{$user->name}}</div>
		<div class="panel-body">
			{!! Form::model($user, ['method'=>'PATCH', 'route'=>['users.update', $user], 'class'=>'form-horizontal']) !!}

				@include('users.partials.form', array('submitButtonText'=>'Update User', 'enterPassword'=>false))
	
			{!! Form::close() !!}
		</div>
	</div>
</div>

@stop