@extends('layouts.master')

@section('content')

@if(Session::has('flash_message'))
	<div class="alert alert-success">
		{{ Session::get('flash_message') }}
	</div>
@endif

<h1>Hospitals</h1>
<br/>
<table class="table table-striped table-bordered table-hover table-responsive">
	<thead>
		<tr>
			<th>Name</th>
			<th>State</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tbody>
		@foreach($hospitals as $hospital)
			<tr>
				<td><a href="{{route('hospitals.show', $hospital->id)}}">{{$hospital->name}}</a></td>
				<td>{{$hospital->state}}</td>
				<td><a href="{{action('HospitalsController@edit', $hospital->id)}}" class="btn btn-primary"><span class="glyphicon glyphicon-edit"/></a></td>
				<td>{!! delete_glyph_icon(['hospitals.destroy', $hospital->id]) !!}</td>
			</tr>
		@endforeach		
	</tbody>
</table>
<br/>
<a href="{{route('hospitals.create')}}" class="btn btn-primary btn-lg">Add Hospital</a>
@stop


@section('footer')
<script>

$('div.alert').not('.alert-important').delay(3000).slideUp(300);

</script>

@stop