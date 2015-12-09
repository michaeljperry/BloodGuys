@extends('layouts.master')

@section('content')


<div class="col-sm-6 col-sm-offset-3">
	<div class="panel panel-primary" style="font-size:24px">
		<div class="panel-heading">		
			<h1 class="panel-title" style="font-size:28px">Hospital Details</h1>			
		</div>
		<div class="panel-body">
			@foreach($hospitals as $hospital)
				<strong>{{$hospital->name}}</strong><br>				
				{{$hospital->city}}, 
				{{$hospital->state}}
				{{$hospital->anticoagulent_volume}}
			@endforeach
		</div>
		<div class="panel-footer">
			<!--<button class ="btn btn-primary pull-left" type="button">Prev</button>
			<button class="btn btn-primary " type="button">Back</button>
			<button class="btn btn-primary pull-right" type="button">Next</button>-->
			{!! $hospitals->render() !!}			
		</div>	
	</div>
	
	<p>Page {{ $hospitals->currentPage() }} </p>
</div>
@stop