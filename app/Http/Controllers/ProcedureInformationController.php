<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\ProcedureInformation;
use App\Models\Invoice;
use App\Models\InvoiceSection;
use Session;
use Carbon\Carbon;

class ProcedureInformationController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
		$invoice_id = $request['invoice_id'];
		$wash_time = Carbon::now();
		$parameters = array('wash_time'=>$wash_time);
		return DisplayProcessStep($invoice_id, $parameters);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		// Get information from the form
		$invoice_id = $request['invoice_id'];		
		$physician_order = $request['physician_order'];
		$method_group = $request['method_group'];
		$procedure = $request['procedure'];
		$operation_start_time = $request['operation_start_time'];
		$collection_start_time = $request['collection_start_time'];
		$operation_end_time = $request['operation_end_time'];
		$wash_time = $request['wash_time'];
						
		$procedureInfo = ProcedureInformation::create(['physician_order'=>$physician_order, 'method_group'=>$method_group, 'procedure'=>$procedure, 'operation_start_time'=>$operation_start_time, 'collection_start_time'=>$collection_start_time, 'operation_end_time'=>$operation_end_time, 'wash_time'=>$wash_time, 'invoice_id'=>$invoice_id]);
		
		// Update the section information for this invoice
		CompleteInvoiceSection($invoice_id, 4);
		
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
		$model = $invoice->procedureInformation;		        
        $parameters = array('wash_time' => null);
        return EditInvoiceSection($model, $invoice, $invoiceSection, $parameters);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(ProcedureInformation $procedureInfo, Request $request)
	{
		//
		
		$procedureInfo->physician_order = $request['physician_order'];
		$procedureInfo->method_group = $request['method_group'];
		$procedureInfo->procedure = $request['procedure'];
		$procedureInfo->operation_start_time = $request['operation_start_time'];
		$procedureInfo->collection_start_time = $request['collection_start_time'];
		$procedureInfo->operation_end_time = $request['operation_end_time'];
		$procedureInfo->wash_time = $request['wash_time'];
		$procedureInfo->save();
		
		if($_POST['action'] == 'Continue')
        {
            return NextProcessStep($procedureInfo->invoice_id);
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
