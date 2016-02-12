<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Profession;
use App\Models\Professional;
use App\Models\StaffInformation;
use App\Models\Invoice;
use App\Models\InvoiceSection;
use Webpatser\Uuid\Uuid;
use Session;
use DB;

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
		$professionals = Professional::join('professions', 'professionals.profession_id', '=', 'professions.id')->select(DB::raw('Concat(professionals.last_name, ", ", Left(professionals.first_name, 1)) as professional_name'), 'professions.name', 'professionals.id')->get();  
		$surgeons = $professionals->where('name', 'Surgeon');
		
        $anesthesiologists = $professionals->where('name', 'Anesthesiologist');
        $autotransfusionists = $professionals->where('name', 'Autotransfusionist');
		$default = 'default';
		$parameters = array('surgeons'=>$surgeons, 'anesthesiologists' => $anesthesiologists, 'autotransfusionists' => $autotransfusionists, 'default'=>$default);
			
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
				        
		// Verify Id's
		$surgeon_id = $this->checkProfessionalId($surgeon_id, 'surgeon');
		$anesthesiologist_id = $this->checkProfessionalId($anesthesiologist_id, 'anesthesiologist');
		$primary_autotransfusionist_id  = $this->checkProfessionalId($primary_autotransfusionist_id, 'autotransfusionist');
		$secondary_autotransfusionist_id  = $this->checkProfessionalId($secondary_autotransfusionist_id, 'autotransfusionist');
				
        // Storing staff information
        $invoice_id = $request['invoice_id'];
        
        $staffInfo = StaffInformation::firstOrNew(['invoice_id' => $invoice_id]);
        $staffInfo->anesthesiologist_id = $anesthesiologist_id;
        $staffInfo->primary_autotransfusionist_id = $primary_autotransfusionist_id;
        $staffInfo->secondary_autotransfusionist_id = $secondary_autotransfusionist_id;
        $staffInfo->surgeon_id = $surgeon_id;
        $staffInfo->invoice_id = $invoice_id;
        $staffInfo->save();
        //$staffInfo = StaffInformation::create(['anesthesiologist_id'=>$anesthesiologist_id, 'primary_autotransfusionist_id'=>$primary_autotransfusionist_id, 
        //'secondary_autotransfusionist_id'=>$secondary_autotransfusionist_id, 'surgeon_id'=>$surgeon_id, 'invoice_id'=>$invoice_id]);
				
		// Go to the next step
		return determineNextStep($_POST['action'], $staffInfo->invoice_id);       
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
		$professionals = Professional::join('professions', 'professionals.profession_id', '=', 'professions.id')->select(DB::raw('Case When first_name is null or first_name = "" then last_name else Concat(last_name, ", ", Left(first_name, 1)) end as professional_name'), 'professions.name', 'professionals.id')->get();  
		$surgeons = $professionals->where('name', 'Surgeon');
        $anesthesiologists = $professionals->where('name', 'Anesthesiologist');
        $autotransfusionists = $professionals->where('name', 'Autotransfusionist');
		$default = null;
		$parameters = array('surgeons' => $surgeons, 'anesthesiologists' => $anesthesiologists, 'autotransfusionists' => $autotransfusionists, 'default'=>$default);
		
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
		$staffInformation->anesthesiologist_id = $this->checkProfessionalId($request["anesthesiologist_id"], 'anesthesiologist');
        $staffInformation->primary_autotransfusionist_id = $this->checkProfessionalId($request["primary_autotransfusionist_id"], 'autotransfusionist');
		$staffInformation->secondary_autotransfusionist_id = $this->checkProfessionalId($request["secondary_autotransfusionist_id"], 'autotransfusionist');
		$staffInformation->surgeon_id = $this->checkProfessionalId($request["surgeon_id"], 'surgeon');
						
		$staffInformation->save();
		
		return determineNextStep($_POST['action'], $staffInformation->invoice_id);       
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

	private function checkProfessionalId($id, $profession)
	{		
		if($id == 'default') return null;
		
		if(!is_numeric($id))
		{
			$id = $this->addProfessional($id, $profession);							
		}
		
		return $id;
	}
	
	private function addProfessional($professionalName, $profession)
	{
		$delimiter = null;
						
		if(strrpos($professionalName, ","))
		{
			$delimiter = ",";		
		}
		else if(strrpos($professionalName, " "))
		{
			$delimiter = " ";
		}
		else if(strrpos($professionalName, "."))
		{
			$delimiter = ".";
		}
		else
		{
			// No Delimiter
			$delimiter = ".";			
		}
		
		$newProfessionalName = explode($delimiter, $professionalName);
		
		if(count($newProfessionalName) != 2)
		{
			// No first name, use empty string
			$newProfessionalName[1] = "";
		}
		
		$profession = Profession::where('name', '=', $profession)->firstOrFail();
		$first_name = trim($newProfessionalName[1]);
		$last_name = trim($newProfessionalName[0]);
		$newProfessional = Professional::create(['profession_id'=>$profession->id, 'first_name'=>$first_name, 'last_name'=>$last_name]);
		return $newProfessional->id;
	}
}
