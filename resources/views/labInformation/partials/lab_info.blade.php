<div class="panel panel-primary" id = "labInfo">
	<div class="panel-heading">
		<h3 class="panel-title">Enter Lab Information</h3>
	</div>
	<div class="panel-body">	
		<div class="form-group">
			{!! Form::label('pre_op_hematocrit', 'Pre-Op Hematocrit', ['class'=>'control-label']) !!}
			{!! Form::text('pre_op_hematocrit', null, ['class'=>'form-control', 'id'=>'pre_op_hematocrit']) !!}
		</div>	
		<div class="form-group">
			{!! Form::label('date_taken', 'Date Taken', ['class'=>'control-label']) !!}
			{!! Form::input('Date', 'date_taken', $dateTaken, ['class'=>'form-control', 'id'=>'date_taken']) !!}	
		</div>			
	</div>
</div>