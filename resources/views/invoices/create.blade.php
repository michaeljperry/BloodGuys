@extends('layouts.master')

@section('content')

@if(Session::has('flash_message'))
	<div class="alert alert-success">
		{{ Session::get('flash_message') }}
	</div>
@endif

@if (count($errors) > 0)
	<div class="alert alert-danger">
		<strong>Whoops!</strong> There were some problems with your input.<br><br>
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
					
<h1>New Invoice</h1>
<p>This will take you through the various steps to create an invoice.</p>
<br/>

{!! Form::open(['route'=>[$current_step->save_url], 'files'=>true]) !!}


<div class="form-group">
	{!! Form::label('invoice_id', 'Invoice #') !!}
	{!! Form::text('invoice_id', $invoice_id, ['class'=>'form-control', 'id'=>'invoice_id', 'readonly']) !!}
</div>	


@include($current_step->form_path)

<div class="form-group">
	@if(isset($previous_step_url))
		<a href="{{ $previous_step_url }}" class="btn btn-primary btn-lg col-xs-3" id = "previous">Prev</a >
	@endif
	<!--<a href="{{ URL::previous() }}" class="btn btn-primary btn-lg col-xs-4 col-xs-offset-1" id = "previous">Save</a >-->
	{!! Form::submit('Next', ['class'=>'btn btn-primary btn-lg col-xs-3 col-xs-offset-1']) !!}		
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