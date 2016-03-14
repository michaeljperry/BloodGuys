<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Session;
use App\Models\TransfusionServices;
use App\Models\Invoice;
use App\Models\InvoiceSection;

class TransfusionServicesController extends Controller {

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
		//
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
		$invoice_id = $request['invoice_id'];
		$basic_service_quantity = $request['basic_service_quantity'];
		$basic_service_charge = $request['basic_service_charge'];
		$basic_service_total = $request['basic_service_total'];
		
		$modified_service_quantity = $request['modified_service_quantity'];
		$modified_service_charge = $request['modified_service_charge'];
		$modified_service_total = $request['modified_service_total'];
		
        $additional_operator_hours = $request['additional_operator_hours'];
		$additional_operator_hours_charge = $request['additional_operator_hours_charge'];
		$additional_operator_hours_total = $request['additional_operator_hours_total'];
        
        $platelate_gel_service_quantity = $request['platelate_gel_service_quantity'];
		$platelate_gel_service_charge = $request['platelate_gel_service_charge'];
		$platelate_gel_service_total = $request['platelate_gel_service_total'];
        
		$transfusion_service = TransfusionServices::create(
			[
				'basic_service_quantity' => $basic_service_quantity,
				'basic_service_charge' => $basic_service_charge,
				'basic_service_total' => $basic_service_total,
				'modified_service_quantity' => $modified_service_quantity,
				'modified_service_charge' => $modified_service_charge,
				'modified_service_total' => $modified_service_total,
                'additional_operator_hours' => $additional_operator_hours,
                'additional_operator_hours_charge' => $additional_operator_hours_charge,
                'additional_operator_hours_total' => $additional_operator_hours_total,
                'platelate_gel_service_quantity' => $platelate_gel_service_quantity,
				'platelate_gel_service_charge' => $platelate_gel_service_charge,
				'platelate_gel_service_total' => $platelate_gel_service_total,                
				'invoice_id' => $invoice_id
			]
		);
				
		// Setup next view		        
        return determineNextStep($_POST['action'], $transfusion_service->invoice_id);
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
		$model = $invoice->transfusionServices;
		$parameters = array('default' => NULL);
				
		return EditInvoiceSection($model, $invoice, $invoiceSection, $parameters);		
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(TransfusionServices $transfusionServices, Request $request)
	{        
		$transfusionServices->basic_service_quantity = $request['basic_service_quantity'];
		$transfusionServices->basic_service_charge = $request['basic_service_charge'];
		$transfusionServices->basic_service_total = $request['basic_service_total'];
		
		$transfusionServices->modified_service_quantity = $request['modified_service_quantity'];
		$transfusionServices->modified_service_charge = $request['modified_service_charge'];
		$transfusionServices->modified_service_total = $request['modified_service_total'];
		
        $transfusionServices->additional_operator_hours = $request['additional_operator_hours'];
		$transfusionServices->additional_operator_hours_charge = $request['additional_operator_hours_charge'];
		$transfusionServices->additional_operator_hours_total = $request['additional_operator_hours_total'];
        
        $transfusionServices->platelate_gel_service_quantity = $request['platelate_gel_service_quantity'];
		$transfusionServices->platelate_gel_service_charge = $request['platelate_gel_service_charge'];
		$transfusionServices->platelate_gel_service_total = $request['platelate_gel_service_total'];
        
		$transfusionServices->save();
		
		return determineNextStep($_POST['action'], $transfusionServices->invoice_id);
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
