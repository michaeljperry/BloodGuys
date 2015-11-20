@extends('layouts.master')

@section('content')

<h1>Enter Staff Information: Invoice Id {{ $invoice_id }}</h1>

{!! Form::open(['route'=>['staffInformation.store']]) !!}

@include('staffInformation.partials.staff')

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