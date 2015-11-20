<div class="panel panel-primary" id = "patient">
	<div class="panel-heading">
		<h3 class="panel-title">Enter Patient Information</h3>
	</div>
	<div class="panel-body">	
		<div class="form-group">
			{!! Form::label('first_name', 'First Name') !!}
			{!! Form::text('first_name', null, ['class'=>'form-control', 'placeholder'=>'FirstName', 'id'=>'first_name', 'maxlength' => '1']) !!}
		</div>	
		<div class="form-group">
			{!! Form::label('last_name', 'Last Name') !!}
			{!! Form::text('last_name', null, ['class'=>'form-control', 'placeholder'=>'Last Name', 'id'=>'last_name']) !!}	
		</div>
		<div class="form-group">
			{!! Form::label('patient_number', 'Patient Number') !!}
			{!! Form::text('patient_number', null, ['class'=>'form-control', 'placeholder'=>'Patient Number', 'id'=>'patient_number']) !!}	
		</div>
		<div class="form-group">
			{!! Form::label('medical_record_number', 'MRN') !!}
			{!! Form::text('medical_record_number', null, ['class'=>'form-control', 'placeholder'=>'Patient MRN', 'id'=>'medical_record_number']) !!}	
		</div>	
	</div>
</div>