

	<div class='form-group'>
		{!! Form::label('name', 'Name') !!}
		{!! Form::text('name', null, ['class'=>'form-control']) !!}
	</div>
	
	<div class='form-group'>
		{!! Form::label('street_address', 'Street Address Line 1') !!}
		{!! Form::text('street_address', null, ['class'=>'form-control']) !!}
	</div>
	
	<div class='form-group'>
		{!! Form::label('street_address_2', 'Street Address Line 2') !!}
		{!! Form::text('street_address_2', null, ['class'=>'form-control']) !!}
	</div>
	
	<div class='form-group'>
		{!! Form::label('city', 'City') !!}
		{!! Form::text('city', null, ['class'=>'form-control']) !!}
	</div>
	
	<div class='form-group'>
		{!! Form::label('state', 'State') !!}
		{!! Form::text('state', null, ['class'=>'form-control']) !!}
	</div>
	
	<div class='form-group'>
		{!! Form::label('zip_code', 'Zip Code') !!}
		{!! Form::text('zip_code', null, ['class'=>'form-control']) !!}
	</div>
	
	<div class='form-group'>		
		{!! Form::submit($submitButtonText, ['class'=>'form-control btn btn-primary']) !!}
	</div>

