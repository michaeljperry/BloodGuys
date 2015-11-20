<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Enter Processing Data</h3>
	</div>
	<div class="panel-body">	
		<div class="form-group">
			<button id="addColumnButton" type="button">+</button>
		</div>
		<div class="form-group">			
			<table id="processingInformationTable" class="table table-striped table-bordered table-hover table-responsive">
				<thead>
					<tr>						
						<th></th>
						<th>Amount Processed</th>
						<th>Anticoagulent Volume</th>
						<th>Irrigation Volume</th>
						<th>EBL</th>
						<th>RBCs Salvaged</th>
						<th>Time</th>														
					</tr>
				</thead>
				<tbody>
					@if(isset($model))
						@foreach($processingInformation as $record)
						<tr>
							<td>{{$record->column_id}}</td>
							<td>{!! Form::text(null, $record->amount_processed, ['class'=>'form-control', 'id'=>'amt_processed_'.$record->column_id, 'name'=>'amt_processed_'.$record->column_id]) !!}</td>																 
							<td>{!! Form::text(null, $record->anticoagulent_volume, ['class'=>'form-control', 'id'=>'anticoag_vol_'.$record->column_id, 'name'=>'anticoag_vol_'.$record->column_id]) !!}</td>
							<td>{!! Form::text(null, $record->irrigation_volume, ['class'=>'form-control', 'id'=>'irr_vol_'.$record->column_id, 'name'=>'irr_vol_'.$record->column_id]) !!}</td>
							<td>{!! Form::text(null, $record->ebl, ['class'=>'form-control', 'id'=>'ebl_'.$record->column_id, 'name'=>'ebl_'.$record->column_id]) !!}</td>
							<td>{!! Form::text(null, $record->rbcs_salvaged, ['class'=>'form-control', 'id'=>'rbc_'.$record->column_id, 'name'=>'rbc_'.$record->column_id]) !!}</td>
							<td>{!! Form::input('Time', null, $record->time, ['class'=>'form-control', 'id'=>'time_'.$record->column_id, 'name'=>'time_'.$record->column_id ]) !!}</td>
						</tr>
						@endforeach
					@else
						@for($index = 0; $index < $numRows; $index++)
						<tr>
							<td>{{$numRows}}</td>
							<td>{!! Form::text('amt_processed_1', 0, ['class'=>'form-control', 'id'=>'amt_processed_'.$numRows]) !!}</td>																 
							<td>{!! Form::text(null, 0, ['class'=>'form-control', 'id'=>'anticoag_vol_'.$numRows, 'name'=>'anticoag_vol_'.$numRows]) !!}</td>
							<td>{!! Form::text('irr_vol_1', 0, ['class'=>'form-control', 'id'=>'irr_vol_'.$numRows]) !!}</td>
							<td>{!! Form::text('ebl_1', 0, ['class'=>'form-control', 'id'=>'ebl_'.$numRows]) !!}</td>
							<td>{!! Form::text('rbc_1', 0, ['class'=>'form-control', 'id'=>'rbc_'.$numRows]) !!}</td>
							<td>{!! Form::input('Time', 'time_1', Carbon::now()->format('H:i'), ['class'=>'form-control', 'id'=>'time_'.$numRows]) !!}</td>
						</tr>					
						@endfor
					@endif						
				</tbody>
			</table>
			{!! Form::text('numRows', $numRows, ['class'=>'form-control hidden', 'id'=>'numRows']) !!}	
		</div>			
	</div>
</div>

