<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\InvoiceFile;
use Illuminate\Http\Request;
use ChromePhp;
use Input;
class InvoiceFilesController extends Controller {

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
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//
		
		$invoice_id = $request['invoice_id'];
		ChromePHP::log('invoice id: '.$invoice_id);
		
		$file = Input::file('file');
        $success = false;
		if($file->isValid())
		{			
			ChromePHP::log('file valid');
			$storage_path = storage_path().'/invoice_files/'.$invoice_id.'/';
			ChromePHP::log('storage path: '.$storage_path);
			$success = $file->move($storage_path, $file->getClientOriginalName());			
		}
		
        if($success)
        {
			ChromePHP::log('creating table entry');
			InvoiceFile::create(['filename'=>$file->getClientOriginalName(), 'invoice_id' => $invoice_id]);
            return response('success')->header('Content-Type', 'text/css');
        }
        else
        {
            return response('error uploading file.')->header('Content-Type', 'text/css');
        }
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
