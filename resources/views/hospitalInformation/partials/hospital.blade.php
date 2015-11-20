<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Select a Hospital</h3>
	</div>
	<div class="panel-body">
		<div class="form-group">
			{!! Form::label('hospital_list', 'Hosptial') !!}
			{!! Form::select('hospital_list', array_pluck($hospitals, 'name', 'id'), null, ['class'=>'form-control', 'id'=>'hospital_list']) !!}
			<!-- select(name, defaults, selected item, additional attributes) -->	
		</div>
		<div class="form-group">
			{!! Form::label('State', 'State') !!}
			{!! Form::text('State', null, ['class'=>'form-control', 'placeholder'=>'state']) !!}	
		</div>		
	</div>
</div>