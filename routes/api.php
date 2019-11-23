<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/departments', 'DepartmentController@index');
Route::post('/departments', 'DepartmentController@store');
Route::get('/departments/{department}', 'DepartmentController@show');
Route::get('/departments/{department}/requisitions', 'DepartmentController@indexRequisitions');
Route::patch('/departments/{department}', 'DepartmentController@update');
Route::delete('/departments/{department}', 'DepartmentController@destroy');

Route::get('/requisitions', 'RequisitionController@index');
Route::post('/requisitions', 'RequisitionController@store');
Route::get('/requisitions/{requisition}', 'RequisitionController@show');
Route::patch('/requisitions/{requisition}', 'RequisitionController@update');
Route::delete('/requisitions/{requisition}', 'RequisitionController@destroy');

Route::get('/tenders', 'TenderController@index');
Route::post('/tenders', 'TenderController@store');
Route::get('/tenders/{tender}', 'TenderController@show');
Route::get('/tenders/{tender}/orders', 'TenderController@indexOrders');
Route::get('/tenders/{tender}/payments', 'TenderController@indexPayments');
Route::patch('/tenders/{tender}', 'TenderController@update');
Route::delete('/tenders/{tender}', 'TenderController@destroy');

Route::get('/suppliers', 'SupplierController@index');
Route::post('/suppliers', 'SupplierController@store');
Route::get('/suppliers/{supplier}', 'SupplierController@show');
Route::get('/suppliers/{supplier}/orders', 'SupplierController@indexOrders');
Route::get('/suppliers/{supplier}/tenders', 'SupplierController@indexTender');
Route::get('/suppliers/{supplier}/payments', 'SupplierController@indexPayments');
Route::patch('/suppliers/{supplier}', 'SupplierController@update');
Route::delete('/suppliers/{supplier}', 'SupplierController@destroy');

Route::get('/orders', 'OrderController@index');
Route::post('/orders', 'OrderController@store');
Route::get('/orders/{order}', 'OrderController@show'); // eager load payments
Route::get('/orders/{order}/payments', 'OrderController@indexPayments');
Route::patch('/orders/{order}', 'OrderController@update');
Route::delete('/orders/{order}', 'OrderController@destroy');

Route::get('/payments', 'PaymentController@index');
Route::post('/payments', 'PaymentController@store');
Route::get('/payments/{payment}', 'PaymentController@show');
Route::patch('/payments/{payment}', 'PaymentController@update');
Route::delete('/payments/{payment}', 'PaymentController@destroy');
