<?php

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

Route::group(['prefix'=> 'admin','middleware' => 'auth.checkrole', 'as' =>'admin.'], function (){
    // CATEGORIAS
    Route::get('categories',['as'=> 'categories.index', 'uses' => 'CategoriesController@index']);
    Route::get('categories/create', ['as'=>'categories.create','uses'=>'CategoriesController@create']);
    Route::get('categories/edit/{id}', ['as'=>'categories.edit', 'uses'=>'CategoriesController@edit']);
    Route::post('categories/update/{id}', ['as'=>'categories.update', 'uses'=>'CategoriesController@update']);
    Route::post('categories/store', ['as'=>'categories.store', 'uses'=>'CategoriesController@store']);

    // PRODUTOS
    Route::get('products',['as'=> 'products.index', 'uses' => 'ProductsController@index']);
    Route::get('products/create', ['as'=>'products.create','uses'=>'ProductsController@create']);
    Route::get('products/edit/{id}', ['as'=>'products.edit', 'uses'=>'ProductsController@edit']);
    Route::post('products/update/{id}', ['as'=>'products.update', 'uses'=>'ProductsController@update']);
    Route::post('products/store', ['as'=>'products.store', 'uses'=>'ProductsController@store']);
    Route::get('products/delete/{id}', ['as'=>'products.destroy', 'uses'=>'ProductsController@destroy']);

    //clientes
    Route::get('clients',['as'=> 'clients.index', 'uses' => 'ClientsController@index']);
    Route::get('clients/create', ['as'=>'clients.create','uses'=>'ClientsController@create']);
    Route::get('clients/edit/{id}', ['as'=>'clients.edit', 'uses'=>'ClientsController@edit']);
    Route::post('clients/update/{id}', ['as'=>'clients.update', 'uses'=>'ClientsController@update']);
    Route::post('clients/store', ['as'=>'clients.store', 'uses'=>'ClientsController@store']);
    Route::get('clients/delete/{id}', ['as'=>'clients.destroy', 'uses'=>'ClientsController@destroy']);

    //pedidos ou orders
    Route::get('orders',['as'=> 'orders.index', 'uses' => 'OrdersController@index']);
    Route::get('orders/edit/{id}', ['as'=>'orders.edit', 'uses'=>'OrdersController@edit']);
    Route::post('orders/update/{id}', ['as'=>'orders.update', 'uses'=>'OrdersController@update']);


    //pedidos ou orders
    Route::get('cupoms',['as'=> 'cupoms.index', 'uses' => 'CupomsController@index']);
    Route::get('cupoms/create', ['as'=>'cupoms.create', 'uses'=>'CupomsController@create']);
    Route::post('cupoms/store', ['as'=>'cupoms.store', 'uses'=>'CupomsController@store']);
});

Route::group(['prefix'=>'costumer', 'as' => 'customer.'], function(){

    //checkout
    Route::get('order' , ['as' => 'order.index', 'uses' => 'CkeckoutController@index']);
    Route::get('order/create' , ['as' => 'order.create', 'uses' => 'CkeckoutController@create']);
    Route::post('order/store' , ['as' => 'order.store', 'uses' => 'CkeckoutController@store']);

});








