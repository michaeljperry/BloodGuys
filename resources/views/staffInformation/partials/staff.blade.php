<div class="panel panel-primary" id = "staff">
	<div class="panel-heading">
		<h3 class="panel-title">Enter Staff Information</h3>
	</div>
	<div class="panel-body">		
		
		<div class="form-group">
			{!! Form::label('surgeon_id', 'Surgeon') !!}
			{!! Form::select('surgeon_id', array_pluck($surgeons, 'professional_name', 'id'), null, ['class'=>'form-control selectize', 'id'=>'surgeon_id']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('anesthesiologist_id', 'Anesthesiologist') !!}
			{!! Form::select('anesthesiologist_id', ['default'=>'None'] + array_pluck($anesthesiologists, 'professional_name', 'id'), $default, ['class'=>'form-control selectize', 'id'=>'anesthesiologist_id']) !!}	
		</div>
		<div class="form-group">
			{!! Form::label('primary_autotransfusionist_id', 'Auto Transfusionist') !!}
			{!! Form::select('primary_autotransfusionist_id', array_pluck($autotransfusionists, 'professional_name', 'id'), null, ['class'=>'form-control selectize', 'id'=>'primary_autotransfusionist_id', 'required'=>'true']) !!}	
		</div>	
		<div class="form-group">
			{!! Form::label('secondary_autotransfusionist_id', 'Auto Transfusionist 2') !!}
			{!! Form::select('secondary_autotransfusionist_id', ['default'=>'None'] + array_pluck($autotransfusionists, 'professional_name', 'id'), $default, ['class'=>'form-control selectize', 'id'=>'secondary_autotransfusionist_id']) !!}	
		</div>		
	</div>
</div>