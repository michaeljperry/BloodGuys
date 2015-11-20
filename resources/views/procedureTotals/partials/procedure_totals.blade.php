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
						<td>{!! Form::text('ebl_or', $default, ['class'=>'form-control', 'id'=>'ebl_or', 'placeholder'=>'"default"']) !!}</td>
						<td>{!! Form::text('rbc_returned_or', $default, ['class'=>'form-control', 'id'=>'rbc_returned_or', 'placeholder'=>'"default"']) !!}</td>
						<td>{!! Form::text('wash_amount_or', $default, ['class'=>'form-control', 'id'=>'wash_amount_or', 'placeholder'=>'"default"']) !!}</td>
						<td>
							{!! Form::buttonToggle([['id'=>'VCYes', 'value'=>1, 'text'=>'Yes'],['id'=>'VCNo', 'value'=>$default, 'text'=>'No']], 'vc_or', 'VisualCheck_or') !!}						
						</td>
						<td>
							{!! Form::buttonToggle([['id'=>'CCYes', 'value'=>1, 'text'=>'Yes'],['id'=>'CCNo', 'value'=>$default, 'text'=>'No']], 'cc_or', 'ClericalCheck_or') !!}							
						</td>					 
					</tr>						
						
					<tr>
						<td>Post-Op</td>
						<td>{!! Form::text('ebl_po', $default, ['class'=>'form-control', 'id'=>'ebl_po', 'placeholder'=>'"default"']) !!}</td>
						<td>{!! Form::text('rbc_returned_po', $default, ['class'=>'form-control', 'id'=>'rbc_returned_po', 'placeholder'=>'"default"']) !!}</td>
						<td>{!! Form::text('wash_amount_po', $default, ['class'=>'form-control', 'id'=>'wash_amount_po', 'placeholder'=>'"default"']) !!}</td>
						<td>
							{!! Form::buttonToggle([['id'=>'VCYes', 'value'=>1, 'text'=>'Yes'],['id'=>'VCNo', 'value'=>$default, 'text'=>'No']], 'vc_po', 'VisualCheck_po') !!}						
						</td>
						<td>
							{!! Form::buttonToggle([['id'=>'CCYes', 'value'=>1, 'text'=>'Yes'],['id'=>'CCNo', 'value'=>$default, 'text'=>'No']], 'cc_po', 'ClericalCheck_po') !!}							
						</td>
					</tr>
					
					<tr>
						<td>Post-Op 2</td>
						<td>{!! Form::text('ebl_po2', $default, ['class'=>'form-control', 'id'=>'ebl_po2', 'placeholder'=>'"default"']) !!}</td>
						<td>{!! Form::text('rbc_returned_po2', $default, ['class'=>'form-control', 'id'=>'rbc_returned_po2', 'placeholder'=>'"default"']) !!}</td>
						<td>{!! Form::text('wash_amount_po2', $default, ['class'=>'form-control', 'id'=>'wash_amount_po2', 'placeholder'=>'"default"']) !!}</td>
						<td>
							{!! Form::buttonToggle([['id'=>'VCYes', 'value'=>1, 'text'=>'Yes'],['id'=>'VCNo', 'value'=>$default, 'text'=>'No']], 'vc_po2', 'VisualCheck_po2') !!}						
						</td>
						<td>
							{!! Form::buttonToggle([['id'=>'CCYes', 'value'=>1, 'text'=>'Yes'],['id'=>'CCNo', 'value'=>$default, 'text'=>'No']], 'cc_po2', 'ClericalCheck_po2') !!}							
						</td>
					</tr>					
				</tbody>
				<tfoot>
					<tr>
						<td>Totals</td>
						<td>{!! Form::text('ebl_total', $default, ['class'=>'form-control', 'id'=>'ebl_total', 'readonly', 'placeholder'=>'"default"']) !!}</td>
						<td>{!! Form::text('rbc_returned_total', $default, ['class'=>'form-control', 'id'=>'rbc_returned_total', 'readonly', 'placeholder'=>'"default"']) !!}</td>
						<td>{!! Form::text('wash_amount_total', $default, ['class'=>'form-control', 'id'=>'wash_amount_total', 'readonly', 'placeholder'=>'"default"']) !!}</td>
					</tr>
				</tfoot>
			</table>		
		</div>			
	</div>
</div>

<script>
	$(this).keyup(function()
		{
			$("#ebl_total").val(sumOfColumns("totals", 2, false));
			$("#rbc_returned_total").val(sumOfColumns("totals", 3, false));
			$("#wash_amount_total").val(sumOfColumns("totals", 4, false));	
		});
		
	function sumOfColumns(tableID, columnIndex, hasHeader) 
	{
		var tot = $default
		$("#" + tableID + " tbody tr" + (hasHeader ? ":gt($default)" : ""))
		.children("td:nth-child(" + columnIndex + ")")
		.each(function() 
		{
			var value = parseInt($(this).find("input").val());			
			tot += (isNaN(value) ? $default: value);
  		});
		
  		return tot;
	}
</script>