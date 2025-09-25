<?php

Route::group(['middleware' => ['preventbackbutton', 'auth']], function () {

    Route::group(['prefix' => 'customer'], function () {
        Route::get('/', ['as' => 'customer.index', 'uses' => 'Customer\CustomerController@index']);

        Route::get('/create', ['as' => 'customer.create', 'uses' => 'Customer\CustomerController@create']);
        Route::post('/', ['as' => 'customer.store', 'uses' => 'Customer\CustomerController@store']);
        Route::get('/{customer}/edit', ['as' => 'customer.edit', 'uses' => 'Customer\CustomerController@edit']);
        Route::put('/{customer}', ['as' => 'customer.update', 'uses' => 'Customer\CustomerController@update']);
        Route::delete('/{customer}/delete', ['as' => 'customer.delete', 'uses' => 'Customer\CustomerController@destroy']);
        Route::get('/updateStatus', 'Lead\LeadController@updateStatus');
    });


    Route::group(['prefix' => 'company'], function () {
        Route::get('/', ['as' => 'company.index', 'uses' => 'Customer\CompanyController@index']);

        Route::get('/create', ['as' => 'company.create', 'uses' => 'Customer\CompanyController@create']);
        Route::post('/', ['as' => 'company.store', 'uses' => 'Customer\CompanyController@store']);
        Route::get('/{company}', ['as' => 'company.show', 'uses' => 'Customer\CompanyController@show']);
        Route::get('/{company}/edit', ['as' => 'company.edit', 'uses' => 'Customer\CompanyController@edit']);
        Route::put('/{company}', ['as' => 'company.update', 'uses' => 'Customer\CompanyController@update']);
        Route::delete('/{company}/delete', ['as' => 'company.delete', 'uses' => 'Customer\CompanyController@destroy']);
        // Route::get('/updateStatus', 'Lead\LeadController@updateStatus');
        Route::get('/toggle-status/{id}', ['as' => 'company.toggleStatus', 'uses' => 'Customer\CompanyController@toggleStatus']);
    });

    Route::group(['prefix' => 'quotation'], function () {
        Route::get('/', ['as' => 'quotation.index', 'uses' => 'Customer\QuotationController@index']);

        Route::get('/create', ['as' => 'quotation.create', 'uses' => 'Customer\QuotationController@create']);
        Route::post('/', ['as' => 'quotation.store', 'uses' => 'Customer\QuotationController@store']);
        Route::get('quotation/{id}', ['as' => 'quotation.show', 'uses' => 'Customer\QuotationController@show']);
        Route::get('/{company}/edit', ['as' => 'quotation.edit', 'uses' => 'Customer\QuotationController@edit']);
        Route::put('/{company}', ['as' => 'quotation.update', 'uses' => 'Customer\QuotationController@update']);
        Route::delete('/{company}/delete', ['as' => 'quotation.delete', 'uses' => 'Customer\QuotationController@destroy']);
        Route::get('quotation/export/{id}', ['as' => 'quotation.export', 'uses' => 'Customer\QuotationController@export']);
    });

    Route::group(['prefix' => 'invoice'], function () {
        Route::get('/', ['as' => 'invoice.index', 'uses' => 'Customer\InvoiceController@index']);

        Route::get('/create', ['as' => 'invoice.create', 'uses' => 'Customer\InvoiceController@create']);
        Route::post('/', ['as' => 'invoice.store', 'uses' => 'Customer\InvoiceController@store']);
        Route::get('invoice/{id}', ['as' => 'invoice.show', 'uses' => 'Customer\InvoiceController@show']);
        Route::get('/{company}/edit', ['as' => 'invoice.edit', 'uses' => 'Customer\InvoiceController@edit']);
        Route::put('/{company}', ['as' => 'invoice.update', 'uses' => 'Customer\InvoiceController@update']);
        Route::delete('/{company}/delete', ['as' => 'invoice.delete', 'uses' => 'Customer\InvoiceController@destroy']);
        Route::get('invoice/export/{id}', ['as' => 'invoice.export', 'uses' => 'Customer\InvoiceController@export']);
    });
});
