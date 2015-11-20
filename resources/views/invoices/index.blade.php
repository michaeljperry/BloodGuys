@extends('layouts.master')

@section('content')

<h1>Invoices List</h1>
<p class="lead">Here's a list of all your invoices.</p>
<hr>

<table class="table table-striped table-bordered table-hover table-responsive">
	<thead>
		<tr>
			<th>Invoice Id</th>
			<th>Service Date</th>
			<th>Hospital</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tbody>
		@foreach($invoices as $invoice)
			<tr>
				<td>{{$invoice->id}}</td>
				<td>{{$invoice->procedure_date}}</td>
				<td>{{$invoice->hospital->name}}</td>
				<td><a href="{{action('InvoicesController@edit', $invoice->id)}}" class="btn btn-primary"><span class="glyphicon glyphicon-edit"/></a></td>
				<td>{!! delete_glyph_icon(['invoices.destroy', $invoice->id]) !!}</td>
			</tr>
		@endforeach		
	</tbody>
</table>
<br/>
<a href="{{route('startInvoiceProcess', array('invoice_id'=>'TBD', 'process_step'=>1))}}" class="btn btn-primary btn-lg">Create Invoice</a>
@stop

