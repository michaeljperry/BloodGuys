@extends('layouts.master')

@section('content')

<h1>Procedure Totals</h1>

{!! Form::open(['route'=>['procedureTotals.store']]) !!}

@include('procedureTotals.partials.procedure_totals')

<div class='form-group'>	
	{!! Form::submit('Next', ['class'=>'form-control btn btn-primary']) !!}
</div>
	
{!! Form::close() !!}

<!--<a href="{{ URL::previous() }}" class="btn btn-primary" id = "previous">Prev</a >-->

@stop

@section('footer')

<script>
	
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