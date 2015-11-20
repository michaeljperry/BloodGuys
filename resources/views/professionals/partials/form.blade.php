

	
	<div class='form-group'>
		{!! Form::label('first_name', 'First Name') !!}
		{!! Form::text('first_name', null, ['class'=>'form-control']) !!}
	</div>
		
	<div class='form-group'>
		{!! Form::label('last_name', 'Last Name') !!}
		{!! Form::text('last_name', null, ['class'=>'form-control']) !!}
	</div>		
	<div class='form-group'>
		{!! Form::label('profession_id', 'Profession') !!}
		{!! Form::select('profession_id', $professions, null, ['class'=>'form-control', 'id'=>'profession_id']) !!} 
	</div>
	
	<div class='form-group'>		
		{!! Form::submit($submitButtonText, ['class'=>'form-control btn btn-primary']) !!}
	</div>

