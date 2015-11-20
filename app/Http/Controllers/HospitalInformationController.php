<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\HospitalInformation;
use App\Models\Professional;

use Session;

class HospitalInformationController extends Controller {

	private $hospitals;
	
	public function __construct()
    {
        $this->middleware('auth');
        $this->hospitals = Hospital::all();        
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
	public function create()
	{
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		 $hospital_id = $request["hospital_list"];
        
        // Storing hospital information
        $invoice_id = hex2bin(str_replace('-', '', Session::get('invoice_id')));
        $hospitalInfo = HospitalInformation::create(['hospital_id'=>$hospital_id, 'invoice_id'=>$invoice_id]);
		
		// Add message that hospital section saved
		
		// route to next section
		//select('professionals.first_name', 'professionals.last_name', 'professions.name', 'professionals.id')->get();
		$professionals = Professional::join('professions', 'professionals.profession_id', '=', 'professions.id')->select('professionals.first_name', 'professionals.last_name', 'professions.name', 'professionals.id')->get();  
		$surgeons = $professionals->where('name', 'Surgeon');
        $anesthesiologists = $professionals->where('name', 'Anesthesiologist');
        $autotransfusionists = $professionals->where('name', 'Autotransfusionist');
		//dd($surgeons->first()->getfirstInitialLastName());	
        $params = ['surgeons'=>$surgeons, 'anesthesiologists'=>$anesthesiologists, 'autotransfusionists'=>$autotransfusionists];   
             
        // return the create view
        return view('staffInformation.create', compact('routeToUse', 'formToUse', 'params'));			        
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

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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
