<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Select a Hospital</h3>
	</div>
	<div class="panel-body">
		<div class="form-group">		 
			{!! Form::label('procedure_date', 'Date', ['class'=>'control-label']) !!}
			{!! Form::input('Date', 'procedure_date', $date, ['id'=>'procedure_date', 'class'=>'form-control', 'required'=>'true']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('po_number', 'PO #') !!}
			{!! Form::text('po_number', null, ['class'=>'form-control', 'maxlength'=>20]) !!}
		</div>
		<div class="form-group">
			{!! Form::label('hospital_id', 'Hosptial') !!}
			{!! Form::select('hospital_id', array_pluck($hospitals, 'name', 'id'), null, ['class'=>'form-control selectize-no-create', 'id'=>'hospital_id', 'required'=>'true']) !!}
			<!-- select(name, defaults, selected item, additional attributes) -->	
		</div>							
		<div class="form-group">
			{!! Form::label('special_notes', 'Notes') !!}
			{!! Form::textarea('special_notes', null, ['class'=>'form-control', 'id'=>'special_notes']) !!}
		</div>
	</div>
</div>