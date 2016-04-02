<div class="panel panel-primary" id = "staff">
	<div class="panel-heading">
		<h3 class="panel-title">Enter Staff Information</h3>
	</div>
	<div class="panel-body">		
		
		<div class="form-group">
			{!! Form::label('surgeon_id', 'Surgeon') !!}
			{!! Form::select('surgeon_id', ['default'=>'None'] + array_pluck($surgeons, 'professional_name', 'id'), $default, ['class'=>'form-control selectize', 'id'=>'surgeon_id']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('anesthesiologist_id', 'Anesthesiologist') !!}
			{!! Form::select('anesthesiologist_id', ['default'=>'None'] + array_pluck($anesthesiologists, 'professional_name', 'id'), $default, ['class'=>'form-control selectize', 'id'=>'anesthesiologist_id']) !!}	
		</div>
		<div class="form-group">
			{!! Form::label('primary_autotransfusionist_id', 'Auto Transfusionist') !!}
			
            @if($primary_autoTransfusionist_editable === true)
        	
            {!! Form::select('primary_autotransfusionist_id', ['default'=>'None'] + array_pluck($autotransfusionists, 'user_name', 'id'), $primary_autoTransfusionist, ['class'=>'form-control selectize-no-create', 'id'=>'secondary_autotransfusionist_id']) !!}
            
            @else
            
            {!! Form::text('primary_autotransfusionist_id', $primary_autoTransfusionist, ['class'=>'form-control', 'id'=>'primary_autotransfusionist_id', 'required'=>'true', 'readonly']) !!}
            
            @endif
                        	
		</div>	
        
		<div class="form-group">
			{!! Form::label('secondary_autotransfusionist_id', 'Auto Transfusionist 2') !!}
		    
            @if($secondary_autoTransfusionist_editable === true)
        	
            {!! Form::select('secondary_autotransfusionist_id', ['default'=>'None'] + array_pluck($autotransfusionists, 'user_name', 'id'), $secondary_autoTransfusionist, ['class'=>'form-control selectize-no-create', 'id'=>'secondary_autotransfusionist_id']) !!}
            
            @else 
            
            {!! Form::text('secondary_autotransfusionist_id', $secondary_autoTransfusionist, ['class'=>'form-control', 'id'=>'secondary_autotransfusionist_id', 'required'=>'true', 'readonly']) !!}
            
            @endif
		</div>		
        
	</div>
</div>