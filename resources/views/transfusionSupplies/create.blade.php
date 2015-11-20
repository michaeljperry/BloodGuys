@extends('layouts.master')

@section('content')

<div align = "center">
	<h1>Charge Sheet</h1>
</div>

{!! Form::open(array('route'=>'transfusionSupplies.store', 'files'=>true) !!}

	@include('transfusionSupplies.partials.form')
	
	<div class='form-group'>	
		{!! Form::submit('Finish', ['class'=>'form-control btn btn-primary']) !!}
	</div>
	
{!! Form::close() !!}

@stop