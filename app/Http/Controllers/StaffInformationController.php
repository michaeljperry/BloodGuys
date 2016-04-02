<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Profession;
use App\Models\Professional;
use App\Models\StaffInformation;
use App\Models\Invoice;
use App\Models\InvoiceSection;
use App\User;
use Webpatser\Uuid\Uuid;
use Session;
use DB;
use Auth;

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
		$autotransfusionists = User::where('id', '!=', Auth::user()->id)->select(DB::raw('Concat(users.last_name, ", ", Left(users.first_name, 1)) as user_name'), 'users.id')->get(); 
        $anesthesiologists = $professionals->where('name', 'Anesthesiologist');
               		        
        // Get the logged in users id
        $user = Auth::user();       
        $default = "default";
        $primary_autoTransfusionist = $user->reverseFullName();
        $primary_autoTransfusionist_editable = false;
        $secondary_autoTransfusionist = "default";
        $secondary_autoTransfusionist_editable = true;
        $parameters = array('surgeons'=>$surgeons, 'anesthesiologists' => $anesthesiologists, 'autotransfusionists' => $autotransfusionists, 'default'=>$default, 'primary_autoTransfusionist' => $primary_autoTransfusionist, 'primary_autoTransfusionist_editable' => $primary_autoTransfusionist_editable, 'secondary_autoTransfusionist' => $secondary_autoTransfusionist, 'secondary_autoTransfusionist_editable' => $secondary_autoTransfusionist_editable);
			
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
		$secondary_autotransfusionist_id = $request["secondary_autotransfusionist_id"];
		$surgeon_id = $request["surgeon_id"];
				        
		// Verify Id's
		$surgeon_id = $this->checkProfessionalId($surgeon_id, 'surgeon');
		$anesthesiologist_id = $this->checkProfessionalId($anesthesiologist_id, 'anesthesiologist');		
		$secondary_autotransfusionist_id  = $this->checkProfessionalId($secondary_autotransfusionist_id, 'autotransfusionist');
        		
        // Storing staff information
        $invoice_id = $request['invoice_id'];
        
        $staffInfo = StaffInformation::firstOrNew(['invoice_id' => $invoice_id]);
        $staffInfo->anesthesiologist_id = $anesthesiologist_id;
        $staffInfo->primary_autotransfusionist_id = Auth::user()->id;
        $staffInfo->secondary_autotransfusionist_id = $secondary_autotransfusionist_id;
        $staffInfo->surgeon_id = $surgeon_id;
        $staffInfo->invoice_id = $invoice_id;
        $staffInfo->save();
        
        if(!empty($secondary_autotransfusionist_id))
        {
            $user = User::find($secondary_autotransfusionist_id);
            $invoice = Invoice::find($invoice_id);
            $user->invoices()->save($invoice);                
        }
        
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
		
        //scenarios for population of secondary transfusionist
        /*  1. Secondary is Null. Should show select box with none as default.
            2. Secondary is populated.  Should show text field with secondary user.            
        */
        $user = Auth::user();
        $primary_autoTransfusionist = "default";
        $primary_autoTransfusionist_editable = true;
        $secondary_autoTransfusionist = "default";
        $secondary_autoTransfusionist_editable = true;
        
        // Primary AT logged in
        if($staffInformation->primary_autotransfusionist_id === $user->id)
        {
            $primary_autoTransfusionist = User::find($staffInformation->primary_autotransfusionist_id)->reverseFullName();
            $primary_autoTransfusionist_editable = false;
            
            if($staffInformation->secondary_autotransfusionist_id === null)
            {
                $secondary_autoTransfusionist = "default";
            }
            else
            {
                $secondary_autoTransfusionist = $staffInformation->secondary_autotransfusionist_id;               
            }
            
            $secondary_autoTransfusionist_editable = true;
        }
        else if($staffInformation->secondary_autotransfusionist_id === $user->id)
        {                        
            if($staffInformation->secondary_autotransfusionist_id === null)
            {
                $primary_autoTransfusionist = "default";
            }
            else
            {
                $primary_autoTransfusionist = $staffInformation->primary_autotransfusionist_id;
            }               
            
            $primary_autoTransfusionist_editable = true;
            
            $secondary_autoTransfusionist_editable = false;
            $secondary_autoTransfusionist = User::find($staffInformation->secondary_autotransfusionist_id)->reverseFullName();
        }       
             
		// setup the parameters		
		$professionals = Professional::join('professions', 'professionals.profession_id', '=', 'professions.id')->select(DB::raw('Case When first_name is null or first_name = "" then last_name else Concat(last_name, ", ", Left(first_name, 1)) end as professional_name'), 'professions.name', 'professionals.id')->get();  
		$surgeons = $professionals->where('name', 'Surgeon');
        $anesthesiologists = $professionals->where('name', 'Anesthesiologist');
        $autotransfusionists = User::where('id', '!=', Auth::user()->id)->select(DB::raw('Concat(users.last_name, ", ", Left(users.first_name, 1)) as user_name'), 'users.id')->get();
		$default = null;
		$parameters = array('surgeons' => $surgeons, 'anesthesiologists' => $anesthesiologists, 'autotransfusionists' => $autotransfusionists, 'default'=>$default, 'primary_autoTransfusionist'=>$primary_autoTransfusionist, 'secondary_autoTransfusionist'=>$secondary_autoTransfusionist, 'secondary_autoTransfusionist_editable' => $secondary_autoTransfusionist_editable, 'primary_autoTransfusionist_editable' => $primary_autoTransfusionist_editable);
		
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
        DB::beginTransaction();
        
        try
        {      
            // Get information needed to update the record
            $invoice_id = $staffInformation->invoice_id;
            $anesthesiologist_id = $this->checkProfessionalId($request["anesthesiologist_id"], 'anesthesiologist');
            $surgeon_id = $this->checkProfessionalId($request["surgeon_id"], 'surgeon');
            
            // Get the original and new auto transfusionist ids
            $oldPrimaryId = $staffInformation->primary_autotransfusionist_id;
            $newPrimaryId = $request["primary_autotransfusionist_id"];
                    
            $oldSecondaryId = $staffInformation->secondary_autotransfusionist_id;
            $newSecondaryId = $request["secondary_autotransfusionist_id"];
                            
            // Perform validation for new AT ids                                
            $newPrimaryId = $this->validateAutoTransfusionistIds($oldPrimaryId, $newPrimaryId);        
            $newSecondaryId = $this->validateAutoTransfusionistIds($oldSecondaryId, $newSecondaryId);
            
            // Update the Staff Information Table. If all transactions do not succeed then roll back.                                       
            $staffInformation->anesthesiologist_id = $anesthesiologist_id;
            $staffInformation->surgeon_id = $surgeon_id;
            
            $staffInformation->primary_autotransfusionist_id = $this->updateUserInvoices($oldPrimaryId, $newPrimaryId, $invoice_id);   
            $staffInformation->secondary_autotransfusionist_id = $this->updateUserInvoices($oldSecondaryId, $newSecondaryId, $invoice_id);
            
            $staffInformation->save();            
        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            DB::rollback();
            return redirect()->back()->withErrors($ex->getMessage())->withInput();
        }
        catch(\Exception $e)
        {            
            DB::rollback();
            return redirect()->back()->withErrors('There was an error. Please contact your system administrator.')->withInput();
        }                             
        
        DB::commit();
        
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
		if($id == 'default' || empty($id) ) return null;
		
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
    
    private function validateAutoTransfusionistIds($oldId, $newId)
    {
        if(is_numeric($newId) && $newId > 0) return $newId;
        
        if(!empty($newId) && $newId !== 'default' && is_numeric($oldId))
        {
            return $oldId;           
        }
        
        // It is either 'default' or null
        return null;
    }
    
    private function updateUserInvoices($oldId, $newId, $invoice_id)
    {
        // Ids are the same so there is nothing to do.                
        if($oldId === $newId) return $newId;
        
        if(!empty($oldId) && !empty($newId))
        {
            User::find($oldId)->invoices()->detach($invoice_id);
            User::find($newId)->invoices()->attach($invoice_id);
        }
        else if(empty($oldId) && !empty($newId))
        {
            User::find($newId)->invoices()->attach($invoice_id);
        }
        else if(!empty($oldId) && empty($newId))
        {
            User::find($oldId)->invoices()->detach($invoice_id);
        }
        else
        {
            // error (need to make sure this gets thrown) when both are null (if that's possible)
        }
        
        return $newId;            
    }
}
