@extends('layouts.master')

@section('content')

<h1>Select a hospital</h1>

{!! Form::open(['route'=>['hospitalInformation.store']]) !!}

@include('hospitalInformation.partials.hospital', $params)

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