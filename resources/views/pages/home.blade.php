<!--tell the page to use the master layout-->
@extends('layouts.master')

<!-- tell the page where it is injecting its content at in the master page-->
@section('content')

<h1>Welcome Home</h1>
<p class="lead">Welcome to the Blood Guys invoicing system!</p> 
<hr>
<a href="{{route('startInvoiceProcess', array('invoice_id'=>'TBD', 'process_step'=>1))}}" class="btn btn-primary btn-lg">Create Invoice</a>
@stop