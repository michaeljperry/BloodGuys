<div class = "panel panel-primary">
	<div class = "panel-heading">		
		<h3 class = "panel-title">Enter Procedure Information</h3>
	</div>
	<div class = "panel-body">		
		<div class="form-group">
			{!! Form::label('PhysicianOrder', 'Physician Order', ['class'=>'control-label']) !!}									
			<br/>
			{!! Form::buttonToggle([['id'=>'POYes', 'value'=>1, 'text'=>'Yes'],['id'=>'PONo', 'value'=>0, 'text'=>'No']], 'physician_order', 'PhysicianOrder') !!}			
		</div>
		<div class="form-group">
			{!! Form::label('MethodGroup', 'Method Group', ['class'=>'control-label']) !!}									
			<br/>
			{!! Form::buttonToggle([['id'=>'Verbal', 'value'=>1, 'text'=>'Verbal'],['id'=>'Written', 'value'=>2, 'text'=>'Written']], 'method_group', 'MethodGroup') !!}					
		</div>	
		
		<div class="form-group">
			{!! Form::label('procedure', 'Procedure', ['class'=>'control-label']) !!}
			{!! Form::text('procedure', null, ['id'=>'procedure', 'class'=>'form-control', 'required'=>'true']) !!}	
		</div>
		<div class="form-group">
			{!! Form::label('operation_start_time', 'OR Start Time', ['class'=>'control-label']) !!}
            
            <div class="input-group date timePicker">
                {!! Form::text('operation_start_time', null, ['id'=>'operation_start_time', 'class'=>'form-control', 'required'=>'true']) !!}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-time"></span>
                </span>
            </div>
		</div>
		<div class="form-group">
			{!! Form::label('collection_start_time', 'Collection Start Time', ['class' => 'control-label']) !!}
            <div class="input-group date timePicker">
                {!! Form::text('collection_start_time', null, ['id'=>'collection_start_time', 'class'=>'form-control']) !!}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-time"></span>
                </span>
            </div>            							
		</div>
		
		<div class="form-group">
			{!! Form::label('operation_end_time', 'OR End Time', ['class' => 'control-label']) !!}
			<div class="input-group date timePicker">
                {!! Form::text('operation_end_time', null, ['id'=>'operation_end_time', 'class'=>'form-control', 'required'=>'true']) !!}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-time"></span>
                </span>
            </div>							
		</div>
		
		<div class="form-group">
			{!! Form::label('total_time', 'Total Time', ['class' => 'control-label']) !!}
			{!! Form::text('total_time', null, ['id'=>'total_time', 'class'=>'form-control', 'readonly'=>'true', 'required'=>'true']) !!}							
		</div>
		
		<div class="form-group">
			{!! Form::label('wash_time', 'Wash Time', ['class' => 'control-label']) !!}
			<div class="input-group date timePicker">
                {!! Form::text('wash_time', $wash_time, ['id'=>'wash_time', 'class'=>'form-control']) !!}							
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-time"></span>
                </span>
            </div>
        </div>	
	</div>
</div>

