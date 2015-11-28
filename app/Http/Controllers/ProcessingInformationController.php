<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Session;
use App\Models\ProcessingInformation;
use App\Models\Invoice;
use App\Models\InvoiceSection;

class ProcessingInformationController extends Controller {
	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		return view('procedureTotals.create');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
		$invoice_id = $request['invoice_id'];		
		$parameters = array('numRows'=>1);
		
		return DisplayProcessStep($invoice_id, $parameters);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//
		$invoice_id = $request['invoice_id'];
				
		$numRows = $request["numRows"];
		
		for($index = 1; $index <= $numRows; $index++)
		{
			$record = new ProcessingInformation;
			
			$record->column_id = $index;
			$record->amount_processed = $request["amt_processed_".$index];
			$record->anticoagulent_volume = $request["anticoag_vol_".$index];			
			$record->irrigation_volume = $request["irr_vol_".$index];
			$record->ebl = $request["ebl_".$index];
			$record->rbcs_salvaged = $request["rbc_".$index];
			$record->time = $request["time_".$index];
			$record->invoice_id = $invoice_id;
			$record->save();			
		}
				
		// Update the section information for this invoice
		CompleteInvoiceSection($invoice_id, 6);
		
		// Setup next view		        
        return NextProcessStep($invoice_id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	public function editInvoice(Invoice $invoice, InvoiceSection $invoiceSection)
	{
		$model = $invoice;				
		$numRows = $model->processingInformation->count();
		
		$parameters = array('numRows'=>$numRows, 'processingInformation' => $model->processingInformation);
								
		return EditInvoiceSection($model, $invoice, $invoiceSection, $parameters);	
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
	{
			
		$numRows = $request["numRows"];
		
		for($index = 1; $index <= $numRows; $index++)
		{		
			$record->column_id = $index;
			$record->amount_processed = $request["amt_processed_".$index];
			$record->anticoagulent_volume = $request["anticoag_vol_".$index];			
			$record->irrigation_volume = $request["irr_vol_".$index];
			$record->ebl = $request["ebl_".$index];
			$record->rbcs_salvaged = $request["rbc_".$index];
			$record->time = $request["time_".$index];
			$record->invoice_id = $invoice_id;
			$record->update();			
		}
	}
	
	public function updateProcessingInformation(Invoice $invoice, Request $request)
	{
		//$record = $invoice->processingInformation()->where('column_id', '=', 1)->first();
				
		$numRows = $request["numRows"];
		
		for($index = 1; $index <= $numRows; $index++)
		{
			$record = $invoice->processingInformation()->where('column_id', '=', $index)->first();		
			$record->amount_processed = $request["amt_processed_".$index];
			$record->anticoagulent_volume = $request["anticoag_vol_".$index];			
			$record->irrigation_volume = $request["irr_vol_".$index];
			$record->ebl = $request["ebl_".$index];
			$record->rbcs_salvaged = $request["rbc_".$index];
			$record->time = $request["time_".$index];			
			$record->save();			
		}		
		
		if($_POST['action'] == 'Continue')
        {
            return NextProcessStep($invoice->id);
        }
        else
        {
            return RedirectToInvoicesIndex();
        }           
		
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
