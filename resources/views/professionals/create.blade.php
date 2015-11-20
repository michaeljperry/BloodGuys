@extends('layouts.master')

@section('content')

<h1>Create a new Professional</h1>

{!! Form::open(['route'=>['professionals.store']]) !!}

	@include('professionals.partials.form', array('submitButtonText'=>'Create Professional'))
	
{!! Form::close() !!}

@stop