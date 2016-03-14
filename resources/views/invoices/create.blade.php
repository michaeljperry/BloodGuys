@extends('layouts.master')

@section('content')
					
<h1>New Invoice</h1>
<p>This will take you through the various steps to create an invoice.</p>
<br/>

{!! Form::open(['route'=>[$current_step->save_url], 'files'=>true, 'id'=>'createForm']) !!}


<div class="form-group">
	{!! Form::label('invoice_id', 'Invoice #') !!}
	{!! Form::text('invoice_id', $invoice_id, ['class'=>'form-control', 'id'=>'invoice_id', 'readonly']) !!}
</div>	


@include($current_step->form_path)

<div class="form-group">
	@if(isset($previous_step_url))
		{!! Form::submit('Previous', ['class' => 'btn btn-primary btn-lg col-xs-3', 'id' => 'Previous', 'name' => 'action']) !!}
	@endif
	
	{!! Form::submit('Continue', ['class'=>'btn btn-primary btn-lg col-xs-3 col-xs-offset-1', 'name'=>'action', 'id'=>'Continue']) !!}		
</div>
	
{!! Form::close() !!}



@stop

@section('footer')

<script>	
    var hasBeenSubmitted = false;
    console.log('submitted:'+hasBeenSubmitted);
        
    $("#form").submit(function()
    {
        if(hasBeenSubmitted == true)
        {
            console.log("already submitted.");
            return false;
        }
        
        console.log('submit function');
        hasBeenSubmitted = true;
        
        // can't use value because it's used to determine what to do in the controller
        // disabling seems to make it not send the button information
                
        console.log('submit true');
        return true;
    });

	var cloneCount=1;
	
	$("#addColumnButton").click(function() {
		//debugger;
		++cloneCount;		
        
        console.log('i am here');	
				
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
			
			$("#wash_kit_total").val( $("#wash_kit_quantity").val() * $("#wash_kit_charge").val() );
			$("#reservoir_total").val( $("#reservoir_quantity").val() * $("#reservoir_charge").val() );
			$("#aspiration_assembly_total").val( $("#aspiration_assembly_quantity").val() * $("#aspiration_assembly_charge").val() );
			$("#blood_bag_total").val( $("#blood_bag_quantity").val() * $("#blood_bag_charge").val() );
			$("#vacuum_tubing_total").val( $("#vacuum_tubing_quantity").val() * $("#vacuum_tubing_charge").val() );
			$("#wound_drain_total").val( $("#wound_drain_quantity").val() * $("#wound_drain_charge").val() );
			$("#y_connector_total").val( $("#y_connector_quantity").val() * $("#y_connector_charge").val() );
			$("#blood_filter_total").val( $("#blood_filter_quantity").val() * $("#blood_filter_charge").val() );
			$("#acda_bag_total").val( $("#acda_bag_quantity").val() * $("#acda_bag_charge").val() );
			$("#misc_total").val( $("#misc_quantity").val() * $("#misc_charge").val() );
			
			$("#basic_service_total").val( $("#basic_service_quantity").val() * $("#basic_service_charge").val() );
			$("#modified_service_total").val( $("#modified_service_quantity").val() * $("#modified_service_charge").val() );
			
		});

	function sumOfColumns(tableID, columnIndex, hasHeader) 
	{
		var tot = 0;
		$("#" + tableID + " tbody tr" + (hasHeader ? ":gt(0)" : ""))
		.children("td:nth-child(" + columnIndex + ")")
		.each(function() 
		{
			var value = parseInt($(this).find("input").val());			
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
		});
        
        $('.selectize-no-create').selectize({
            create: false,
            sortField: 'text',
            selectOnTab: true,
            closeAfterSelect: true,
            persist: false
        });
	});		
	
</script>
	

@stop