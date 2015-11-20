@extends('layouts.master')

@section('content')

<h1>Enter Processing Information</h1>

{!! Form::open(['route'=>['processingInformation.store']]) !!}

@include('processingInformation.partials.processing_data')
{!! Form::text('numColumns', 1, ['class'=>'form-control hidden', 'id'=>'numColumns']) !!}
<div class='form-group'>	
	{!! Form::submit('Next', ['class'=>'form-control btn btn-primary']) !!}
</div>
	
{!! Form::close() !!}

<!--<a href="{{ URL::previous() }}" class="btn btn-primary" id = "previous">Prev</a >-->

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
	
	/*$("#addColumnButton").click(function() {		
		var c = $("#processingInformationTable thead th").length - 1;
		$("#processingInformationTable thead tr").append("<th>" + (c + 1) + "</th>");
		$("#processingInformationTable tbody tr").append("<td><input class='form-control' type='text' value='0' /></td>");
		$("#numColumns").val((c+1));
	});*/
	

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