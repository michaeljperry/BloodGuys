<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Select a Hospital</h3>
	</div>
	<div class="panel-body">
		<div class="form-group">		 
			{!! Form::label('procedure_date', 'Date', ['class'=>'control-label']) !!}
			{!! Form::input('Date', 'procedure_date', $date, ['id'=>'procedure_date', 'class'=>'form-control']) !!}
		</div>
		
		<div class="form-group">
			{!! Form::label('hospital_id', 'Hosptial') !!}
			{!! Form::select('hospital_id', array_pluck($hospitals, 'name', 'id'), null, ['class'=>'form-control', 'id'=>'hospital_id']) !!}
			<!-- select(name, defaults, selected item, additional attributes) -->	
		</div>
		<div class="form-group">
			{!! Form::label('State', 'State') !!}
			{!! Form::text('State', 'CA', ['class'=>'form-control', 'placeholder'=>'state']) !!}	
		</div>		
	</div>
</div>