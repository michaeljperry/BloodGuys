<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('admin');
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// Get Users
		$users = User::all();
		return view('users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('users.create');
	}
		
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
			'email' => 'required|email|max:50|unique:users',
			'password' => 'required|confirmed|min:6'			
		]);
		
		$admin = ($request['admin'] == "1")?true:false;
        $active = ($request['active'] == "1")?true:false;
			
		User::create([
			'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
			'email' => $request['email'],
			'password' => bcrypt($request['password']),
			'admin' => $admin,
            'active' => $active
		]);
		
		return redirect('users')->with('flash_message', 'A user account for '.$request['first_name'].' was created successfully.');
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
	public function edit(User $user)
	{		
		return view('users.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(User $user, Request $request)
	{
		$this->validate($request, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255'						
		]);
		
		$admin = ($request['admin'] == "1")?true:false;
			
		$user->name = $request['name'];
		$user->email = $request['email'];		
		$user->admin = $admin;
		
		$user->save();
		
		return redirect('users')->with('flash_message', 'The user account for '.$request['name'].' was updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(User $user)
	{
		// Need to look at this.  Do not want invoices to be 
		// deleted when a user is deleted.  Add an active flag so that
		// an inactive user cannot access the records.  Then create
		// a job to go through and remove old records and users.
	}

}
