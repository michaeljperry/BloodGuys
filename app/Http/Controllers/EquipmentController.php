<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Session;
use App\Models\Equipment;
use App\Models\Invoice;
use App\Models\InvoiceSection;

class EquipmentController extends Controller {

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
		return DisplayProcessStep($invoice_id, null);		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		// Store Patient Information
		$invoice_id = $request['invoice_id'];
		
		$device_name = $request['device_name'];
		$manufacturer = $request['manufacturer'];
		$serial_number = $request['serial_number'];
		$self_test_passed = $request['self_test_passed'];
		
		$equipment = Equipment::create(
			[
				'device_name' => $device_name,
				'manufacturer' => $manufacturer,
				'serial_number' => $serial_number,
				'self_test_passed' => $self_test_passed,
				'invoice_id' => $invoice_id		
			]
		);
		
		// Update the section information for this invoice
		CompleteInvoiceSection($invoice_id, 8);
		
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
		$model = $invoice->equipment;		
							
		return EditInvoiceSection($model, $invoice, $invoiceSection, null);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Equipment $equipment, Request $request)
	{
		//
		
		$equipment->device_name = $request['device_name'];
		$equipment->manufacturer = $request['manufacturer'];
		$equipment->serial_number = $request['serial_number'];
		$equipment->self_test_passed = $request['self_test_passed'];
		
		$equipment->save();
		
		if($_POST['action'] == 'Continue')
        {
            return NextProcessStep($equipment->invoice_id);
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
