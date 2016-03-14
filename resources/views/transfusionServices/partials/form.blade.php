<div class="panel panel-primary" id = "transfusionServicesPanel">
	<div class="panel-heading">
		<h3 class="panel-title">Autotransfusion Charge</h3>
	</div>
	<div class="panel-body">	
		<div class="form-group  table-responsive">				
			<table class="table table-striped table-bordered table-hover" id="transfusion_services" name="transfusion_services">
				<thead>
					<tr>
						<th class="col-xs-2">Item Description</th>
						<th class="col-xs-2">Quantity</th>		
						<th class="col-xs-2">Charge</th>
						<th class="col-xs-2">Total</th>							
					</tr>
				</thead>
				<tbody>
					
					<tr>
						<td>Basic Service</td>	
						<td>{!! Form::input('number', 'basic_service_quantity', $default, ['class'=>'form-control calculate numeric', 'id'=>'basic_service_quantity', 'required'=>'true']) !!}</td>
						<td>{!! Form::input('number', 'basic_service_charge', $default, ['class'=>'form-control calculate numeric', 'id'=>'basic_service_charge', 'required'=>'true']) !!}</td>
						<td>{!! Form::text('basic_service_total', $default, ['class'=>'form-control', 'id'=>'basic_service_total', 'readonly', 'required'=>'true']) !!}</td>											 
					</tr>						
						
					<tr>
						<td>Modified Service - No Blood Processed</td>
						<td>{!! Form::input('number', 'modified_service_quantity', $default, ['class'=>'form-control calculate numeric', 'id'=>'modified_service_quantity', 'required'=>'true']) !!}</td>
						<td>{!! Form::input('number', 'modified_service_charge', $default, ['class'=>'form-control calculate numeric', 'id'=>'modified_service_charge', 'required'=>'true']) !!}</td>
						<td>{!! Form::text('modified_service_total', $default, ['class'=>'form-control', 'id'=>'modified_service_total', 'readonly', 'required'=>'true']) !!}</td>						
					</tr>
                    <tr>
						<td>Additional Operator Hours</td>
						<td>{!! Form::input('number', 'additional_operator_hours', $default, ['class'=>'form-control calculate numeric', 'id'=>'additional_operator_hours', 'required'=>'true']) !!}</td>
						<td>{!! Form::input('number', 'additional_operator_hours_charge', $default, ['class'=>'form-control calculate numeric', 'id'=>'additional_operator_hours_charge', 'required'=>'true']) !!}</td>
						<td>{!! Form::text('additional_operator_hours_total', $default, ['class'=>'form-control', 'id'=>'additional_operator_hours_total', 'readonly', 'required'=>'true']) !!}</td>						
					</tr>
                    <tr>
						<td>Platelate Gel Service</td>
						<td>{!! Form::input('number', 'platelate_gel_service_quantity', $default, ['class'=>'form-control calculate numeric', 'id'=>'platelate_gel_service_quantity', 'required'=>'true']) !!}</td>
						<td>{!! Form::input('number', 'platelate_gel_service_charge', $default, ['class'=>'form-control calculate numeric', 'id'=>'platelate_gel_service_charge', 'required'=>'true']) !!}</td>
						<td>{!! Form::text('platelate_gel_service_total', $default, ['class'=>'form-control', 'id'=>'platelate_gel_service_total', 'readonly', 'required'=>'true']) !!}</td>						
					</tr>									
				</tbody>
			</table>		
		</div>				
	</div>
</div>

@section('footer')

<script>

$(".calculate").blur(function()
{    
    $("#basic_service_total").val( $("#basic_service_quantity").val() * $("#basic_service_charge").val() );
    $("#modified_service_total").val( $("#modified_service_quantity").val() * $("#modified_service_charge").val() );
    $("#additional_operator_hours_total").val( $("#additional_operator_hours").val() * $("#additional_operator_hours_charge").val() );
    $("#platelate_gel_service_total").val( $("#platelate_gel_service_quantity").val() * $("#platelate_gel_service_charge").val() );   
    
});
    

</script>

@stop