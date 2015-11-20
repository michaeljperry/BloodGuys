@extends('layouts.master')

@section('content')

<h1>Edit Professional: {{$professional->first_name}}</h1>

{!! Form::model($professional, ['method'=>'PATCH', 'route'=>['professionals.update', $professional]]) !!}

	@include('professionals.partials.form', array('submitButtonText'=>'Update Professional'))
	
{!! Form::close() !!}

@stop