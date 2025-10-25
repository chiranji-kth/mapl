<?php

Route::group(['middleware' => ['preventbackbutton','auth']], function(){

    Route::group(['prefix' => 'Order'], function () {
        Route::get('/',['as' => 'order.index', 'uses'=>'Order\OrderController@index']);
        
        Route::get('/create',['as' => 'order.create', 'uses'=>'Order\OrderController@create']);
        Route::post('/',['as' => 'order.store', 'uses'=>'Order\OrderController@store']);
        Route::get('/{order}/edit',['as'=>'order.edit','uses'=>'Order\OrderController@edit']);
        Route::put('/{order}',['as' => 'order.update', 'uses'=>'Order\OrderController@update']);
        Route::delete('/{order}/delete',['as'=>'order.delete','uses'=>'Order\OrderController@destroy']);
        Route::get('/updateStatus', 'Lead\LeadController@updateStatus');
    });
    

});

