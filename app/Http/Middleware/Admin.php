<?php namespace App\Http\Middleware;
use Auth;
use Closure;

class Admin {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if(Auth::user()->admin == true)
		{
			return $next($request);
		}
		else
		{
			return redirect("/")->withErrors(["You are not authorized to view this page."]);	
		}		
	}

}
