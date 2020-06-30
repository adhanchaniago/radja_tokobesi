<?php

Route::get('/', 'Admin\AuthController@index')->name('auth.index');
Route::post('/login', 'Admin\AuthController@login')->name('log.login');
Route::get('/logout', 'Admin\AuthController@logout')->name('log.logout');
Route::get('/register', 'Admin\RegisterController@index')->name('register.index');
Auth::routes();

//Sosmed
Route::get('auth/{provider}', 'Auth\SocialController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\SocialController@handleProviderCallback');
Route::group(['middleware' => 'auth'], function () {
    Route::prefix('admin')->group(function(){
    //Master
        Route::get('/', 'Admin\HomeController@index');
        Route::get('/category/table', 'Admin\CategoryController@table')->name('category.table');
        Route::resource('/category', 'Admin\CategoryController');
        Route::resource('/akses', 'Admin\AksesController');
        Route::resource('/item', 'Admin\ProductController');
        Route::resource('/supplier', 'Admin\SupplierController');
        Route::resource('/order', 'Admin\OrderController');
        Route::resource('/payment', 'Admin\PaymentController');
        Route::resource('/user', 'Admin\UserController');
        Route::resource('/cabang', 'Admin\CabangController');
        Route::resource('/credit', 'Admin\CreditController');
        Route::resource('/role', 'Admin\RoleController');
        Route::post('/email/{id}','Admin\OrderController@sendmail')->name('order.mail');

    //Master cetak (item)
        Route::get('/item/pdf', 'Admin\ProductController@pdf')->name('product.item.pdf');
        Route::get('/item/excel', 'Admin\ProductController@excel')->name('product.item.excel');
        Route::get('/item/download', 'Admin\ProductController@download')->name('product.item.download');

    // Master kas
        Route::resource('/kas', 'Admin\KasController');
        Route::resource('/request/kas', 'Admin\KasController');

    // Master request
        Route::resource('/restock', 'Admin\RestockController');
        Route::patch('/restock/{id}/status', 'Admin\RestockController@status')->name('restock.status');
        Route::patch('/restock/{id}/stock', 'Admin\RestockController@stock')->name('restock.stock');
        Route::patch('/restock/{id}/produk', 'Admin\RestockController@produk')->name('restock.produk');
        Route::post('/akses/show', 'Admin\AksesController@show')->name('akses.show');
        Route::post('/restock/create', 'Admin\RestockController@store2')->name('restock.store2');

    // import barang
        Route::post('import', 'Admin\ProductController@import')->name('item.import');

	//PDF
        Route::get('/supplier/pdf', 'Admin\SupplierController@pdf')->name('supplier.pdf');
        Route::get('/report', 'Admin\ReportController@index')->name('report.index');
        Route::get('/report/pdf', 'Admin\ReportController@pdf')->name('report.pdf');
        Route::get('/report/excel', 'Admin\ReportController@excel')->name('report.excel');
        Route::get('/report/download', 'Admin\ReportController@download')->name('report.download');

        Route::delete('myproductsDeleteAll', 'Admin\ProductController@deleteAll');
        Route::delete('multiplerecordsdelete', 'Admin\ProductController@multiplerecordsdelete');
    });

    Route::get('/home', 'Admin\HomeController@index')->name('home');


    Route::get('/home', 'Admin\HomeController@index')->name('home');
});