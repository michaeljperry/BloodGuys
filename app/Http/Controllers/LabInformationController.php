<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Session;
use App\Models\LabInformation;
use App\Models\Invoice;
use App\Models\InvoiceSection;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;

class LabInformationController extends Controller {

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
		$parameters = array('date_taken'=>Carbon::now());
		return DisplayProcessStep($invoice_id, $parameters);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$invoice_id = $request['invoice_id'];
		$date_taken = $request['date_taken'];
		$pre_op_hematocrit = $request['pre_op_hematocrit'];
		
		$labInfo = LabInformation::create(['pre_op_hematocrit'=>$pre_op_hematocrit, 'date_taken'=>$date_taken, 'invoice_id'=>$invoice_id]);
				
		// Setup next view		        
        return determineNextStep($_POST['action'], $labInfo->invoice_id); 
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
		$model = $invoice->labInformation;		        
        return EditInvoiceSection($model, $invoice, $invoiceSection, null);
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(LabInformation $labInfo, Request $request)
	{				
		$labInfo->date_taken = $request['date_taken'];
		$labInfo->pre_op_hematocrit = $request['pre_op_hematocrit'];
		$labInfo->save();
		
		return determineNextStep($_POST['action'], $labInfo->invoice_id);      
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
