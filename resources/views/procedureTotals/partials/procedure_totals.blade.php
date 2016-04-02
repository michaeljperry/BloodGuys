<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Enter Procedure Totals</h3>
	</div>
	<div class="panel-body">	
		<div class="form-group  table-responsive">
			
			<table class="table table-striped table-bordered table-hover" id="totals" name="totals">
				<thead>
					<tr>
						<th class="col-xs-2"></th>
						<th class="col-xs-2">Est. Blood Loss</th>		
						<th class="col-xs-2">RBC's Returned</th>
						<th class="col-xs-2">Wash Amount</th>
						<th class="col-xs-2">Visual Check &nbsp;</th>
						<th class="col-xs-2">Clerical Check</th>	
					</tr>
				</thead>
				<tbody>
					
					<tr>
						<td>OR</td>	
						<td>
                            <div class="input-group" style="width: 150px;">
                                {!! Form::input('number', 'ebl_or', $default, ['class'=>'form-control numeric calculateTotal', 'id'=>'ebl_or', 'placeholder'=>'"default"', 'required'=>'true','step'=>'0.01']) !!}
                                <span class="input-group-addon">mL</span>
                            </div>
                        </td>
						<td>
                            <div class="input-group" style="width: 150px;">
                                {!! Form::input('number','rbc_returned_or', $default, ['class'=>'form-control numeric calculateTotal', 'id'=>'rbc_returned_or', 'placeholder'=>'"default"', 'required'=>'true','step'=>'0.01']) !!}
                                <span class="input-group-addon">mL</span>
                            </div>
                        </td>
						<td>
                            <div class="input-group" style="width: 150px;">
                                {!! Form::input('number', 'wash_amount_or', $default, ['class'=>'form-control numeric calculateTotal', 'id'=>'wash_amount_or', 'placeholder'=>'"default"', 'required'=>'true','step'=>'0.01']) !!}
                                <span class="input-group-addon">mL</span>
                            </div>
                        </td>
						<td>
							{!! Form::buttonToggle([['id'=>'VCYes', 'value'=>1, 'text'=>'Yes'],['id'=>'VCNo', 'value'=>0, 'text'=>'No']], 'vc_or', 'VisualCheck_or') !!}						
						</td>
						<td>
							{!! Form::buttonToggle([['id'=>'CCYes', 'value'=>1, 'text'=>'Yes'],['id'=>'CCNo', 'value'=>0, 'text'=>'No']], 'cc_or', 'ClericalCheck_or') !!}							
						</td>					 
					</tr>						
						
					<tr>
						<td>Post-Op</td>
						<td>
                            <div class="input-group" style="width: 150px;">
                                {!! Form::input('number','ebl_po', $default, ['class'=>'form-control numeric calculateTotal', 'id'=>'ebl_po', 'placeholder'=>'"default"', 'required'=>'true','step'=>'0.01']) !!}
                               <span class="input-group-addon">mL</span>
                            </div> 
                        </td>
						<td>
                            <div class="input-group" style="width: 150px;">    
                                {!! Form::input('number','rbc_returned_po', $default, ['class'=>'form-control numeric calculateTotal', 'id'=>'rbc_returned_po', 'placeholder'=>'"default"', 'required'=>'true','step'=>'0.01']) !!}
                                <span class="input-group-addon">mL</span>
                            </div>
                        </td>
						<td>
                            <div class="input-group" style="width: 150px;">
                                {!! Form::input('number','wash_amount_po', $default, ['class'=>'form-control numeric calculateTotal', 'id'=>'wash_amount_po', 'placeholder'=>'"default"', 'required'=>'true','step'=>'0.01']) !!}
                                <span class="input-group-addon">mL</span>
                            </div>
                        </td>
						<td>
							{!! Form::buttonToggle([['id'=>'VCYes', 'value'=>1, 'text'=>'Yes'],['id'=>'VCNo', 'value'=>0, 'text'=>'No']], 'vc_po', 'VisualCheck_po') !!}						
						</td>
						<td>
							{!! Form::buttonToggle([['id'=>'CCYes', 'value'=>1, 'text'=>'Yes'],['id'=>'CCNo', 'value'=>0, 'text'=>'No']], 'cc_po', 'ClericalCheck_po') !!}							
						</td>
					</tr>
					
					<tr>
						<td>Post-Op 2</td>
						<td>
                            <div class="input-group" style="width: 150px;">
                                {!! Form::input('number','ebl_po2', $default, ['class'=>'form-control numeric calculateTotal', 'id'=>'ebl_po2', 'placeholder'=>'"default"', 'required'=>'true', 'step'=>'0.01']) !!}
                                <span class="input-group-addon">mL</span>
                            </div>   
                        </td>
						<td>
                            <div class="input-group" style="width: 150px;">
                                {!! Form::input('number','rbc_returned_po2', $default, ['class'=>'form-control numeric calculateTotal', 'id'=>'rbc_returned_po2', 'placeholder'=>'"default"', 'required'=>'true','step'=>'0.01']) !!}
                                <span class="input-group-addon">mL</span>
                            </div>
                        </td>
						<td>
                            <div class="input-group" style="width: 150px;">
                                {!! Form::input('number','wash_amount_po2', $default, ['class'=>'form-control numeric calculateTotal', 'id'=>'wash_amount_po2', 'placeholder'=>'"default"', 'required'=>'true','step'=>'0.01']) !!}
                                <span class="input-group-addon">mL</span>
                            </div>
                        </td>
						<td>
							{!! Form::buttonToggle([['id'=>'VCYes', 'value'=>1, 'text'=>'Yes'],['id'=>'VCNo', 'value'=>0, 'text'=>'No']], 'vc_po2', 'VisualCheck_po2') !!}						
						</td>
						<td>
							{!! Form::buttonToggle([['id'=>'CCYes', 'value'=>1, 'text'=>'Yes'],['id'=>'CCNo', 'value'=>0, 'text'=>'No']], 'cc_po2', 'ClericalCheck_po2') !!}							
						</td>
					</tr>					
				</tbody>
				<tfoot>
					<tr>
						<td>Totals</td>
						<td>
                            <div class="input-group" style="width: 150px;">
                                {!! Form::text('ebl_total', $default, ['class'=>'form-control', 'id'=>'ebl_total', 'readonly', 'placeholder'=>'"default"', 'required'=>'true']) !!}
                                <span class="input-group-addon">mL</span>
                            </div>    
                            </td>
						<td>
                            <div class="input-group" style="width: 150px;">    
                                {!! Form::text('rbc_returned_total', $default, ['class'=>'form-control', 'id'=>'rbc_returned_total', 'readonly', 'placeholder'=>'"default"', 'required'=>'true']) !!}
                                <span class="input-group-addon">mL</span>
                            </div>    
                        </td>
						<td>
                            <div class="input-group" style="width: 150px;">
                                {!! Form::text('wash_amount_total', $default, ['class'=>'form-control', 'id'=>'wash_amount_total', 'readonly', 'placeholder'=>'"default"', 'required'=>'true']) !!}
                                <span class="input-group-addon">mL</span>
                            </div>    
                        </td>
					</tr>
				</tfoot>
			</table>		
		</div>			
	</div>
</div>
@section('footer')
<script>
	$(".calculateTotal").blur(function()
		{
			$("#ebl_total").val(sumOfColumns("totals", 2, false));
			$("#rbc_returned_total").val(sumOfColumns("totals", 3, false));
			$("#wash_amount_total").val(sumOfColumns("totals", 4, false));	
		});
		
	function sumOfColumns(tableID, columnIndex, hasHeader) 
	{
		var tot = 0;
		$("#" + tableID + " tbody tr" + (hasHeader ? ":gt(0)" : ""))
		.children("td:nth-child(" + columnIndex + ")")
		.each(function() 
		{
			var value = parseFloat($(this).find("input").val());			
			tot += (isNaN(value) ? 0.00: value);
  		});
		
  		return tot;
	}
</script>
@stop