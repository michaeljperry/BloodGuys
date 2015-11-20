@extends('layouts.master')

@section('content')

<h1>Create a new Profession</h1>

{!! Form::open(['route'=>['professions.store']]) !!}

	@include('professions.partials.form', array('submitButtonText'=>'Create Profession'))
	
{!! Form::close() !!}

@stop