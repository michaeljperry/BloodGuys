@extends('layouts.master')

@section('content')

<h1>Edit Invoice - {{$invoice_section->title}}</h1>

{!! Form::model($model, ['method'=>'PATCH', 'route'=>[$invoice_section->update_url, $model], 'id'=>'editForm']) !!}

	@include($invoice_section->form_path)
	
<div class='form-group'>	
		
	{!! Form::submit('Previous', ['class'=>'btn btn-primary btn-lg col-xs-3', 'name'=>'action', 'id'=>'Previous']) !!}
	{!! Form::submit($invoice_section->update_button_text, ['class'=>'btn btn-primary btn-lg col-xs-3 col-xs-offset-1', 'name'=>'action', 'id'=>'update']) !!}
	{!! Form::submit('Continue', ['class'=>'btn btn-primary btn-lg col-xs-3 col-xs-offset-1', 'name'=>'action', 'id'=>'Continue']) !!}
	
	
	
	
</div>

{!! Form::close() !!}

@stop

@section('footer')

<script>	
	var cloneCount=1;
	
	$("#addColumnButton").click(function() {
		//debugger;
		++cloneCount;			
				
		var $clone = $("#processingInformationTable tbody tr:last").clone();
		$clone.children("td:first").text(cloneCount);
		$clone.children("td").children("input").each(function(index)
			{
				var id = $(this).prop('id').substr(0, $(this).prop('id').lastIndexOf("_") + 1) + cloneCount;			
				var name = $(this).prop('name').substr(0, $(this).prop('name').lastIndexOf("_") + 1) + cloneCount;
				$(this).prop('id', id);
				$(this).prop('name', name);
			});
			
		$("#processingInformationTable tbody").append($clone);
						
		$("#numRows").val(cloneCount);
		
	});
		
	$(this).keyup(function()
		{
			$("#ebl_total").val(sumOfColumns("totals", 2, false));
			$("#rbc_returned_total").val(sumOfColumns("totals", 3, false));
			$("#wash_amount_total").val(sumOfColumns("totals", 4, false));			
			
		});

	function sumOfColumns(tableID, columnIndex, hasHeader) 
	{
		var tot = 0;
		$("#" + tableID + " tbody tr" + (hasHeader ? ":gt(0)" : ""))
		.children("td:nth-child(" + columnIndex + ")")
		.each(function() 
		{
			var value = parseFloat($(this).find("input").val());			
			tot += (isNaN(value) ? 0 : value);
  		});
		
  		return tot;
	}
			
	function getTotalMinutes(t)
	{		
		var timeToConvert = t.split(':');
		
		var hours = timeToConvert[0] % 24;
		
		if(hours == 0)
		{
			hours = 24;
		}
		
		var totalMinutes = hours * 60 + parseInt(timeToConvert[1]);
		return totalMinutes;
	}
			
	function getTimeDuration(time1, time2)
	{
		if(time1 == "" || time2 == "")
		{
			return "00:00";
		}
		
		var startTimeInMinutes = getTotalMinutes(time1);
		var endTimeInMinutes = getTotalMinutes(time2);
		
		if(endTimeInMinutes <= startTimeInMinutes)
		{
			endTimeInMinutes += 1440;
		}
		
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
        $('.timePicker').datetimepicker(
            {
                widgetPositioning: { vertical: 'bottom' , horizontal: 'left'},
                format: 'HH:mm'
            }
        );
        					
		$("#operation_start_time").blur(function()
		{
			var start = $("#operation_start_time").val();
			var end = $("#operation_end_time").val();
						
			$("#total_time").val(getTimeDuration(start, end));
		});
		
		$("#operation_end_time").blur(function()
		{
			var start = $("#operation_start_time").val();
			var end = $("#operation_end_time").val();
						
			$("#total_time").val(getTimeDuration(start, end));
		});
		
		$('.selectize').selectize({
			create:true,
			sortField: 'text',
			selectOnTab: true,
			closeAfterSelect: true
		})
		
		/*alert($("#POYes").attr("checked"));
		alert($("#PONo").attr("checked"));*/
	});	
		
	
	/*$('#anesthesiologist_list').select2(
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