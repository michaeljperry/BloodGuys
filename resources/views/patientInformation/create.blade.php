@extends('layouts.master')

@section('content')

<h1>Enter Patient Information</h1>

{!! Form::open(['route'=>['patientInformation.store']]) !!}

@include('patientInformation.partials.patient')

<div class='form-group'>	
	{!! Form::submit('Next', ['class'=>'form-control btn btn-primary']) !!}
</div>
	
{!! Form::close() !!}

<!--<a href="{{ URL::previous() }}" class="btn btn-primary" id = "previous">Prev</a >-->

@stop

@section('footer')

<script>
	
	/*$('#surgeon_list').select2(
		{placeholder: "Select a surgeon"}
	);	
	
	$('#anesthesiologist_list').select2(
		{placeholder: "Select a surgeon"}
	);	
		
	$('#autotransfusionist_list').select2(
		{placeholder: "Select a surgeon"}
	);	
	
	$('#autotransfusionist2_list').select2(
		{placeholder: "Select a surgeon"}
	);*/	
	
</script>
	

@stop