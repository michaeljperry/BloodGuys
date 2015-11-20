@extends('layouts.master')

@section('content')

<h1>Edit Invoice</h1>

{!! Form::model($invoice, ['method'=>'PATCH', 'route'=>['invoices.update', $invoice]]) !!}

	@include('invoices.partials.form')
	
<div class='form-group'>	
	{!! Form::submit('Update Invoice', ['class'=>'form-control btn btn-primary']) !!}
</div>

{!! Form::close() !!}

@stop