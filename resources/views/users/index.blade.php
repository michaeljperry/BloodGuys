@extends('layouts.master')

@section('content')

<h1>Users</h1>
<br/>
<table class="table table-striped table-bordered table-hover table-responsive">
	<thead>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Is Admin</th>			
			<th>Edit</th>
			<!--<th>Delete</th>-->
		</tr>
	</thead>
	<tbody>
		@foreach($users as $user)
			<tr>
				<td>{{$user->name}}</td>
				<td>{{$user->email}}</td>
				<td>
					@if($user->admin)
						<input type="checkbox" checked disabled>
					@else
						<input type="checkbox" disabled>
					@endif
				</td>
				<td><a href="{{action('UsersController@edit', $user->id)}}" class="btn btn-primary"><span class="glyphicon glyphicon-edit"/></a></td>
				<!--<td>{!! delete_glyph_icon(['users.destroy', $user->id]) !!}</td>-->
			</tr>
		@endforeach		
	</tbody>
</table>
<br/>
<a href="{{route('users.create')}}" class="btn btn-primary btn-lg">Add User</a>
@stop


@section('footer')
<script>

$('div.alert').not('.alert-important').delay(3000).slideUp(300);

</script>

@stop