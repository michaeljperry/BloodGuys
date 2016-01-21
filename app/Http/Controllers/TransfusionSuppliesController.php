<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\TransfusionSupplies;
use App\Models\Invoice;
use App\Models\InvoiceSection;
use Illuminate\Http\Request;
use Session;

class TransfusionSuppliesController extends Controller {
	
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
		$invoice = Invoice::find($invoice_id);        
        $transfusionServices = $invoice->transfusionServices;
        $invoiceTotalCharges = 0.00;
        
        if($transfusionServices != null)
        {
            $invoiceTotalCharges = $transfusionServices->basic_service_total + $transfusionServices->modified_service_total;
        }
        
        $parameters = array('default' => 0.00, 'invoiceTotalCharges' => $invoiceTotalCharges);
        
		return DisplayProcessStep($invoice_id, $parameters);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		// Get the invoice id since it is needed in several places.
		$invoice_id = $request['invoice_id'];
		
		$transfusionSupplies = TransfusionSupplies::create(
			[		
				'wash_kit_manufacturer' => $request['wash_kit_manufacturer'],
				'wash_kit_product_id_number' => $request['wash_kit_product_id_number'],
				'wash_kit_quantity' => $request['wash_kit_quantity'],
				'wash_kit_charge' => $request['wash_kit_charge'],
				'wash_kit_total' => $request['wash_kit_total'],
				
				'reservoir_manufacturer' => $request['reservoir_manufacturer'],
				'reservoir_product_id_number' => $request['reservoir_product_id_number'],
				'reservoir_quantity' => $request['reservoir_quantity'],
				'reservoir_charge' => $request['reservoir_charge'],
				'reservoir_total' => $request['reservoir_total'],
				
				'aspiration_assembly_manufacturer' => $request['aspiration_assembly_manufacturer'],
				'aspiration_assembly_product_id_number' => $request['aspiration_assembly_product_id_number'],
				'aspiration_assembly_quantity' => $request['aspiration_assembly_quantity'],
				'aspiration_assembly_charge' => $request['aspiration_assembly_charge'],
				'aspiration_assembly_total' => $request['aspiration_assembly_total'],
				
				'blood_bag_manufacturer' => $request['blood_bag_manufacturer'],
				'blood_bag_product_id_number' => $request['blood_bag_product_id_number'],
				'blood_bag_quantity' => $request['blood_bag_quantity'],
				'blood_bag_charge' => $request['blood_bag_charge'],
				'blood_bag_total' => $request['blood_bag_total'],
				
				'vacuum_tubing_manufacturer' => $request['vacuum_tubing_manufacturer'],
				'vacuum_tubing_product_id_number' => $request['vacuum_tubing_product_id_number'],
				'vacuum_tubing_quantity' => $request['vacuum_tubing_quantity'],
				'vacuum_tubing_charge' => $request['vacuum_tubing_charge'],
				'vacuum_tubing_total' => $request['vacuum_tubing_total'],
				
				'wound_drain_manufacturer' => $request['wound_drain_manufacturer'],
				'wound_drain_product_id_number' => $request['wound_drain_product_id_number'],
				'wound_drain_quantity' => $request['wound_drain_quantity'],
				'wound_drain_charge' => $request['wound_drain_charge'],
				'wound_drain_total' => $request['wound_drain_total'],
				
				'y_connector_manufacturer' => $request['y_connector_manufacturer'],
				'y_connector_product_id_number' => $request['y_connector_product_id_number'],
				'y_connector_quantity' => $request['y_connector_quantity'],
				'y_connector_charge' => $request['y_connector_charge'],
				'y_connector_total' => $request['y_connector_total'],
				
				'blood_filter_manufacturer' => $request['blood_filter_manufacturer'],
				'blood_filter_product_id_number' => $request['blood_filter_product_id_number'],
				'blood_filter_quantity' => $request['blood_filter_quantity'],
				'blood_filter_charge' => $request['blood_filter_charge'],
				'blood_filter_total' => $request['blood_filter_total'],
				
				'acda_bag_manufacturer' => $request['acda_bag_manufacturer'],
				'acda_bag_product_id_number' => $request['acda_bag_product_id_number'],
				'acda_bag_quantity' => $request['acda_bag_quantity'],
				'acda_bag_charge' => $request['acda_bag_charge'],
				'acda_bag_total' => $request['acda_bag_total'],
				
				'misc_manufacturer' => $request['misc_manufacturer'],
				'misc_product_id_number' => $request['misc_product_id_number'],
				'misc_quantity' => $request['misc_quantity'],
				'misc_charge' => $request['misc_charge'],
				'misc_total' => $request['misc_total'],
				'supplies_total' => $request['supplies_total'],
				'invoice_id' => $invoice_id
			]
		);
				
		return determineNextStep($_POST['action'], $invoice_id);	
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
	public function editInvoice(Invoice $invoice, InvoiceSection $invoiceSection)
	{
		$model = $invoice->transfusionSupplies;
        $transfusionServices = $invoice->transfusionServices;
        $invoiceTotalCharges = 0.00;
        
        if($transfusionServices != null)
        {
            $invoiceTotalCharges = $transfusionServices->basic_service_total + $transfusionServices->modified_service_total + $model->supplies_total;
        }
        
        $parameters = array('default' => NULL, 'invoiceTotalCharges' => $invoiceTotalCharges);		
		return EditInvoiceSection($model, $invoice, $invoiceSection, $parameters);		
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(TransfusionSupplies $transfusionSupplies, Request $request)
	{
		$transfusionSupplies->fill(
			[		
				'wash_kit_manufacturer' => $request['wash_kit_manufacturer'],
				'wash_kit_product_id_number' => $request['wash_kit_product_id_number'],
				'wash_kit_quantity' => $request['wash_kit_quantity'],
				'wash_kit_charge' => $request['wash_kit_charge'],
				'wash_kit_total' => $request['wash_kit_total'],
				
				'reservoir_manufacturer' => $request['reservoir_manufacturer'],
				'reservoir_product_id_number' => $request['reservoir_product_id_number'],
				'reservoir_quantity' => $request['reservoir_quantity'],
				'reservoir_charge' => $request['reservoir_charge'],
				'reservoir_total' => $request['reservoir_total'],
				
				'aspiration_assembly_manufacturer' => $request['aspiration_assembly_manufacturer'],
				'aspiration_assembly_product_id_number' => $request['aspiration_assembly_product_id_number'],
				'aspiration_assembly_quantity' => $request['aspiration_assembly_quantity'],
				'aspiration_assembly_charge' => $request['aspiration_assembly_charge'],
				'aspiration_assembly_total' => $request['aspiration_assembly_total'],
				
				'blood_bag_manufacturer' => $request['blood_bag_manufacturer'],
				'blood_bag_product_id_number' => $request['blood_bag_product_id_number'],
				'blood_bag_quantity' => $request['blood_bag_quantity'],
				'blood_bag_charge' => $request['blood_bag_charge'],
				'blood_bag_total' => $request['blood_bag_total'],
				
				'vacuum_tubing_manufacturer' => $request['vacuum_tubing_manufacturer'],
				'vacuum_tubing_product_id_number' => $request['vacuum_tubing_product_id_number'],
				'vacuum_tubing_quantity' => $request['vacuum_tubing_quantity'],
				'vacuum_tubing_charge' => $request['vacuum_tubing_charge'],
				'vacuum_tubing_total' => $request['vacuum_tubing_total'],
				
				'wound_drain_manufacturer' => $request['wound_drain_manufacturer'],
				'wound_drain_product_id_number' => $request['wound_drain_product_id_number'],
				'wound_drain_quantity' => $request['wound_drain_quantity'],
				'wound_drain_charge' => $request['wound_drain_charge'],
				'wound_drain_total' => $request['wound_drain_total'],
				
				'y_connector_manufacturer' => $request['y_connector_manufacturer'],
				'y_connector_product_id_number' => $request['y_connector_product_id_number'],
				'y_connector_quantity' => $request['y_connector_quantity'],
				'y_connector_charge' => $request['y_connector_charge'],
				'y_connector_total' => $request['y_connector_total'],
				
				'blood_filter_manufacturer' => $request['blood_filter_manufacturer'],
				'blood_filter_product_id_number' => $request['blood_filter_product_id_number'],
				'blood_filter_quantity' => $request['blood_filter_quantity'],
				'blood_filter_charge' => $request['blood_filter_charge'],
				'blood_filter_total' => $request['blood_filter_total'],
				
				'acda_bag_manufacturer' => $request['acda_bag_manufacturer'],
				'acda_bag_product_id_number' => $request['acda_bag_product_id_number'],
				'acda_bag_quantity' => $request['acda_bag_quantity'],
				'acda_bag_charge' => $request['acda_bag_charge'],
				'acda_bag_total' => $request['acda_bag_total'],
				
				'misc_manufacturer' => $request['misc_manufacturer'],
				'misc_product_id_number' => $request['misc_product_id_number'],
				'misc_quantity' => $request['misc_quantity'],
				'misc_charge' => $request['misc_charge'],
				'misc_total' => $request['misc_total'],
				'supplies_total' => $request['supplies_total']
			]
		);
		
		$transfusionSupplies->save();
		
		return determineNextStep($_POST['action'], $transfusionSupplies->invoice_id);
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
