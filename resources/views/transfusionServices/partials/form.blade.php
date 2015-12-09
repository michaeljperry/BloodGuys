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
						<td>{!! Form::text('basic_service_quantity', $default, ['class'=>'form-control', 'id'=>'basic_service_quantity', 'required'=>'true']) !!}</td>
						<td>{!! Form::text('basic_service_charge', $default, ['class'=>'form-control', 'id'=>'basic_service_charge', 'required'=>'true']) !!}</td>
						<td>{!! Form::text('basic_service_total', $default, ['class'=>'form-control', 'id'=>'basic_service_total', 'readonly', 'required'=>'true']) !!}</td>											 
					</tr>						
						
					<tr>
						<td>Modified Service - No Blood Processed</td>
						<td>{!! Form::text('modified_service_quantity', $default, ['class'=>'form-control', 'id'=>'modified_service_quantity', 'required'=>'true']) !!}</td>
						<td>{!! Form::text('modified_service_charge', $default, ['class'=>'form-control', 'id'=>'modified_service_charge', 'required'=>'true']) !!}</td>
						<td>{!! Form::text('modified_service_total', $default, ['class'=>'form-control', 'id'=>'modified_service_total', 'readonly', 'required'=>'true']) !!}</td>						
					</tr>									
				</tbody>
			</table>		
		</div>				
	</div>
</div>

