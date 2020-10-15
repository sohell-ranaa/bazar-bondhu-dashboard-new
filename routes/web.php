<?php

Route::get('admin/login', ['as' => 'ekom-login', 'uses' => 'admin\AdminLoginController@showLoginForm']);
Route::post('admin/check-login', ['as' => 'check-ekom-login', 'uses' => 'admin\AdminLoginController@login']);
Route::post('admin/logout', 'admin\AdminLoginController@logout')->name('admin-logout');


Route::get('/', 'HomeController@dashboard');

Route::get('/getupazila', 'HomeController@getUpazila');

Route::middleware(['adminAuth'])->group(function () {

    Route::get('admin', 'HomeController@dashboard');
    Route::get('mm-list', 'HomeController@MmList');
    Route::get('transacting-non-transacting-mms', 'HomeController@transactingNonTransacting'); //t_n_t_mms
    Route::get('transaction-list', 'HomeController@transactionList');
    Route::get('strmte-mngmnt', 'HomeController@strmte_mngmnt');
    Route::get('order-track', 'HomeController@orderTrack');
});

?>
