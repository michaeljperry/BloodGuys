

	<div class='form-group'>
		{!! Form::label('name', 'Name') !!}
		{!! Form::text('name', null, ['class'=>'form-control']) !!}
	</div>
			
	<div class='form-group'>		
		{!! Form::submit($submitButtonText, ['class'=>'form-control btn btn-primary']) !!}
	</div>

