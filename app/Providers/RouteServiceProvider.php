<?php namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider {

	/**
	 * This namespace is applied to the controller routes in your routes file.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'App\Http\Controllers';

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function boot(Router $router)
	{
		parent::boot($router);
		$router->model('hospitals', 'App\Models\Hospital');
        $router->model('professions', 'App\Models\Profession');
        $router->model('professionals', 'App\Models\Professional');
		$router->model('invoices', 'App\Models\Invoice');
		$router->model('staffInformation', 'App\Models\StaffInformation');
		$router->model('patientInformation', 'App\Models\PatientInformation');
		$router->model('procedureInformation', 'App\Models\ProcedureInformation');
		$router->model('labInformation', 'App\Models\LabInformation');
		$router->model('processingInformation', 'App\Models\ProcessingInformation');
		$router->model('procedureTotals', 'App\Models\ProcedureTotals');
		$router->model('equipment', 'App\Models\Equipment');
		$router->model('transfusionServices', 'App\Models\TransfusionServices');
		$router->model('transfusionSupplies', 'App\Models\TransfusionSupplies');
		$router->model('invoiceSection', 'App\Models\InvoiceSection');
		$router->model('users', 'App\User');
        $router->model('invoiceFile', 'App\Models\InvoiceFile');
		//
	}

	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function map(Router $router)
	{
		$router->group(['namespace' => $this->namespace], function($router)
		{
			require app_path('Http/routes.php');
		});
	}

}
