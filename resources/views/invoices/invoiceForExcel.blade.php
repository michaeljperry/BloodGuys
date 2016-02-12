@extends('layouts.master')

@section('content')

<h1>Invoices List</h1>
<p class="lead">Here's a list of all your invoices.</p>
<hr>

<table class="table table-striped table-bordered table-hover table-responsive">
	@if($showHeaders == true)
	<thead>
		<tr>
            <th>Invoice Id</th>
			<th>Hospital</th>
			<th>State</th>
			<th>Procedure Date</th>
			<th>Patient Number</th>
			<th>MRN</th>
			<th>Surgeon</th>
			<th>Procedure</th>
			<th>EBL OR</th>
			<th>RBC Returned OR</th>
			<th>EBL PO</th>
			<th>RBC Returned PO</th>
			<th>Predntd Avail</th>
			<th>Predntd Used</th>
			<th>Anticoag Volume</th>
			<th>Charge</th>
			<th>Auto Transfusionist 1</th>
			<th>Auto Transfusionist 2</th>
			<th>Special Notes</th>
			<th>Complication Involved</th>
			<th>PO Number</th>	
		</tr>
	</thead>
	@endif
	<tbody>
		@foreach($invoices as $invoice)
			<tr>
                <td>{{ $invoice->InvoiceId }}</td>
				<td>{{ $invoice->Hospital }}</td>
				<td>{{ $invoice->State }}</td>								
				<td>{{ $invoice->procedure_date }}</td>				
				<td>{{ $invoice->patient_number }}</td>
				<td>{{ $invoice->medical_record_number }}</td>
				<td>{{ $invoice->Surgeon }}</td>
				<td>{{ $invoice->procedure }}</td>
				<td>{{ $invoice->ebl_or }}</td>
				<td>{{ $invoice->rbc_returned_or }}</td>
				<td>{{ $invoice->ebl_po }}</td>
				<td>{{ $invoice->rbc_returned_po }}</td>
				<td>{{ $invoice->Predntd_Avail }}</td>
				<td>{{ $invoice->Predntd_Used }}</td>
				<td>{{ $invoice->AntiCoag }}</td>
				<td>{{ $invoice->Charge }}</td>
				<td>{{ $invoice->AutoTransfusionist1 }}</td>
				<td>{{ $invoice->AutoTransfusionist2 }}</td>
				<td>{{ $invoice->special_notes }}</td>
				<td>{{ $invoice->ComplicationInvolved }}</td>
				<td>{{ $invoice->po_number }}</td>
			</tr>
		@endforeach		
	</tbody>
</table>
@stop

