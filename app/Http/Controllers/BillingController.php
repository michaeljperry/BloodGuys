<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Invoice;
use DB;

class BillingController extends Controller 
{    
    
    
    public function index($showHeaders=true)
    {
        $invoices = DB::select("CALL GetCompletedInvoices();");
        
        // return the index view for invoices
        return view('invoices.invoiceForExcel', compact('invoices', 'showHeaders'));
    }
    
	/**
	 * Updates the specified invoices as being billed.
	 *
	 * @param  Request $request
	 * @return Response
	 */
	public function update(Request $request)
	{
        $invoicesToUpdate = explode(",", $request['invoices']);    
        
        try
        {
            $affectedRows = Invoice::whereIn('id', $invoicesToUpdate)->update(['billed' => 1]);
        }
        catch(Exception $e)
        {
            return response()->json(array('error'=>true, 'message'=>'Invoice id '.$invoice_id.' not found.'), 404);
        }   
    
        return response()->json(array('error'=>false, 'message'=>$affectedRows), 200);
	}
}
