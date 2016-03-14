<style>
        
    /* The total progress gets shown by event listeners */
    #total-progress {
      opacity: 0;
      transition: opacity 0.3s linear;
    }

    /* Hide the progress bar when finished */
    #previews .file-row.dz-success .progress {
      opacity: 0;
      transition: opacity 0.3s linear;
    }

    /* Hide the delete button initially */
    #previews .file-row .delete {
      display: none;
    }

    /* Hide the start and cancel buttons and show the delete button */

    #previews .file-row.dz-success .start,
    #previews .file-row.dz-success .cancel {
      display: none;
    }
    #previews .file-row.dz-success .delete {
      display: block;
    }


  </style>
  
  
<div class="panel panel-primary" id = "additionalSuppliesPanel">
	<div class="panel-heading">
		<h3 class="panel-title">Autotransfusion Supplies</h3>
	</div>
	<div class="panel-body">	
		<div class="form-group  table-responsive">				
			<table class="table table-striped table-bordered table-hover" id="additional_supplies" name="additional_supplies">
				<thead>
					<tr>
						<th class="col-xs-2"></th>
						<th class="col-xs-2">Manufacturer</th>		
						<th class="col-xs-2">Product Id Number</th>
						<th class="col-xs-2">Quantity</th>
						<th class="col-xs-2">Charge</th>						
						<th class="col-xs-2">Total</th>							
					</tr>
				</thead>
				<tbody>
					
					<tr>
						<td>Wash Kit</td>	
						<td>{!! Form::text('wash_kit_manufacturer', $manufacturerDefault, ['class'=>'form-control', 'id'=>'wash_kit_manufacturer']) !!}</td>
						<td>{!! Form::text('wash_kit_product_id_number', $productIdDefault, ['class'=>'form-control', 'id'=>'wash_kit_product_id_number']) !!}</td>
						<td>{!! Form::input('number', 'wash_kit_quantity', $default, ['class'=>'form-control numeric', 'id'=>'wash_kit_quantity']) !!}</td>
						<td>{!! Form::input('number', 'wash_kit_charge', $default, ['class'=>'form-control charge numeric', 'id'=>'wash_kit_charge']) !!}</td>
						<td>{!! Form::text('wash_kit_total', $default, ['class'=>'form-control total', 'id'=>'wash_kit_total', 'readonly']) !!}</td>											 
					</tr>						
						
					<tr>
						<td>Reservoir</td>
						<td>{!! Form::text('reservoir_manufacturer', $manufacturerDefault, ['class'=>'form-control', 'id'=>'reservoir_manufacturer']) !!}</td>
						<td>{!! Form::text('reservoir_product_id_number', $productIdDefault, ['class'=>'form-control', 'id'=>'reservoir_product_id_number']) !!}</td>
						<td>{!! Form::input('number', 'reservoir_quantity', $default, ['class'=>'form-control numeric', 'id'=>'reservoir_quantity']) !!}</td>
						<td>{!! Form::input('number', 'reservoir_charge', $default, ['class'=>'form-control charge numeric', 'id'=>'reservoir_charge']) !!}</td>
						<td>{!! Form::text('reservoir_total', $default, ['class'=>'form-control total', 'id'=>'reservoir_total', 'readonly']) !!}</td>						
					</tr>	
					
					<tr>
						<td>Aspiration Assembly</td>	
						<td>{!! Form::text('aspiration_assembly_manufacturer', $manufacturerDefault, ['class'=>'form-control', 'id'=>'aspiration_assembly_manufacturer']) !!}</td>
						<td>{!! Form::text('aspiration_assembly_product_id_number', $productIdDefault, ['class'=>'form-control', 'id'=>'aspiration_assembly_product_id_number']) !!}</td>
						<td>{!! Form::input('number', 'aspiration_assembly_quantity', $default, ['class'=>'form-control numeric', 'id'=>'aspiration_assembly_quantity']) !!}</td>
						<td>{!! Form::input('number', 'aspiration_assembly_charge', $default, ['class'=>'form-control charge numeric', 'id'=>'aspiration_assembly_charge']) !!}</td>
						<td>{!! Form::text('aspiration_assembly_total', $default, ['class'=>'form-control total', 'id'=>'aspiration_assembly_total', 'readonly']) !!}</td>											 
					</tr>						
						
					<tr>
						<td>Blood Bag</td>
						<td>{!! Form::text('blood_bag_manufacturer', $manufacturerDefault, ['class'=>'form-control', 'id'=>'blood_bag_manufacturer']) !!}</td>
						<td>{!! Form::text('blood_bag_product_id_number', $productIdDefault, ['class'=>'form-control', 'id'=>'blood_bag_product_id_number']) !!}</td>
						<td>{!! Form::input('number', 'blood_bag_quantity', $default, ['class'=>'form-control numeric', 'id'=>'blood_bag_quantity']) !!}</td>
						<td>{!! Form::input('number', 'blood_bag_charge', $default, ['class'=>'form-control charge numeric', 'id'=>'blood_bag_charge']) !!}</td>
						<td>{!! Form::text('blood_bag_total', $default, ['class'=>'form-control total', 'id'=>'blood_bag_total', 'readonly']) !!}</td>						
					</tr>
					
					<tr>
						<td>Vacuum Tubing</td>	
						<td>{!! Form::text('vacuum_tubing_manufacturer', $manufacturerDefault, ['class'=>'form-control', 'id'=>'vacuum_tubing_manufacturer']) !!}</td>
						<td>{!! Form::text('vacuum_tubing_product_id_number', $productIdDefault, ['class'=>'form-control', 'id'=>'vacuum_tubing_product_id_number']) !!}</td>
						<td>{!! Form::input('number', 'vacuum_tubing_quantity', $default, ['class'=>'form-control numeric', 'id'=>'vacuum_tubing_quantity']) !!}</td>
						<td>{!! Form::input('number', 'vacuum_tubing_charge', $default, ['class'=>'form-control charge numeric', 'id'=>'vacuum_tubing_charge']) !!}</td>
						<td>{!! Form::text('vacuum_tubing_total', $default, ['class'=>'form-control total', 'id'=>'vacuum_tubing_total', 'readonly']) !!}</td>											 
					</tr>						
						
					<tr>
						<td>Wound Drain</td>
						<td>{!! Form::text('wound_drain_manufacturer', $manufacturerDefault, ['class'=>'form-control', 'id'=>'wound_drain_manufacturer']) !!}</td>
						<td>{!! Form::text('wound_drain_product_id_number', $productIdDefault, ['class'=>'form-control', 'id'=>'wound_drain_product_id_number']) !!}</td>
						<td>{!! Form::input('number', 'wound_drain_quantity', $default, ['class'=>'form-control numeric', 'id'=>'wound_drain_quantity']) !!}</td>
						<td>{!! Form::input('number', 'wound_drain_charge', $default, ['class'=>'form-control charge numeric', 'id'=>'wound_drain_charge']) !!}</td>
						<td>{!! Form::text('wound_drain_total', $default, ['class'=>'form-control total', 'id'=>'wound_drain_total', 'readonly']) !!}</td>						
					</tr>
					
					<tr>
						<td>Y Connector</td>	
						<td>{!! Form::text('y_connector_manufacturer', $manufacturerDefault, ['class'=>'form-control', 'id'=>'y_connector_manufacturer']) !!}</td>
						<td>{!! Form::text('y_connector_product_id_number', $productIdDefault, ['class'=>'form-control', 'id'=>'y_connector_product_id_number']) !!}</td>
						<td>{!! Form::input('number', 'y_connector_quantity', $default, ['class'=>'form-control numeric', 'id'=>'y_connector_quantity']) !!}</td>
						<td>{!! Form::input('number', 'y_connector_charge', $default, ['class'=>'form-control charge numeric', 'id'=>'y_connector_charge']) !!}</td>
						<td>{!! Form::text('y_connector_total', $default, ['class'=>'form-control total', 'id'=>'y_connector_total', 'readonly']) !!}</td>											 
					</tr>						
						
					<tr>
						<td>Blood Filter</td>
						<td>{!! Form::text('blood_filter_manufacturer', $manufacturerDefault, ['class'=>'form-control', 'id'=>'blood_filter_manufacturer']) !!}</td>
						<td>{!! Form::text('blood_filter_product_id_number', $productIdDefault, ['class'=>'form-control', 'id'=>'blood_filter_product_id_number']) !!}</td>
						<td>{!! Form::input('number', 'blood_filter_quantity', $default, ['class'=>'form-control numeric', 'id'=>'blood_filter_quantity']) !!}</td>
						<td>{!! Form::input('number', 'blood_filter_charge', $default, ['class'=>'form-control charge numeric', 'id'=>'blood_filter_charge']) !!}</td>
						<td>{!! Form::text('blood_filter_total', $default, ['class'=>'form-control total', 'id'=>'blood_filter_total', 'readonly']) !!}</td>						
					</tr>								
					
					<tr>
						<td>ACDA (500 ML Bag)</td>	
						<td>{!! Form::text('acda_bag_manufacturer', $manufacturerDefault, ['class'=>'form-control', 'id'=>'acda_bag_manufacturer']) !!}</td>
						<td>{!! Form::text('acda_bag_product_id_number', $productIdDefault, ['class'=>'form-control', 'id'=>'acda_bag_product_id_number']) !!}</td>
						<td>{!! Form::input('number', 'acda_bag_quantity', $default, ['class'=>'form-control numeric', 'id'=>'acda_bag_quantity']) !!}</td>
						<td>{!! Form::input('number', 'acda_bag_charge', $default, ['class'=>'form-control charge numeric', 'id'=>'acda_bag_charge']) !!}</td>
						<td>{!! Form::text('acda_bag_total', $default, ['class'=>'form-control total', 'id'=>'acda_bag_total', 'readonly']) !!}</td>											 
					</tr>						
						
					<tr>
						<td>Misc</td>
						<td>{!! Form::text('misc_manufacturer', $manufacturerDefault, ['class'=>'form-control', 'id'=>'misc_manufacturer']) !!}</td>
						<td>{!! Form::text('misc_product_id_number', $productIdDefault, ['class'=>'form-control', 'id'=>'misc_product_id_number']) !!}</td>
						<td>{!! Form::input('number', 'misc_quantity', $default, ['class'=>'form-control numeric', 'id'=>'misc_quantity']) !!}</td>
						<td>{!! Form::input('number', 'misc_charge', $default, ['class'=>'form-control charge numeric', 'id'=>'misc_charge']) !!}</td>
						<td>{!! Form::text('misc_total', $default, ['class'=>'form-control total', 'id'=>'misc_total', 'readonly']) !!}</td>						
					</tr>		
					<tr>
						<td>Total Supplies Charge</td>
						<td colspan=4/>
						<td>{!! Form::text('supplies_total', $default, ['class'=>'form-control', 'readonly', 'id'=>'supplies_total']) !!}</td>
					</tr>
                    <tr>
						<td>Total Invoice Charge</td>
						<td colspan=4/>
						<td>{!! Form::text('total_invoice_charge', $invoiceTotalCharges, ['class'=>'form-control', 'readonly', 'id'=>'total_invoice_charge']) !!}</td>
					</tr>						
				</tbody>
			</table>		
		</div>				
	</div>
</div>

<div class="panel panel-primary" id = "files">
	<div class="panel-heading">
		<h3 class="panel-title">Upload Files</h3>
	</div>
	<div class="panel-body">	
		<div id="actions" class="row">

			<div class="col-lg-4">
				<!-- The fileinput-button span is used to style the file input field as button -->
				<span class="btn btn-success fileinput-button">
					<i class="glyphicon glyphicon-plus"></i>
					<span>Add files...</span>
				</span>        
				<button type="reset" class="btn btn-warning cancel">
					<i class="glyphicon glyphicon-ban-circle"></i>
					<span>Cancel upload</span>
				</button>
			</div>

			<div class="col-lg-4">
				<!-- The global file processing state -->
				<span class="fileupload-process">
				<div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
					<div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
				</div>
				</span>
			</div>
    	</div>


		<!-- HTML heavily inspired by http://blueimp.github.io/jQuery-File-Upload/ -->
		<div class="table table-striped" class="files" id="previews">
			<div id="template" class="file-row">
				<!-- This is used as the file preview template -->
				<div>
					<span class="preview"><img data-dz-thumbnail /></span>
				</div>
				<div>
					<p class="name" data-dz-name></p>
					<strong class="error text-danger" data-dz-errormessage></strong>
				</div>
				<div>
					<p class="size" data-dz-size></p>
					<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
						<div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
					</div>
				</div>
				<div>
					<button data-dz-remove class="btn btn-warning cancel">
						<i class="glyphicon glyphicon-ban-circle"></i>
						<span>Cancel</span>
					</button>
					<button data-dz-remove class="btn btn-danger delete">
						<i class="glyphicon glyphicon-trash"></i>
						<span>Delete</span>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
@section('footer')

<script>

// Get the template HTML and remove it from the document
var previewNode = document.querySelector("#template");
previewNode.id = "";
var previewTemplate = previewNode.parentNode.innerHTML;
previewNode.parentNode.removeChild(previewNode);

var myDropzone = new Dropzone("#actions", {
  url: "{{route('uploadFiles')}}", 
  maxFilesize: 2,
  previewsContainer: "#previews",
  clickable: ".fileinput-button",
  previewTemplate: previewTemplate,
  dictDefaultMessage: "",
  parallelUploads: 2,
  maxFiles: 6
});
    // Update the total progress bar
    myDropzone.on("totaluploadprogress", function(progress) {		
      document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
    });
    
    myDropzone.on("sending", function(file, xhr, formData) {
      // Show the total progress bar when upload starts
	  var invoice_id = null;
	  if($("input[name=invoice_id]").val()  != null)
	  {
	  	invoice_id = $("input[name=invoice_id]").val();
	  }
	  else
	  {	
		  <?php 
		  	if(!isset($model))
			  {
				  $model = (object)array('invoice_id'=>0);
				 
			  }
			?>	  			
		  invoice_id = <?php echo ($model->invoice_id); ?>;
	  }
	  
	  document.querySelector("#total-progress").style.opacity = "1";
      formData.append("_token", $("input[name=_token]").val());
	  formData.append("invoice_id", invoice_id);
    });
    
    // Hide the total progress bar when nothing's uploading anymore
    myDropzone.on("queuecomplete", function(progress) {		
      document.querySelector("#total-progress").style.opacity = "0";
    });   


// Setup the buttons for all transfers
// The "add files" button doesn't need to be setup because the config
// `clickable` has already been specified.
document.querySelector("#actions .cancel").onclick = function() {
  myDropzone.removeAllFiles(true);
};	

// Calculate grand total
$(".charge").blur(function() {
	
    updateTotals();    
});

function updateTotals()
{
    var servicesTotal = getServicesTotal();   
    
    // calculate new supplies total
    var sum = 0;
	$(".total").each(function() {
		sum += Number($(this).val());
	});
	
    // set supplies total        
	$("#supplies_total").val(sum);   
    
    setInvoiceTotal(servicesTotal, sum);
}

function getServicesTotal()
{
    // calculate services total
    var invoiceTotal = Number($("#total_invoice_charge").val());
    var suppliesTotal = Number($("#supplies_total").val());  
    var servicesTotal = invoiceTotal - suppliesTotal;
    return servicesTotal; 
}

function setInvoiceTotal(servicesTotal, suppliesTotal)
{
    // set invoice total
    var total = servicesTotal + suppliesTotal;
    $("#total_invoice_charge").val(total);
}

$(this).keyup(function()
{    			
    $("#wash_kit_total").val( $("#wash_kit_quantity").val() * $("#wash_kit_charge").val() );
    $("#reservoir_total").val( $("#reservoir_quantity").val() * $("#reservoir_charge").val() );
    $("#aspiration_assembly_total").val( $("#aspiration_assembly_quantity").val() * $("#aspiration_assembly_charge").val() );
    $("#blood_bag_total").val( $("#blood_bag_quantity").val() * $("#blood_bag_charge").val() );
    $("#vacuum_tubing_total").val( $("#vacuum_tubing_quantity").val() * $("#vacuum_tubing_charge").val() );
    $("#wound_drain_total").val( $("#wound_drain_quantity").val() * $("#wound_drain_charge").val() );
    $("#y_connector_total").val( $("#y_connector_quantity").val() * $("#y_connector_charge").val() );
    $("#blood_filter_total").val( $("#blood_filter_quantity").val() * $("#blood_filter_charge").val() );
    $("#acda_bag_total").val( $("#acda_bag_quantity").val() * $("#acda_bag_charge").val() );
    $("#misc_total").val( $("#misc_quantity").val() * $("#misc_charge").val() );
    
    updateTotals();						
});

	
</script>


@stop