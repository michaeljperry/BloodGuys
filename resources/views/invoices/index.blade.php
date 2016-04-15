@extends('layouts.master')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<h1>Invoices List</h1>
<p class="lead">Here's a list of all your invoices.</p>
<hr>
<a href="{{route('startInvoiceProcess', array('invoice_id'=>'TBD', 'process_step'=>1))}}" class="btn btn-primary btn-lg">Create Invoice</a>
<br/>
<br/>
<table id="invoiceTable" class="table table-striped table-bordered table-hover table-responsive">
	<thead>
		<tr>
			<th>Invoice Id</th>
			<th>Service Date</th>
			<th>Hospital</th>
			<th>Edit</th>
            <th>Complete</th>
			<th>Delete</th>
            <th>Files</th>
		</tr>
	</thead>    
	<tbody>
		@foreach($invoices as $invoice)
			<tr>
				<td>{{$invoice->id}}</td>
				<td>{{$invoice->procedure_date}}</td>
				<td>{{$invoice['hospital']['name']}}</td>
				<td><a href="{{action('InvoicesController@edit', $invoice->id)}}" class="btn btn-primary"><span class="glyphicon glyphicon-edit"/></a></td>
                @if($invoice->completed)
                <td>{!! form_link(['completeInvoice', 'invoice_id'=>$invoice->id, 'complete'=>false], 'Patch', 'glyphicon-check') !!}</td>
                @else
                <td>{!! form_link(['completeInvoice', 'invoice_id'=>$invoice->id, 'complete'=>true], 'Patch', 'glyphicon-unchecked') !!}</td>
                @endif
				<td>{!! delete_glyph_icon(['invoices.destroy', $invoice->id]) !!}</td>
                <td>
                @if(count($invoice->invoiceFiles) > 0)
                
                @foreach($invoice->invoiceFiles as $file)
                    <a href="{{route('downloadFile', array('invoiceFile'=>$file))}}" download="{{$file->filename}}" class="btn btn-primary btn-sm">{{$file->filename}}</a>
                @endforeach
                @else
                <p>No files</p>
                @endif
                </td>
			</tr>
		@endforeach		
	</tbody>
    
</table>
<nav>
    <ul class="pager">
        <?php echo $invoices->render(); ?>
    </ul>
</nav>
@stop
