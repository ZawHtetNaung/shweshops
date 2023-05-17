<?php
//for superadmin

Route::group(['prefix' => 'backside/super_admin', 'as' => 'backside.super_admin.'], function () {
    //for facebook data
    Route::get('fbdata/messenger/list', 'super_admin\FbdataController@list');
    Route::get('fbdata/messenger/getall', 'super_admin\FbdataController@getall');
    Route::post('fbdata/messenger/getcount', 'super_admin\FbdataController@getcount');



//    auth
//    cat

    Route::get('support/cat/create', 'super_admin\CatController@createform');
    Route::post('support/cat/create', 'super_admin\CatController@store');
    Route::get('support/cat/list', 'super_admin\CatController@list');
    Route::post('support/cat/delete', 'super_admin\CatController@delete');
    Route::get('support/cat/edit/{id}', 'super_admin\CatController@edit');
    Route::post('support/cat/edit/{id}', 'super_admin\CatController@update');


    //help and support
    Route::get('support/create', 'super_admin\SupportController@createform');
    Route::post('support/create', 'super_admin\SupportController@store');
    Route::get('support/list', 'super_admin\SupportController@list');
    Route::get('support/all', 'super_admin\SupportController@all');
    Route::get('support/detail/{id}', 'super_admin\SupportController@detail');
    Route::post('support/delete/{id}', 'super_admin\SupportController@delete');
    Route::get('support/edit/{id}', 'super_admin\SupportController@edit');
    Route::post('support/update/{id}', 'super_admin\SupportController@update');

    //help and support

    Route::get('tooltips/create', 'super_admin\tooltipsController@createform');
    Route::post('tooltips/create', 'super_admin\tooltipsController@store');
    Route::get('tooltips/list', 'super_admin\tooltipsController@list');
    Route::get('tooltips/all', 'super_admin\tooltipsController@all');
    Route::get('tooltips/detail/{id}', 'super_admin\tooltipsController@detail');
    Route::post('tooltips/delete/{id}', 'super_admin\tooltipsController@delete');
    Route::get('tooltips/edit/{id}', 'super_admin\tooltipsController@edit');
    Route::post('tooltips/update/{id}', 'super_admin\tooltipsController@update');

    Route::post('all_counts', 'super_admin\SuperAdminController@all_counts');


    Route::get('directory/create', 'super_admin\DirectoryController@createform');
    Route::post('directory/create', 'super_admin\DirectoryController@store');
    Route::get('directory/alldirect', 'super_admin\DirectoryController@alldirectory');
    Route::get('directory/detail/{id}', 'super_admin\DirectoryController@detail');
    Route::get('directory/edit/{id}', 'super_admin\DirectoryController@editform');
    Route::post('directory/edit', 'super_admin\DirectoryController@update');
    Route::post('directory/delete', 'super_admin\DirectoryController@delete');
    Route::get('directory/all', 'super_admin\DirectoryController@alltable');
    Route::get('directory/get_township', 'super_admin\DirectoryController@gettownship');
    Route::get('directory/check_shop_directory_name', 'super_admin\DirectoryController@check_shop_directory_name');


// Route::get('register', ['as' => 'register', 'uses' => 'Auth\SuperadminRegisterController@create']);
Route::get('register', function(){
    return abort(404);
});
// Route::post('register', ['as' => 'registered', 'uses' => 'Auth\SuperadminRegisterController@store']);
Route::put('approve/{id}', ['as' => 'approve', 'uses' => 'super_admin\SuperAdminController@approve']);
Route::put('ban/{id}', ['as' => 'banned', 'uses' => 'super_admin\SuperAdminController@isBanned']);
//    auth
Route::get('login', ['as' => 'login', 'uses' => 'Auth\SuperadminLoginController@loginform']);
Route::post('login', ['as' => 'logined', 'uses' => 'Auth\SuperadminLoginController@login']);

Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\SuperadminLoginController@logout']);
Route::get('items/getitemsajax', 'super_admin\ItemsController@getitemsajax');
Route::post('items/total_create_count', 'super_admin\ItemsController@total_create_count');
Route::get('items/all', 'super_admin\ItemsController@all');

Route::resources([
    '/' => 'super_admin\SuperAdminController',
    '/ads' => 'super_admin\AdsController',
    '/promotion' => 'super_admin\PromotionController',
    '/news' => 'super_admin\NewsController',
    '/events' => 'super_admin\EventsController',
]);

//for message
    Route::prefix('messages')->group(function () {
        Route::get('showexpire', 'super_admin\SuperadminMessage@showallexpire');
        Route::get('getexpire', 'super_admin\SuperadminMessage@getexpire');
        Route::delete('deletebyone/{id}', 'super_admin\SuperadminMessage@deletebyone')->name('delete');
        Route::post('deletemultiple', 'super_admin\SuperadminMessage@deletebyone');


    });


});




Route::get('backside/super_admin/get_all_ads', 'super_admin\AdsController@getAllAds')->name('ads.getAllAds');
Route::get('backside/super_admin/get_ads_activity', 'super_admin\AdsController@getAdsActivity')->name('ads.getAdsActivity');
Route::post('backside/super_admin/ads_video', 'super_admin\AdsController@store_video')->name('ads.video.create');


// zh for Shop
Route::get('backside/super_admin/shops/all','super_admin\ShopController@all')->name('shops.all');
Route::get('backside/super_admin/shops/get_all_shops', 'super_admin\ShopController@getAllShops')->name('shops.getAllShops');

Route::get('backside/super_admin/shops/create','Auth\ShopownerRegisterController@create')->name('shops.create');
Route::get('backside/super_admin/shops/edit/{id}','Auth\ShopownerRegisterController@edit')->name('shops.edit');
Route::put('backside/super_admin/shops/edit/{id}','Auth\ShopownerRegisterController@update')->name('shops.update');

// for website viewer
Route::get('backside/super_admin/visitorcount/all', 'super_admin\SuperAdminController@visitorcount')->name('visitorcount.all');
Route::get('backside/super_admin/visitorcount/get_all_visitor', 'super_admin\SuperAdminController@getAllVisitor')->name('visitorcount.getAllVisitor');

// for ads view
Route::get('backside/super_admin/adscount/all', 'super_admin\SuperAdminController@adscount')->name('adscount.all');
Route::get('backside/super_admin/adscount/get_all_adscount', 'super_admin\SuperAdminController@getAllAdsCount')->name('adscount.getAllAdsCount');

// for shops viewer
Route::get('backside/super_admin/shopviewercount/all', 'super_admin\SuperAdminController@shopviewercount')->name('shopviewercount.all');
Route::get('backside/super_admin/shopviewercount/get_all_shopviewercount', 'super_admin\SuperAdminController@getAllShopviewerCount')->name('shopviewercount.getAllShopviewerCount');

// for buy now count
Route::get('backside/super_admin/buynowcount/all', 'super_admin\SuperAdminController@buynowcount')->name('buynowcount.all');
Route::get('backside/super_admin/buynowcount/get_all_buynowcount', 'super_admin\SuperAdminController@getAllBuyNowCount')->name('buynowcount.getAllBuyNowCount');

// for add to cart count
Route::get('backside/super_admin/addtocartcount/all', 'super_admin\SuperAdminController@addtocartcount')->name('addtocartcount.all');
Route::get('backside/super_admin/addtocartcount/get_all_addtocartcount', 'super_admin\SuperAdminController@getAllAddtocartCount')->name('addtocartcount.getAllAddtocartCount');

// for wish list count
Route::get('backside/super_admin/wishlistcount/all', 'super_admin\SuperAdminController@wishlistcount')->name('wishlistcount.all');
Route::get('backside/super_admin/wishlistcount/get_all_wishlistcount', 'super_admin\SuperAdminController@getAllWishlistCount')->name('wishlistcount.getAllWishlistCount');

// zh for dailycount
Route::get('backside/super_admin/productdailycount/all','super_admin\SuperAdminController@productdailycount')->name('productdailycount.all');
Route::delete('backside/super_admin/productdailycount/clear','super_admin\SuperAdminController@productdailycount_clear')->name('productdailycount.clear');
Route::get('backside/super_admin/shopdailycount/all','super_admin\SuperAdminController@shopdailycount')->name('shopdailycount.all');
Route::delete('backside/super_admin/shopdailycount/clear','super_admin\SuperAdminController@shopdailycount_clear')->name('shopdailycount.clear');
Route::get('backside/super_admin/daily_shop_create_log', 'super_admin\DailyLogsController@daily_shop_create_log');
Route::post('backside/super_admin/daily_shop_create_delselected', 'super_admin\DailyLogsController@daily_shop_create_delselected');
Route::post('backside/super_admin/daily_shop_create_delall', 'super_admin\DailyLogsController@daily_shop_create_delall');
Route::post('backside/super_admin/total_create_count', 'super_admin\DailyLogsController@total_create_count');

Route::get('backside/super_admin/getalldailyshopcreatecounts', 'super_admin\DailyLogsController@getalldailyshopcreatecounts');


//shop delete section

Route::delete('backside/super_admin/shops/delete/{id}','super_admin\ShopController@trash')->name('shops.trash');
Route::post('backside/super_admin/shops/multiple_delete/','super_admin\ShopController@shops_multiple_delete')->name('shops.multiple_delete');
Route::get('backside/super_admin/shops/trash','super_admin\ShopController@get_trash')->name('shops.all_trash');
Route::get('backside/super_admin/shops/get_all_trash_shop', 'super_admin\ShopController@get_all_trash_shop')->name('shops.get_all_trash_shop');
Route::post('backside/super_admin/shops/trash/{id}','super_admin\ShopController@restore')->name('shops.restore');
Route::delete('backside/super_admin/shops/forceDelete/{id}','super_admin\ShopController@force_delete')->name('shops.force_delete');
//shop delete section end

//Shop Detail
Route::get('backside/super_admin/shop_detail/{id}','super_admin\ShopController@show')->name('shops.detail');
Route::get('backside/super_admin/shop_update_action','super_admin\ShopController@counts_setting')->name('shops.update_action');
Route::get('backside/super_admin/shop_update_action_all','super_admin\ShopController@all_counts_setting')->name('shops.update_action_all');
Route::post('backside/super_admin/save_all_report', 'super_admin\ShopController@save_all_report')->name('save_all_report');
Route::get('backside/super_admin/download-zip', 'super_admin\ShopController@downloadZip')->name('report_zip');
Route::get('backside/super_admin/all_monthly_report','super_admin\ShopController@all_report')->name('shop.all_monthly_report');
Route::get('backside/super_admin/monthly_report/{id}','super_admin\ShopController@report')->name('shop.monthly_report');
Route::post('backside/super_admin/date_filter','super_admin\ShopController@count_date_filter');

Route::get('backside/super_admin/shops/get_shop_activity', 'super_admin\ShopController@getShopActivity')->name('shops.getShopActivity');

// zh for super_admin_role
Route::get('backside/super_admin/admins/all','super_admin\Super_admin_roleController@list')->name('super_admin_role.list');
Route::get('backside/super_admin/admins/get_all_admins', 'super_admin\Super_admin_roleController@getAllAdmins')->name('super_admin_role.getAllAdmins');
Route::get('backside/super_admin/admins/get_admin_activity', 'super_admin\Super_admin_roleController@getAdminActivity')->name('super_admin_role.getAdminActivity');
Route::get('backside/super_admin/admins/create','super_admin\Super_admin_roleController@create')->name('super_admin_role.create');
Route::post('backside/super_admin/admins/create','super_admin\Super_admin_roleController@store')->name('super_admin_role.store');
Route::get('backside/super_admin/admins/edit/{id}','super_admin\Super_admin_roleController@edit')->name('super_admin_role.edit');
Route::put('backside/super_admin/admins/edit/{id}','super_admin\Super_admin_roleController@update')->name('super_admin_role.update');
Route::delete('backside/super_admin/adminss/delete/{id}','super_admin\Super_admin_roleController@delete')->name('super_admin_role.delete');

// Sidebar Activities
Route::get('backside/super_admin/daily_shop_create_log', 'super_admin\DailyLogsController@daily_shop_create_log');
Route::get('backside/super_admin/getalldailyshopcreatecounts', 'super_admin\DailyLogsController@getalldailyshopcreatecounts');

Route::get('backside/super_admin/activity_logs/customers', 'super_admin\CustomerController@activity_index')->name('activity.customer');
Route::get('backside/super_admin/activity_logs/ads', 'super_admin\AdsController@activity_index')->name('activity.ads');
Route::get('backside/super_admin/activity_logs/shop', 'Auth\ShopownerRegisterController@activity_index')->name('activity.shop');
Route::get('backside/super_admin/activity_logs/admin', 'super_admin\Super_admin_roleController@activity_index')->name('activity.admin');

// Customers
Route::get('backside/super_admin/customers', 'super_admin\CustomerController@index')->name('customers.index');
Route::get('backside/super_admin/get_customers', 'super_admin\CustomerController@getCustomers')->name('customers.getCustomers');
Route::get('backside/super_admin/get_customer_activity', 'super_admin\CustomerController@getCustomerActivity')->name('customers.getCustomerActivity');


//contact us
Route::get('backside/super_admin/Contact-us/edit','super_admin\SuperAdminController@contactus_get')->name('superAdmin.contactus_get');
Route::put('backside/super_admin/Contact-us/edit','super_admin\SuperAdminController@contactus_update')->name('superAdmin.contactus_update');

//site setting
Route::get('backside/super_admin/sitesetting', 'super_admin\SiteSettingController@index')->name('superadmin.sitesetting');
Route::get('backside/super_admin/sitesetting/edit', 'super_admin\SiteSettingController@updateAction')->name('superadmin.update_action');

//shop_owner_using chat
Route::get('backside/super_admin/shop_owner_using_chat','super_admin\ShopController@showowner_using_chat');
Route::get('backside/super_admin/showowner_using_chat_detail/{id}','super_admin\ShopController@showowner_using_chat_detail')->name('showowner_using_chat_detail');
Route::get('backside/super_admin/shopowner_chat_count_detail/{id}','super_admin\ShopController@shopowner_chat_count_detail')->name('shopowner_chat_count_detail');
Route::get('backside/super_admin/shops/get_all_using_chat', 'super_admin\ShopController@showowner_using_chat_all')->name('shops.showowner_using_chat_all');
Route::get('backside/super_admin/shops/product_code_search', 'super_admin\ShopController@shopowner_chat_product_code_search')->name('shops.shopowner_using_chat_search');
//for superadmin

//points
Route::get('backside/super_admin/point','super_admin\CustomerController@point');
Route::post('backside/super_admin/point/update','super_admin\CustomerController@point_update');

Route::get('backside/super_admin/gold_points','super_admin\CustomerController@gold_point')->name('gold_point');

Route::post('backside/super_admin/gold_point/create','super_admin\CustomerController@gold_point_store');

Route::get('backside/super_admin/gold_points/edit/{id}','super_admin\CustomerController@gold_point_edit')->name('gold_point.edit');
Route::put('backside/super_admin/gold_points/update/{id}','super_admin\CustomerController@gold_point_update')->name('gold_point.update');

// baydin
Route::resource('baydins', 'super_admin\SignController');

Route::post('/delete_sign', 'super_admin\SignController@delete_sign')->name('delete_sign');

?>
