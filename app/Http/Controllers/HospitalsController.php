<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Hospital;
use Session;

class HospitalsController extends Controller
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
        $hospitals = Hospital::all();
        
        return view('hospitals.index', compact('hospitals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('hospitals.create');        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        Hospital::create($request->all());
        return redirect('hospitals');        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
    {
        //
        $hospitals = Hospital::simplePaginate(1);
        return view('hospitals.show', compact('hospitals'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Hospital $hospital)
    {
        //        
        return view('hospitals.edit', compact('hospital'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Hospital $hospital, Request $request)
    {
        //
        $hospital->fill($request->all());
        $hospital->save();
        
        return redirect('hospitals');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Hospital $hospital)
    {
        //        
        $hospital->delete();
        
        Session::flash('flash_message', $hospital->name.' was successfully deleted.');
        
        return redirect('hospitals');
    }
}
