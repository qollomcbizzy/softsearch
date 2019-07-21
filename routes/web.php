<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware('auth')->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/companies','MRCM\CompaniesController@index')->name('companies');
    Route::get('/add/company','MRCM\CompaniesController@create')->name('addcompany');
    Route::get('/add/employee','MRCM\EmployeesController@create')->name('addemployee');
    Route::post('/company/add','MRCM\CompaniesController@store')->name('addcompany.post');
    Route::post('/employee/add','MRCM\EmployeesController@store'); 
    Route::get('/employees','MRCM\EmployeesController@index')->name('employees'); 
    Route::get('/company/edit/{id}','MRCM\CompaniesController@edit');
    Route::get('/company/view/{id}','MRCM\CompaniesController@show');
    Route::get('/employee/{id}/edit','MRCM\EmployeesController@edit')->name('employee.edit');
    Route::get('/employee/{id}/view','MRCM\EmployeesController@show')->name('employee.view'); 
    Route::post('/company/{id}/update','MRCM\CompaniesController@update')->name('editcompany.post');
    Route::post('/employee/{id}/update','MRCM\EmployeesController@update');
    Route::get('/company/{id}/delete','MRCM\CompaniesController@destroy')->name('company.delete'); 
    Route::get('/employee/{id}/delete','MRCM\EmployeesController@destroy')->name('employee.delete'); 

});
