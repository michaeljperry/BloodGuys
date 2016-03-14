<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\ProcedureTotals;
use App\Models\Invoice;
use App\Models\InvoiceSection;
use Session;

class ProcedureTotalsController extends Controller {

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
		$parameters = array('default'=>0);
		return DisplayProcessStep($invoice_id, $parameters);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{		
		// Need to save all information
		$invoice_id = $request['invoice_id'];
		$ebl_or = $request['ebl_or'];
		$rbc_returned_or = $request['rbc_returned_or'] ;
		$wash_amount_or = $request['wash_amount_or'];
		$vc_or = $request['vc_or'];
		$cc_or = $request['cc_or'];
		
		// po
		$ebl_po = $request['ebl_po'];
		$rbc_returned_po = $request['rbc_returned_po'] ;
		$wash_amount_po = $request['wash_amount_po'];
		$vc_po = $request['vc_po'];
		$cc_po = $request['cc_po'];
		
		// po2
		$ebl_po2 = $request['ebl_po2'];
		$rbc_returned_po2 = $request['rbc_returned_po2'] ;
		$wash_amount_po2 = $request['wash_amount_po2'];
		$vc_po2 = $request['vc_po2'];
		$cc_po2 = $request['cc_po2'];
		
		$ebl_total = $request['ebl_total'];
		$rbc_returned_total = $request['rbc_returned_total'];
		$wash_amount_total = $request['wash_amount_total'];
						
		$procedure_totals = ProcedureTotals::create(
			[
				'ebl_or' => $ebl_or,
				'rbc_returned_or' => $rbc_returned_or,
				'wash_amount_or' => $wash_amount_or,
				'vc_or' => $vc_or,
				'cc_or' => $cc_or,
				
				'ebl_po' => $ebl_po,
				'rbc_returned_po' => $rbc_returned_po,
				'wash_amount_po' => $wash_amount_po,
				'vc_po' => $vc_po,
				'cc_po' => $cc_po,
				
				'ebl_po2' => $ebl_po2,
				'rbc_returned_po2' => $rbc_returned_po2,
				'wash_amount_po2' => $wash_amount_po2,
				'vc_po2' => $vc_po2,
				'cc_po2' => $cc_po2,
				
				'ebl_total' => $ebl_total,
				'rbc_returned_total' => $rbc_returned_total,
				'wash_amount_total' => $wash_amount_total,
				
				'invoice_id' => $invoice_id						
			]
		);
				
		// Setup next view		        
       return determineNextStep($_POST['action'], $procedure_totals->invoice_id);
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
		$model = $invoice->procedureTotals;	
		$parameters = array('default' => null);        		
		return EditInvoiceSection($model, $invoice, $invoiceSection, $parameters);	
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(ProcedureTotals $procedureTotals, Request $request)
	{
		//
		
		$procedureTotals->ebl_or = $request['ebl_or'];
		$procedureTotals->rbc_returned_or = $request['rbc_returned_or'] ;
		$procedureTotals->wash_amount_or = $request['wash_amount_or'];
		$procedureTotals->vc_or = $request['vc_or'];
		$procedureTotals->cc_or = $request['cc_or'];
		
		// po
		$procedureTotals->ebl_po = $request['ebl_po'];
		$procedureTotals->rbc_returned_po = $request['rbc_returned_po'] ;
		$procedureTotals->wash_amount_po = $request['wash_amount_po'];
		$procedureTotals->vc_po = $request['vc_po'];
		$procedureTotals->cc_po = $request['cc_po'];
		
		// po2
		$procedureTotals->ebl_po2 = $request['ebl_po2'];
		$procedureTotals->rbc_returned_po2 = $request['rbc_returned_po2'] ;
		$procedureTotals->wash_amount_po2 = $request['wash_amount_po2'];
		$procedureTotals->vc_po2 = $request['vc_po2'];
		$procedureTotals->cc_po2 = $request['cc_po2'];
		
		$procedureTotals->ebl_total = $request['ebl_total'];
		$procedureTotals->rbc_returned_total = $request['rbc_returned_total'];
		$procedureTotals->wash_amount_total = $request['wash_amount_total'];
		
		$procedureTotals->save();
		
		return determineNextStep($_POST['action'], $procedureTotals->invoice_id);
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
