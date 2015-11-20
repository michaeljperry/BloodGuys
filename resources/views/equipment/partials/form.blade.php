<div class="panel panel-primary" id = "equipmentPanel">
	<div class="panel-heading">
		<h3 class="panel-title">Equipment</h3>
	</div>
	<div class="panel-body">	
		<div class="form-group  table-responsive">				
			<table class="table table-striped table-bordered table-hover" id="equipment" name="equipment">
				<thead>
					<tr>
						<th class="col-xs-2"></th>
						<th class="col-xs-2">Device Name</th>		
						<th class="col-xs-2">Manufacturer</th>
						<th class="col-xs-2">Serial Number</th>
						<th class="col-xs-2">Self Test</th>							
					</tr>
				</thead>
				<tbody>					
					<tr>
						<td>Device</td>	
						<td>{!! Form::text('device_name', null, ['class'=>'form-control', 'id'=>'device_name']) !!}</td>
						<td>{!! Form::text('manufacturer', null, ['class'=>'form-control', 'id'=>'manufacturer']) !!}</td>
						<td>{!! Form::text('serial_number', null, ['class'=>'form-control', 'id'=>'serial_number']) !!}</td>
						<td>
							{!! Form::buttonToggle([['id'=>'STPass', 'value'=>1, 'text'=>'Pass'],['id'=>'STFail', 'value'=>0, 'text'=>'Fail']], 'self_test_passed', 'Self_Test') !!}						
						</td>
					</tr>									
				</tbody>				
			</table>		
		</div>				
	</div>
</div>