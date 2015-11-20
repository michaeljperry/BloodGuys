@extends('layouts.master')

@section('content')

<h1>Create a Hospital</h1>

{!! Form::open(['route'=>['hospitals.store']]) !!}

	@include('hospitals.partials.form', array('submitButtonText'=>'Create Hospital'))
	
{!! Form::close() !!}

@stop