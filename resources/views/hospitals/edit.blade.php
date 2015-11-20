@extends('layouts.master')

@section('content')

<h1>Edit Hospital: {{$hospital->name}}</h1>

{!! Form::model($hospital, ['method'=>'PATCH', 'route'=>['hospitals.update', $hospital]]) !!}

	@include('hospitals.partials.form', array('submitButtonText'=>'Update Hospital'))
	
{!! Form::close() !!}

@stop