@extends('layouts.master')

@section('content')

<h1>Edit Invoice - {{$invoice_section->title}}</h1>

{!! Form::model($model, ['method'=>'PATCH', 'route'=>[$invoice_section->update_url, $model]]) !!}

	@include($invoice_section->form_path)
	
<div class='form-group'>	
	@if(isset($previous_step_url))
		<a href="{{ $previous_step_url }}" class="btn btn-primary btn-lg col-xs-3" id = "previous">Prev</a >
	@endif
	
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