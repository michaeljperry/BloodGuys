@extends('layouts.master')

@section('content')

<h1>Edit an Invoice</h1>
<h2>{{$invoice->hospital->name}} {{$invoice->procedure_date}}</h2>

<table class="table table-striped table-bordered table-hover table-responsive">
	<thead>
		<tr>
			<th>Invoice Section</th>
			<th>Edit</th>						
		</tr>
	</thead>
	<tbody>
		@foreach($invoice->invoiceSections as $invoice_section)
			<tr>
				<td>{{$invoice_section->display_name}}</td>
				@if($invoice_section->pivot->completed)					
					<td><a href="{{action($invoice_section->edit_url, ['invoice_id'=>$invoice->id, 'invoice_section_id' => $invoice_section->id])}}" class="btn btn-primary"><span class="glyphicon glyphicon-edit"/></a></td>
				@else
					<td><a href="{{route('startInvoiceProcess', array('invoice_id'=>$invoice->id, 'process_step'=>$invoice_section->process_step)) }}" class="btn btn-primary btn-lg">Complete</a></td>				
				@endif									
			</tr>
		@endforeach
		
	</tbody>
</table>

@stop