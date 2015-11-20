@extends('layouts.master')

@section('content')

<h1>Equipment / Disposables</h1>

{!! Form::open(['route'=>['equipment.store']]) !!}

	@include('equipment.partials.form')
	
	<div class='form-group'>	
		{!! Form::submit('Next', ['class'=>'form-control btn btn-primary']) !!}
	</div>
	
{!! Form::close() !!}

@stop