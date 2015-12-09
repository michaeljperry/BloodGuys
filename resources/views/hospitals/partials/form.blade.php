

	<div class='form-group'>
		{!! Form::label('name', 'Name') !!}
		{!! Form::text('name', null, ['class'=>'form-control']) !!}
	</div>
	
	<div class='form-group'>
		{!! Form::label('state', 'State') !!}
		{!! Form::text('state', null, ['class'=>'form-control']) !!}
	</div>
	
	<div class='form-group'>
		{!! Form::label('anticoagulent_volume', 'Anti-Coagulent Volume') !!}
		{!! Form::text('anticoagulent_volume', null, ['class'=>'form-control']) !!}
	</div>
	
	<div class='form-group'>		
		{!! Form::submit($submitButtonText, ['class'=>'form-control btn btn-primary']) !!}
	</div>

