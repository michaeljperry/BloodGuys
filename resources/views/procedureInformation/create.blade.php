@extends('layouts.master')

@section('content')

<h1>Enter Procedure Information</h1>

{!! Form::open(['route'=>['procedureInformation.store']]) !!}

@include('procedureInformation.partials.procedure_information')

<div class='form-group'>	
	{!! Form::submit('Next', ['class'=>'form-control btn btn-primary']) !!}
</div>
	
{!! Form::close() !!}

<!--<a href="{{ URL::previous() }}" class="btn btn-primary" id = "previous">Prev</a >-->

@stop

@section('footer')

<script>
	
	function getTotalMinutes(t)
	{		
		var timeToConvert = t.split(':');
		
		var hours = timeToConvert[0] % 12;
		
		if(hours == 0)
		{
			hours = 12;
		}
		
		var totalMinutes = hours * 60 + parseInt(timeToConvert[1]);
		return totalMinutes;
	}
			
	function getTimeDuration(time1, time2)
	{
		var startTimeInMinutes = getTotalMinutes(time1);
		var endTimeInMinutes = getTotalMinutes(time2);
		
		var duration = endTimeInMinutes - startTimeInMinutes;
		return convertMinutesToHHMM(duration);
	}
	
	function convertMinutesToHHMM(totalMinutes)
	{
		var hours = Math.floor(totalMinutes / 60);
		var minutes = totalMinutes - hours * 60
		
		var hoursString = hours.toString();
		var minutesString = minutes.toString();
		
		if(hoursString.length < 2)
		{	
			hoursString = "0" + hoursString;
		}
		
		if(minutesString.length < 2)
		{
			minutesString = "0" + minutesString;
		}
		
		return hoursString + ":" + minutesString;
	}
	
	// When using the document ready event you can actually put the script in the header section since the code will not be ran until the page is fully loaded.
	$(document).ready(function()
	{					
		$("#operation_start_time").blur(function()
		{
			var start = $("#operation_start_time").val();
			var end = $("#operation_end_time").val();
			
			if(end == "")
			{
				end = "0:00";
			}
			
			$("#total_time").val(getTimeDuration(start, end));
		});
		
		$("#operation_end_time").blur(function()
		{
			var start = $("#operation_start_time").val();
			var end = $("#operation_end_time").val();
			
			if(end == "")
			{
				end = "0:00";
			}
			
			$("#total_time").val(getTimeDuration(start, end));
		});
	});	
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