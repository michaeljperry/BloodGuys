<div class="panel panel-primary" id = "staff">
	<div class="panel-heading">
		<h3 class="panel-title">Enter Staff Information</h3>
	</div>
	<div class="panel-body">		
		
		<div class="form-group">
			{!! Form::label('surgeon_id', 'Surgeon') !!}
			{!! Form::select('surgeon_id', array_pluck($surgeons, 'first_name', 'id'), null, ['class'=>'form-control', 'id'=>'surgeon_id']) !!}	
		</div>
		<div class="form-group">
			{!! Form::label('anesthesiologist_id', 'Anesthesiologist') !!}
			{!! Form::select('anesthesiologist_id', array_pluck($anesthesiologists, 'first_name', 'id'), null, ['class'=>'form-control', 'id'=>'anesthesiologist_id']) !!}	
		</div>
		<div class="form-group">
			{!! Form::label('primary_autotransfusionist_id', 'Auto Transfusionist') !!}
			{!! Form::select('primary_autotransfusionist_id', array_pluck($autotransfusionists, 'first_name', 'id'), null, ['class'=>'form-control', 'id'=>'primary_autotransfusionist_id']) !!}	
		</div>	
		<div class="form-group">
			{!! Form::label('secondary_autotransfusionist_id', 'Auto Transfusionist') !!}
			{!! Form::select('secondary_autotransfusionist_id', array_pluck($autotransfusionists, 'first_name', 'id'), null, ['class'=>'form-control', 'id'=>'secondary_autotransfusionist_id']) !!}	
		</div>		
	</div>
</div>