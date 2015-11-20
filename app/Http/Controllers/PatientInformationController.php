<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
 
use Illuminate\Http\Request;
use App\Models\PatientInformation;
use App\Models\Invoice;
use App\Models\InvoiceSection;
use Webpatser\Uuid\Uuid;
use Session;
use Carbon\Carbon;
class PatientInformationController extends Controller 
{

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
		// Get the Invoice Id
		$invoice_id = $request['invoice_id'];
		
		// no parameters needed so just diplay the view
		return DisplayProcessStep($invoice_id, null);	
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{				
		$this->validate($request, [
			'first_name' => 'required|max:1',
			'invoice_id' => 'required'
		]);
		
		// Store Patient Information
		$invoice_id = $request['invoice_id'];
		
		$first_name = $request['first_name'];
		$last_name = $request['last_name'];
		$medical_record_number = $request['medical_record_number'];
		$patient_number = $request['patient_number'];
		
		// Save Patient Information
		$patientInfo = PatientInformation::create(['first_name'=>$first_name, 'last_name'=>$last_name, 'patient_number'=>$patient_number, 'medical_record_number'=>$medical_record_number, 'invoice_id'=>$invoice_id]);
	
		// Update the section information for this invoice
		CompleteInvoiceSection($invoice_id, 3);
	
		// Goto next process step
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
	public function editInvoice(Invoice $invoice, InvoiceSection $invoiceSection)
	{
		$model = $invoice->patientInformation;		        
        return EditInvoiceSection($model, $invoice, $invoiceSection, null);		
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(PatientInformation $patientInfo, Request $request)
	{
		//
		$patientInfo->first_name = $request['first_name'];
		$patientInfo->last_name = $request['last_name'];
		$patientInfo->medical_record_number = $request['medical_record_number'];
		$patientInfo->patient_number = $request['patient_number'];
		
		$patientInfo->save();
		
		if($_POST['action'] == 'Continue')
        {
            return NextProcessStep($patientInfo->invoice_id);
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
