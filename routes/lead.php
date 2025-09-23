<?php

Route::group(['middleware' => ['preventbackbutton','auth']], function(){

    Route::group(['prefix' => 'lead'], function () {
        Route::get('/',['as' => 'lead.index', 'uses'=>'Lead\LeadController@index']);
        
        Route::get('/create',['as' => 'lead.create', 'uses'=>'Lead\LeadController@create']);
        Route::post('/',['as' => 'lead.store', 'uses'=>'Lead\LeadController@store']);
        Route::get('/{lead}/edit',['as'=>'lead.edit','uses'=>'Lead\LeadController@edit']);
        Route::put('/{lead}',['as' => 'lead.update', 'uses'=>'Lead\LeadController@update']);
        Route::delete('/{lead}/delete',['as'=>'lead.delete','uses'=>'Lead\LeadController@destroy']);
        Route::get('/updateStatus', 'Lead\LeadController@updateStatus');
        Route::get('/{lead}/followup',['as'=>'lead.followup','uses'=>'Lead\LeadController@followup']);
        // Route::post('/{lead}/followup',['as' => 'lead.storefollowup', 'uses'=>'Lead\LeadController@storefollowup']);
    });
    

});

