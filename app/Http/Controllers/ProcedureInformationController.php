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
		$total_time = $request['total_time'];
		
		$procedureInfo = ProcedureInformation::create(['physician_order'=>$physician_order, 'method_group'=>$method_group, 'procedure'=>$procedure, 'operation_start_time'=>$operation_start_time, 'collection_start_time'=>$collection_start_time, 'operation_end_time'=>$operation_end_time, 'total_time'=>$total_time, 'wash_time'=>$wash_time, 'invoice_id'=>$invoice_id]);
				
		// Setup next view		        
        return determineNextStep($_POST['action'], $procedureInfo->invoice_id);  	
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
		//Left off on setting times to null for procedure information.  It seems to be working. Do a few more tests.
        //Set wash time to null as well and do not pass a default value.	
        // Need to add complete invoice button to invoices page. Remove complete invoice check from helpers.	
		$procedureInfo->physician_order = $request['physician_order'];
		$procedureInfo->method_group = $request['method_group'];
		$procedureInfo->procedure = $request['procedure'];
		$procedureInfo->operation_start_time = $this->validateValue($request['operation_start_time']);
		$procedureInfo->collection_start_time = $this->validateValue($request['collection_start_time']);
		$procedureInfo->operation_end_time = $this->validateValue($request['operation_end_time']);
		$procedureInfo->total_time = $this->validateValue($request['total_time']);
		$procedureInfo->wash_time = $this->validateValue($request['wash_time']);
		$procedureInfo->save();
		
		return determineNextStep($_POST['action'], $procedureInfo->invoice_id);    
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
    
    private function validateValue($value)
    {
        if(empty($value)) return null;
        return $value;
    }

}
