<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Invoice;
use App\Models\InvoiceSection;
use App\Models\Hospital;
use App\Models\Professional;
use Carbon;
use Webpatser\Uuid\Uuid;
use Auth;

class InvoicesController extends Controller
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
        
        //$invoices = Auth::user()->invoices();
        $invoices = Invoice::with('hospital', 'staffInformation')->get();
                                                 
        // return the index view for invoices
        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {         
        // Get all hospitals
        $hospitals = Hospital::all();
        $date = Carbon::today()->format('Y-m-d');    
        $invoice_id = $request['invoice_id'];
        
        $parameters = array('hospitals' => $hospitals, 'date'=>$date);
          
        return DisplayProcessStep($invoice_id, $parameters);  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {                
        // Get the information from the form
        $procedure_date = $request['procedure_date'];
        $hospital_id = $request['hospital_id'];
        $po_number = $request['po_number'];
        $special_notes = $request['special_notes'];
        
        // Get information about the user that created the invoice
        $created_by = Auth::user()->name;
        $last_modified_by = $created_by;
        $completed = false;
        
        // Save invoice to the database
        $invoice = new Invoice(
            [
                'procedure_date' => $procedure_date,
                'po_number' => $po_number,
                'special_notes' => $special_notes,
                'completed' => $completed,                
                'hospital_id' => $hospital_id,
                'created_by' => $created_by,
                'last_modified_by' => $last_modified_by
            ]
        );
        
        Auth::user()->invoices()->save($invoice);
              
        // Get the invoice Id
        $invoice_id = $invoice->id;
                      
        // Create the invoice Sections
        $invoice_sections = InvoiceSection::all();
        
        foreach($invoice_sections as $invoice_section)
        {
            $completed = false;
            if($invoice_section->process_step == 1)
            {
                $completed = true;
            }
            
            $invoice->invoiceSections()->attach($invoice_section, ['completed' => $completed]);    
        }

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
    public function edit(Invoice $invoice)
    {
        //
        //dd($invoice);
        $invoiceSections = $invoice->invoiceSections;
        return view('invoices.edit', compact('invoice', 'invoiceSections'));
    }
    
    public function editInvoice(Invoice $invoice, InvoiceSection $invoiceSection)
    {     
        $hospitals = Hospital::all();
        $parameters = array('date' => null, 'hospitals'=> $hospitals);
        
        return EditInvoiceSection($invoice, $invoice, $invoiceSection, $parameters);       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Invoice $invoice, Request $request)
    {
        
        InvoicesController::updateModel($invoice, $request);
        
        if($_POST['action'] == 'Continue')
        {
            return NextProcessStep($invoice->id);
        }
        else
        {
            return RedirectToInvoicesIndex();
        }           
    }
       
    public function updateModel(Invoice $invoice, Request $request)
    {
        
        // Get the information from the form
        $procedure_date = $request['procedure_date'];
        $hospital_id = $request['hospital_id'];
        $po_number = $request['po_number'];
        $special_notes = $request['special_notes'];
        
        // Get information about the user that created the invoice
        $last_modified_by = Auth::user()->name;
        
        $invoice->procedure_date = $procedure_date;
        $invoice->hospital_id = $hospital_id;
        $invoice->po_number = $po_number;
        $invoice->special_notes = $special_notes;
        $invoice->last_modified_by = $last_modified_by;
        $invoice->save();
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Invoice $invoice)
    {
        // Delete the invoice        
        $invoice->delete();
        
        Session::flash('flash_message', $invoice->id .' was successfully deleted.');
        
        return redirect('invoices');
    }
    
    public function startInvoiceProcess($invoice_id, $process_step)
    {        
        return SetupProcessStep($invoice_id, $process_step);
    }
}
