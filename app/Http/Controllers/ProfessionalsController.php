<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Professional;
use App\Models\Profession;

class ProfessionalsController extends Controller
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
        // Return all records
        $professionals = Professional::all();
        return view('professionals.index', compact('professionals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $professions = Profession::orderBy('name')->lists('name', 'id');
                
        //
        return view('professionals.create', compact('professions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //        
        Professional::create($request->all());
        return redirect('professionals');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Professional $professional)
    {       
        //
        $professions = Profession::orderBy('name')->lists('name', 'id');
        return view('professionals.edit', compact('professional', 'professions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Professional $professional, Request $request)
    {
        //
        $professional->fill($request->all());
        $professional->save();
        
        return redirect('professionals');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Professional $professional)
    {
        //
        $professional->delete();
        
        // Add method to give feedback.
        return redirect('professionals');
    }
}
