@extends('layouts.master')

@section('content')

<div align = "center">
	<h1>Charge Sheet</h1>
</div>

{!! Form::open(['route'=>['transfusionServices.store']]) !!}

	@include('transfusionServices.partials.form')
	
	<div class='form-group'>	
		{!! Form::submit('Next', ['class'=>'form-control btn btn-primary']) !!}
	</div>
	
{!! Form::close() !!}

@stop