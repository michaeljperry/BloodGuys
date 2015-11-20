@extends('layouts.master')

@section('content')

<h1>Edit Invoice - Staff Information</h1>

{!! Form::model($staffInformation, ['method'=>'PATCH', 'route'=>['staffInformation.update', $staffInformation]]) !!}

	@include('staffInformation.partials.staff')
	
<div class='form-group'>	
	{!! Form::submit('Update Staff Information', ['class'=>'form-control btn btn-primary']) !!}
</div>

{!! Form::close() !!}

@stop