<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Enter Processing Data</h3>
	</div>
	<div class="panel-body">	
		<div class="form-group">
			<button id="addColumnButton" type="button">+</button>
            <button id="removeColumnButton" type="button" style="display: none">-</button>
		</div>
		<div class="table-responsive" style="height: 350px;">			
			<table id="processingInformationTable" class="table table-striped table-hover table-responsive">
				<thead>
					<tr>						
						<th></th>
						<th>Amount Processed</th>
						<th>Anticoagulent Volume</th>
						<th>Irrigation Volume</th>
						<th>EBL</th>
						<th>RBCs Salvaged</th>
						<th>Time</th>	
                        <th>Remove</th>													
					</tr>
				</thead>
				<tbody>
					@if(isset($model))
						@foreach($processingInformation as $record)
						<tr>
                            
							<td>{{$record->column_id}}</td>
							
                            <td>                                
                                <div class="input-group" >   
                                    {!! Form::input('number', null, $record->amount_processed, ['class'=>'form-control numeric', 'id'=>'amt_processed_'.$record->column_id, 'name'=>'amt_processed_'.$record->column_id, 'required'=>'true']) !!}
                                    <span class="input-group-addon">mL</span>
                                </div>                                                                         
                            </td>
                             																 
							<td>
                                <div class="input-group" >
                                    {!! Form::input('number', null, $record->anticoagulent_volume, ['class'=>'form-control numeric', 'id'=>'anticoag_vol_'.$record->column_id, 'name'=>'anticoag_vol_'.$record->column_id, 'required'=>'true']) !!}
                                    <span class="input-group-addon">mL</span>
                                </div>
                            </td>
							<td>
                                <div class="input-group" >
                                    {!! Form::input('number', null, $record->irrigation_volume, ['class'=>'form-control numeric', 'id'=>'irr_vol_'.$record->column_id, 'name'=>'irr_vol_'.$record->column_id, 'required'=>'true']) !!}
                                    <span class="input-group-addon">mL</span>
                                </div>
                            </td>
							<td>
                                <div class="input-group" >
                                    {!! Form::input('number', null, $record->ebl, ['class'=>'form-control numeric', 'id'=>'ebl_'.$record->column_id, 'name'=>'ebl_'.$record->column_id, 'required'=>'true']) !!}
                                    <span class="input-group-addon">mL</span>
                                </div>
                            </td>
                                
							<td>
                                <div class="input-group" >
                                    {!! Form::input('number', null, $record->rbcs_salvaged, ['class'=>'form-control numeric', 'id'=>'rbc_'.$record->column_id, 'name'=>'rbc_'.$record->column_id, 'required'=>'true']) !!}
                                    <span class="input-group-addon">mL</span>
                                </div>
                            </td>
							<td>                               
                                
                                    <div class='input-group date timePicker'>          
                                        {!! Form::text(null, $record->time, ['class'=>'form-control', 'id'=>'time_'.$record->column_id, 'name'=>'time_'.$record->column_id, 'required'=>'true' ]) !!}
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"> </span>
                                        </span>
                                    </div>
                                
                            </td>                        
                        </tr>
						@endforeach
					@else
						@for($index = 0; $index < $numRows; $index++)
						<tr>
							<td>{{$numRows}}</td>
							<td>
                                <div class="input-group">
                                    {!! Form::input('number', 'amt_processed_1', 0, ['class'=>'form-control numeric', 'id'=>'amt_processed_'.$numRows, 'required'=>'true', 'step'=>'0.01']) !!}
                                    <span class="input-group-addon">mL</span>
                                </div>
                            </td>																 
							<td>
                                <div class="input-group">
                                    {!! Form::input('number', null, $anticoag_vol, ['class'=>'form-control numeric', 'id'=>'anticoag_vol_'.$numRows, 'name'=>'anticoag_vol_'.$numRows, 'required'=>'true']) !!}
                                    <span class="input-group-addon">mL</span>
                                </div>
                            </td>
							<td>
                                <div class="input-group">
                                    {!! Form::input('number', 'irr_vol_1', 0, ['class'=>'form-control numeric', 'id'=>'irr_vol_'.$numRows, 'required'=>'true']) !!}
                                    <span class="input-group-addon">mL</span>
                                </div>
                            </td>
							<td>
                                <div class="input-group">
                                    {!! Form::input('number', 'ebl_1', 0, ['class'=>'form-control numeric', 'id'=>'ebl_'.$numRows, 'required'=>'true']) !!}
                                    <span class="input-group-addon">mL</span>
                                </div>
                            </td>
							<td>
                                <div class="input-group">
                                    {!! Form::input('number', 'rbc_1', 0, ['class'=>'form-control numeric', 'id'=>'rbc_'.$numRows, 'required'=>'true']) !!}
                                    <span class="input-group-addon">mL</span>
                                </div>
                            </td>
							<td>       
                                
                                     
                                        <div class='input-group date timePicker'>                       
                                            {!! Form::text('time_1', Carbon::now()->format('H:i'), ['class'=>'form-control', 'id'=>'time_'.$numRows, 'required'=>'true']) !!}
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-time"></span>
                                            </span>
                                        </div>                      
                                    
                                
                            </td>
						</tr>					
						@endfor
					@endif						
				</tbody>
			</table>
			{!! Form::text('numRows', $numRows, ['class'=>'form-control hidden', 'id'=>'numRows', 'required'=>'true']) !!}	
		</div>			
	</div>
</div>

@section('footer')

<script>
    
    $(document).ready(function()
        {       
    
        var cloneCount=$("#numRows").val(); 
        
        if(cloneCount > 1)
        {
            if($("#removeColumnButton").is(":hidden") && cloneCount > 1 )
            {
                $("#removeColumnButton").show();
            }
        }
        
        $('#removeColumnButton').click(function()
            {
                cloneCount--;
                $("#numRows").val(cloneCount);
                $("#processingInformationTable tbody tr:last").remove();  
                
                if(cloneCount == 1)
                {
                    $(this).hide();
                }         
            });   
        
        $("#addColumnButton").click(function() {
            //debugger;
            ++cloneCount;			
            //console.log('page script');		
            var $clone = $("#processingInformationTable tbody tr:last").clone();
            $clone.children("td:first").text(cloneCount);
            //console.log($clone);
            $clone.children("td").children("div").children("input").each(function(index)
                {
                    //console.log('changing names');
                    var id = $(this).prop('id').substr(0, $(this).prop('id').lastIndexOf("_") + 1) + cloneCount;
                    //console.log('id: %c', id);			
                    var name = $(this).prop('name').substr(0, $(this).prop('name').lastIndexOf("_") + 1) + cloneCount;
                    var cssClass = "form-control numeric";
                    //console.log('name: %c', name);
                    $(this).prop('id', id);
                    $(this).prop('name', name);
                    $(this).addClass(cssClass);
                });
                        
            $("#processingInformationTable tbody").append($clone);

            // add time picker for this instance
            $('#time_' + cloneCount).datetimepicker(
                {
                widgetPositioning: { vertical: 'bottom' , horizontal: 'left'},
                    format: 'HH:mm' 
                }
            
            );
                                    
            $("#numRows").val(cloneCount);
            
            if($("#removeColumnButton").is(":hidden") && cloneCount > 1 )
            {
                $("#removeColumnButton").show();
            }	
        });
    
    });
</script>

@stop