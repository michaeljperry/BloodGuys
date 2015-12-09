@extends('layouts.master')

@section('content')

<h1>Professions</h1>
<br/>
<table class="table table-striped table-bordered table-hover table-responsive">
	<thead>
		<tr>
			<th>Name</th>			
			<th>Edit</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tbody>
		@foreach($professions as $profession)
			<tr>
				<td>{{$profession->name}}</a></td>
				<td><a href="{{action('ProfessionsController@edit', $profession->id)}}" class="btn btn-primary"><span class="glyphicon glyphicon-edit"/></a></td>
				<td>{!! delete_glyph_icon(['professions.destroy', $profession->id]) !!}</td>
			</tr>
		@endforeach		
	</tbody>
</table>
<br/>
<a href="{{route('professions.create')}}" class="btn btn-primary btn-lg">Add Profession</a>
@stop


@section('footer')
<script>

$('div.alert').not('.alert-important').delay(3000).slideUp(300);

</script>

@stop