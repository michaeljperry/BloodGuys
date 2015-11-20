<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Professional;
use App\Models\StaffInformation;
use App\Models\Invoice;
use App\Models\InvoiceSection;
use Webpatser\Uuid\Uuid;
use Session;

class StaffInformationController extends Controller {

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
		// Get Invoice Id
		$invoice_id = $request['invoice_id'];
		
		//Get parameters needed for this form		
		//select('professionals.first_name', 'professionals.last_name', 'professions.name', 'professionals.id')->get();
		$professionals = Professional::join('professions', 'professionals.profession_id', '=', 'professions.id')->select('professionals.first_name', 'professionals.last_name', 'professions.name', 'professionals.id')->get();  
		$surgeons = $professionals->where('name', 'Surgeon');
        $anesthesiologists = $professionals->where('name', 'Anesthesiologist');
        $autotransfusionists = $professionals->where('name', 'Autotransfusionist');
		$parameters = array('surgeons'=>$surgeons, 'anesthesiologists' => $anesthesiologists, 'autotransfusionists' => $autotransfusionists);
			
		return DisplayProcessStep($invoice_id, $parameters);	
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		// Get form information				
		$anesthesiologist_id = $request["anesthesiologist_id"];
        $primary_autotransfusionist_id = $request["primary_autotransfusionist_id"];
		$secondary_autotransfusionist_id = $request["secondary_autotransfusionist_id"];
		$surgeon_id = $request["surgeon_id"];
			
        // Storing staff information
        $invoice_id = $request['invoice_id'];
        $staffInfo = StaffInformation::create(['anesthesiologist_id'=>$anesthesiologist_id, 'primary_autotransfusionist_id'=>$primary_autotransfusionist_id, 'secondary_autotransfusionist_id'=>$secondary_autotransfusionist_id, 'surgeon_id'=>$surgeon_id, 'invoice_id'=>$invoice_id]);
		
		// Complete this section
		CompleteInvoiceSection($invoice_id, 2);
		//Invoice::find($invoice_id)->invoiceSections()->updateExistingPivot(2, ['completed'=>1]);
		// Add message that staff information section saved
			
        // return the create view
        //return view('invoices.create', compact('invoice_id', 'routeToUse', 'formToUse'));
		//return redirect()->action('PatientInformationController@create')->with('invoice_id', $invoice_id);
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
		 
	 }
	 
	public function editInvoice(Invoice $invoice, InvoiceSection $invoiceSection)
	{
		// get the model 
		$staffInformation = $invoice->staffInformation;
		
		// setup the parameters		
		$professionals = Professional::join('professions', 'professionals.profession_id', '=', 'professions.id')->select('professionals.first_name', 'professionals.last_name', 'professions.name', 'professionals.id')->get();  
		$surgeons = $professionals->where('name', 'Surgeon');
        $anesthesiologists = $professionals->where('name', 'Anesthesiologist');
        $autotransfusionists = $professionals->where('name', 'Autotransfusionist');
		$parameters = array('surgeons' => $surgeons, 'anesthesiologists' => $anesthesiologists, 'autotransfusionists' => $autotransfusionists);
		
		return EditInvoiceSection($staffInformation, $invoice, $invoiceSection, $parameters);				
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(StaffInformation $staffInformation, Request $request)
	{		
		// Get form information				
		$staffInformation->anesthesiologist_id = $request["anesthesiologist_id"];
        $staffInformation->primary_autotransfusionist_id = $request["primary_autotransfusionist_id"];
		$staffInformation->secondary_autotransfusionist_id = $request["secondary_autotransfusionist_id"];
		$staffInformation->surgeon_id = $request["surgeon_id"];
		
		$staffInformation->save();
		
		if($_POST['action'] == 'Continue')
        {
            return NextProcessStep($staffInformation->invoice_id);
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
