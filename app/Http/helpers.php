<?php

use Illuminate\Html\FormBuilder;
use App\Models\Invoice;
use App\Models\InvoiceSection;	
use App\Http\Requests;
use Illuminate\Http\Request;
//use ChromePhp;


function delete_form($routeParams, $label = 'Delete')
{
	$form = Form::open(['method' => 'DELETE', 'route' => $routeParams]);
	$form .= Form::submit($label, ['class'=>'btn btn-danger']);
	return $form .= Form::close();
}

function delete_glyph_icon($routeParams, $glyphIcon = 'glyphicon-trash')
{	
	$form = Form::open(['method' => 'DELETE', 'route' => $routeParams]);
	
	$form .= '<button type="submit" class = "btn btn-danger"><span class="glyphicon '.$glyphIcon.'" aria-hidden="true"/></button>';
			
	return $form .= Form::close();
}

/**
* Creates a button toggle element with div.
*
* @param array $buttons
* @param string $buttonGroupName
* @param $divName
* @return $string
*/
FormBuilder::macro('buttonToggle', function ($buttons, $buttonGroupName, $divName)
{	
	$html = array();
	
	$div = '<div class="btn-group" data-toggle="buttons" name="' .$divName. '" id="' .$divName. '">';
		
	$label = '<label class="btn btn-primary">';
	foreach($buttons as $button)
	{		
		$inputOptions['id'] = $button['id'];
		$input = $this->input('radio', $buttonGroupName, $button['value'], $inputOptions);
		$html[] = $label.$input.$button['text'].'</label>';  
	}
			
	return $div.implode('', $html).'</div>';
});

/**
* Creates a binary column with a unique index. The unique index name is $tablename_$columnName_unique.
* @param string $tableName
* @param string $columnName
* @param integer $numberOfBytes
* @param string $afterColumn

function AddBinaryColumn($tableName, $columnName, $numberOfBytes, $afterColumn, $addIndex = true)
{
	DB::statement('ALTER TABLE '.$tableName.' ADD '.$columnName.' BINARY('.$numberOfBytes.') NOT NULL AFTER '.$afterColumn.';');
	
	if($addIndex)
	{
		DB::statement('CREATE UNIQUE INDEX '.$tableName.'_'.$columnName.'_unique ON '.$tableName.' ('.$columnName.');');
	}
}
*/
/**
* Drops a binary column with a unique index. The index that is dropped is $tableName_$columnName_unique.
* @param string $tableName
* @param string $columnName

function DropBinaryColumn($tableName, $columnName, $dropIndex = true)
{
	if($dropIndex)
	{
		DB::statement('DROP INDEX '.$tableName.'_'.$columnName.'_unique ON '.$tableName.';');	
	}
	
	DB::statement('ALTER TABLE '.$tableName.' DROP '.$columnName.';');
}
*/

function CompleteInvoiceSection($invoice_id, $invoice_section_id)
{
	Invoice::find($invoice_id)->invoiceSections()->updateExistingPivot($invoice_section_id, ['completed'=>1]);
}

function RedirectToInvoicesIndex()
{
	$invoices = Invoice::with('hospital')->get();
	return redirect()->route('invoices.index', ['invoices'=>$invoices]);
}

function EditInvoiceSection($model, $invoice, $invoice_section, $parameters=array())
{	
	$parameters['model'] = $model;        
	$parameters['invoice_section'] = $invoice_section;				        
	Session::put('current_process_step', $invoice_section->process_step);
	
	$previous_step_url = route('previousProcessStep', ['invoice_id'=>$invoice->id]);
			
	$parameters['previous_step_url'] = $previous_step_url;	
	$parameters['invoice'] = $invoice;
	return view('invoices.editTemplate', $parameters);
}

function GetProcessStep($process_step)
{	
	return InvoiceSection::where('process_step', '=', $process_step)->first();
}

/*
function GetNextProcessStep($current_process_step)
{
	// increment the current process step
	$current_process_step++;
	
	// get the next process step
	return GetProcessStep($current_process_step);
}

function GetPreviousProcessStep($current_process_step)
{
	// decrement the current process step
	$current_process_step--;
	
	// get the previous process step
	return GetProcessStep($current_process_step);
}
*/

//keep
function GetProcessStepUrl($invoice_id, $process_step)
{
	$invoice = Invoice::find($invoice_id);
		
	$step = $invoice->invoiceSections->filter(function($item) use ($process_step) {
		return $item->process_step == $process_step;
	})->first();
	
	$step_url = null;
	
	if($step != null)
	{
		$urlParameters = array('invoice_id' => $invoice->id, 'invoice_section_id' => $step->id);
		$step_url = action($step->edit_url, $urlParameters);
		
		if($step->pivot->completed == 0)
		{
			$step_url = route($step->create_url, ['invoice_id'=>$invoice->id]);	
		}	
	}
	
	return $step_url;
}

// Keep
function DisplayProcessStep($invoice_id, $parameters = array())
{	
	// Get the current process step
	$current_process_step = Session::get('current_process_step');
	ChromePhp::log('current process step: '.$current_process_step);			
	$current_step = GetProcessStep($current_process_step);
	
	$previous_step_url = null;
	
	if($invoice_id != 'New Invoice')
	{
		//$previous_step_url = GetProcessStepUrl($invoice_id, $current_step->process_step - 1);
		$previous_step_url = route('previousProcessStep', ['invoice_id'=>$invoice_id]);	
	}	
	
	ChromePhp::log('Adding parameters');
	// add common parameters
	$parameters['invoice_id'] = $invoice_id;
	$parameters['current_step'] = $current_step;	
	$parameters['previous_step_url'] = $previous_step_url;
	
	ChromePhp::log('returning invoices.create');
	return view('invoices.create', $parameters);	
}


// New Methods!!!!
function SetupProcessStep($invoice_id, $process_step)
{		
	// Save Process Step
	Session::put('current_process_step', $process_step);
	
	// Setup Process Step
	//$current_process_step = Session::get('current_process_step');
	$invoice = Invoice::find($invoice_id);
	$first_step = InvoiceSection::min('process_step');
	
			
	if($invoice == null && $process_step == $first_step)
	{			
		$current_process_step = GetProcessStep($process_step);	
		return redirect()->route($current_process_step->create_url, array('invoice_id' => 'New Invoice'));
	}
			
	$url = GetProcessStepUrl($invoice->id, $process_step);
	
	return redirect($url);
}

function NextProcessStep($invoice_id)
{				
	$current_process_step = Session::get('current_process_step');
	$last_step = InvoiceSection::max('process_step');
	
	if($current_process_step == $last_step)
	{
		// Complete invoice (should be moved to complete invoice section)
		$invoice = Invoice::find($invoice_id);		
		$invoice->completed = true;
		$invoice->save();
		
		// Set Flash Message that invoice with id was successfully saved.
		
		// Get all invoices
		$invoices = Invoice::all();		
		return view('invoices.index', compact('invoices'));	
	}
	
	return SetupProcessStep($invoice_id, $current_process_step + 1);
}
