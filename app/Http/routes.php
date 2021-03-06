<?php
use App\Models\Invoice;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', [
    'as' => 'home',
    'uses' => 'PagesController@home'
]);

Route::resource('invoices', 'InvoicesController');
Route::resource('hospitals', 'HospitalsController');
Route::resource('professions', 'ProfessionsController');
Route::resource('professionals', 'ProfessionalsController');
Route::resource('hospitalInformation', 'HospitalInformationController');
Route::resource('staffInformation', 'StaffInformationController');
Route::resource('patientInformation', 'PatientInformationController');
Route::resource('procedureInformation', 'ProcedureInformationController');
Route::resource('labInformation', 'LabInformationController');
Route::resource('processingInformation', 'ProcessingInformationController');
Route::resource('procedureTotals', 'ProcedureTotalsController');
Route::resource('equipment', 'EquipmentController');
Route::resource('transfusionServices', 'TransfusionServicesController');
Route::resource('transfusionSupplies', 'TransfusionSuppliesController');
Route::resource('users', 'UsersController');

Route::get('invoices/{invoices}/editInvoice/{invoiceSection}', ['as'=>'editInvoice', 'uses'=>'InvoicesController@editInvoice']);
Route::get('staffInformation/{invoices}/editInvoice/{invoiceSection}', ['as'=>'editInvoice', 'uses'=>'StaffInformationController@editInvoice']);
Route::get('patientInformation/{invoices}/editInvoice/{invoiceSection}', ['as'=>'editInvoice', 'uses'=>'PatientInformationController@editInvoice']);
Route::get('procedureInformation/{invoices}/editInvoice/{invoiceSection}', ['as'=>'editInvoice', 'uses'=>'ProcedureInformationController@editInvoice']);
Route::get('labInformation/{invoices}/editInvoice/{invoiceSection}', ['as'=>'editInvoice', 'uses'=>'LabInformationController@editInvoice']);
Route::get('processingInformation/{invoices}/editInvoice/{invoiceSection}', ['as'=>'editInvoice', 'uses'=>'ProcessingInformationController@editInvoice']);
Route::get('procedureTotals/{invoices}/editInvoice/{invoiceSection}', ['as'=>'editInvoice', 'uses'=>'ProcedureTotalsController@editInvoice']);
Route::get('equipment/{invoices}/editInvoice/{invoiceSection}', ['as'=>'editInvoice', 'uses'=>'EquipmentController@editInvoice']);
Route::get('transfusionServices/{invoices}/editInvoice/{invoiceSection}', ['as'=>'editInvoice', 'uses'=>'TransfusionServicesController@editInvoice']);
Route::get('transfusionSupplies/{invoices}/editInvoice/{invoiceSection}', ['as'=>'editInvoice', 'uses'=>'TransfusionSuppliesController@editInvoice']);
Route::patch('processingInformation/{invoices}/updateProcessingInformation', ['as'=>'processingInformation.updateProcessingInformation', 'uses'=>'ProcessingInformationController@updateProcessingInformation']);
Route::get('startInvoiceProcess/{invoice_id}/{process_step}', ['as'=>'startInvoiceProcess', 'uses'=>'InvoicesController@startInvoiceProcess']);
Route::get('previousProcessStep/{invoice_id}', ['as'=>'previousProcessStep', 
    function($invoice_id)
    {        
        $current_process_step = Session::get('current_process_step');
        return SetupProcessStep($invoice_id, $current_process_step - 1);
    }]);

// For authentication
Route::controllers(['auth'=>'Auth\AuthController', 'password'=>'Auth\PasswordController']);
Route::post('uploadFiles', ['as'=>'uploadFiles', 'uses'=>'InvoiceFilesController@store']);
Route::get('downloadFile/{invoiceFile}', ['as'=>'downloadFile', 'uses'=>'InvoiceFilesController@downloadFile']);
Route::patch('invoices/{invoices}/complete', ['as'=>'completeInvoice', 'uses'=>'InvoicesController@completeInvoice']);
Route::group(array('prefix'=>'api/v1', 'middleware'=>'auth.api'), function()
{
    Route::get('billing/completedInvoices/{showHeaders?}', ['as'=>'completedInvoices', 'uses'=>'BillingController@index']);
    Route::patch('billing/billInvoices', ['uses'=>'BillingController@update']);
});