@extends('layouts.master')

@section('content')

<h1>Edit Profession: {{$profession->name}}</h1>

{!! Form::model($profession, ['method'=>'PATCH', 'route'=>['professions.update', $profession]]) !!}

	@include('professions.partials.form', array('submitButtonText'=>'Update Profession'))
	
{!! Form::close() !!}

@stop