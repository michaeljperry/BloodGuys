@extends('layouts.master')

@section('content')

@if(Session::has('flash_message'))
	<div class="alert alert-success">
		{{ Session::get('flash_message') }}
	</div>
@endif

<h1>Professionals</h1>
<br/>
<table class="table table-striped table-bordered table-hover table-responsive">
	<thead>
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Profession</th>			
			<th>Edit</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tbody>
		@foreach($professionals as $professional)
			<tr>
				<td>{{$professional->first_name}}</a></td>
				<td>{{$professional->last_name}}</a></td>
				<td>{{$professional->profession->name}}</td>
				<td><a href="{{action('ProfessionalsController@edit', $professional->id)}}" class="btn btn-primary"><span class="glyphicon glyphicon-edit"/></a></td>
				<td>{!! delete_glyph_icon(['professionals.destroy', $professional->id]) !!}</td>
			</tr>
		@endforeach		
	</tbody>
</table>
<br/>
<a href="{{route('professionals.create')}}" class="btn btn-primary btn-lg">Add Professional</a>
@stop


@section('footer')
<script>

$('div.alert').not('.alert-important').delay(3000).slideUp(300);

</script>

@stop