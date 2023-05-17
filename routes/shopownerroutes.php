<?php
    Route::group(['prefix' => 'backside/shop_owner', 'as' => 'backside.shop_owner.'], function () {
    //    auth
    //         Route::get('register', ['as' => 'register', 'uses' => 'Auth\ShopownerRegisterController@create']);
    Route::post('register', ['as' => 'registered', 'uses' => 'Auth\ShopownerRegisterController@store']);

    //    auth
    Route::get('pos/login/{from?}', ['as' => 'login', 'uses' => 'Auth\ShopownerLoginController@loginform']);
    Route::post('login', ['as' => 'logined', 'uses' => 'Auth\ShopownerLoginController@login']);
        
    //pos login form
    Route::get('/pos/login', ['as' => 'pos_login', 'uses' => 'Auth\ShopownerLoginController@pos_login_form']);
    Route::post('/pos/login', ['as' => 'pos_logined', 'uses' => 'Auth\ShopownerLoginController@pos_login']);

    Route::post('/price_only_update', 'Shopowner\ItemsController@only_price_update')->name('price_only_update');

    //forgot password owner

        Route::get('pos/forgot_password', ['as' => 'forgot_password', 'uses' => 'Auth\YkforgotpasswordController@showLinkRequestForm']);
        Route::post('forgot_password', ['as' => 'send_reset_code', 'uses' => 'Auth\YkforgotpasswordController@send_reset_code_form']);

        Route::put('forgot_password', ['as' => 'send_reset_code', 'uses' => 'Auth\YkforgotpasswordController@codeCheck']);
        Route::post('add_new_password', ['as' => 'add_new_password', 'uses' => 'Auth\YkforgotpasswordController@add_new_password']);
        //reg ph confirmation
        Route::get('/support', 'Shopowner\ShopownersupportController@index');


        Route::post('/get_support_by_cat', 'Shopowner\ShopownersupportController@get_support_by_cat');
        Route::post('/get_support', 'Shopowner\ShopownersupportController@get_support');
        Route::resource('/', 'Shopowner\ShopownerController');
        Route::resource('/items', 'Shopowner\ItemsController');
        Route::get('/get_item_activity_log', 'Shopowner\ItemsController@getItemActivityLog')->name('items.getitems_activity_log');
        Route::get('/unique_get_item_activity_log', 'Shopowner\ShopownerController@uniquegetItemActivityLog')->name('items.uniquegetitems_activity_log');
        Route::get('/get_multiple_price_activity_log', 'Shopowner\ItemsController@getMultiplePriceActivityLog')->name('items.getmultiple_price_activity_log');
        Route::get('/get_multiple_discount_activity_log', 'Shopowner\ItemsController@getMultipleDiscountActivityLog')->name('items.getmultiple_discount_activity_log');
        Route::get('/get_multiple_damage_activity_log', 'Shopowner\ItemsController@getMultipleDamageActivityLog')->name('items.getmultiple_damage_activity_log');
        Route::get('/get_items', 'Shopowner\ItemsController@getItems')->name('items.getItems');
        Route::post('/getproductcodebytyping', 'Shopowner\ItemsController@getproductcodebytyping');

        Route::get('/items_trash', 'Shopowner\ItemsController@trash')->name('items.trash');
        Route::get('/get_items_trash', 'Shopowner\ItemsController@getitemsTrash')->name('items.getitemsTrash');
        Route::get('/items_trash/{id}', 'Shopowner\ItemsController@restore')->name('items.restore');
        Route::delete('/items_trash_delete/{id}', 'Shopowner\ItemsController@forceDelete')->name('items.forcedelete');


        // Route::get('/items_trash','Shopowner\ItemsController@trash')->name('items.trash');
        // Route::get('/items_trash/{id}','Shopowner\ItemsController@restore')->name('items.restore');
        // Route::get('/items_trash_delete/{id}','Shopowner\ItemsController@forceDelete')->name('items.forcedelete');
        Route::post('/multipe_discount', 'Shopowner\DiscountController@multiple_discount')->name('items.multiple.discount');
        Route::post('/multipe_unset_discount', 'Shopowner\DiscountController@multiple_unset_discount');
        Route::post('/multiple/plus', 'Shopowner\ItemsController@multiple_update_plus')->name('multiple_items.update_plus');
        Route::post('/multiple/minus', 'Shopowner\ItemsController@multiple_update_minus')->name('multiple_items.update_minus');
        Route::post('/multiple/recap', 'Shopowner\ItemsController@multiple_update_recap')->name('multiple_items.update_recap');
        Route::post('/multiple/stock', 'Shopowner\ItemsController@multiple_stock')->name('multiple.stock.items');
        Route::post('/multiple/checkpriceafterupdateclick', 'Shopowner\ItemsController@checkpriceafterupdateclick')->name('multiple_items.checkpriceafterupdateclick');
        Route::post('/multiple/checkpriceafterdiscountclick', 'Shopowner\DiscountController@checkpriceafterdiscountclick')->name('multiple_items.checkpriceafterdiscountclick');

        //template
        Route::get('/template/create', 'Shopowner\TemplateController@create')->name('items.template.create');
        Route::get('/template/get_template', 'Shopowner\TemplateController@get_template')->name('template.get_template');
        Route::get('/templates', 'Shopowner\TemplateController@index')->name('items.template.list');
        Route::post('/template/create', 'Shopowner\TemplateController@store')->name('items.template.store');
        Route::get('/templates/edit/{id}', 'Shopowner\TemplateController@edit')->name('template.edit');
        Route::patch('/templates/update/{id}', 'Shopowner\TemplateController@update')->name('items.template.update');

        Route::get('/templates/trash/{id}', 'Shopowner\TemplateController@destroy')->name('template.destroy');


        // manager
        Route::get('/users', 'Shopowner\ManagerController@list');
        // for user datable
        Route::get('/get_users_activity_log', 'Shopowner\ManagerController@getUsersActivityLog')->name('users.getusers_activity_Log');
        Route::get('/get_backrole', 'Shopowner\ManagerController@getbackroleActivity')->name('getbackrole');
        Route::get('/get_backrole/detail', 'Shopowner\ManagerController@getbackroleActivityDetail')->name('getbackrole.detail');
        Route::get('/get_itemedit/detail', 'Shopowner\ManagerController@getitemeditActivityDetail')->name('getitemedit.detail');
        Route::get('/get_backroleedit/{id}', 'Shopowner\ManagerController@backRoleEditDetail')->name('backroleedit');
        Route::get('/get_users', 'Shopowner\ManagerController@getUsers')->name('getUsers');
        Route::get('/users/create', 'Shopowner\ManagerController@create');
        Route::post('/users/create', 'Shopowner\ManagerController@store');
        Route::get('/users/edit/{id}', ['as' => 'managers.edit', 'uses' => 'Shopowner\ManagerController@edit']);
        Route::put('/users/edit/{id}', ['as' => 'managers.update', 'uses' => 'Shopowner\ManagerController@update']);
        Route::get('/users/detail/{id}', ['as' => 'managers.detail', 'uses' => 'Shopowner\ManagerController@detail']);
        Route::delete('/users/remove_user/{id}', ['as' => 'managers.remove_user', 'uses' => 'Shopowner\ManagerController@removeuser']);
        Route::get('/users/trash', ['as' => 'managers.restore_list', 'uses' => 'Shopowner\ManagerController@trash']);
        Route::get('/users/restore/{id}', ['as' => 'managers.restore', 'uses' => 'Shopowner\ManagerController@restore']);


        Route::get('/detail', ['as' => 'detail', 'uses' => 'Shopowner\ShopownerController@detail']);
        Route::get('/detail/shop_view', ['as' => 'detail.shop_view', 'uses' => 'Shopowner\ShopownerController@shopview']);
        Route::get('/detail/product_view', ['as' => 'detail.product_view', 'uses' => 'Shopowner\ShopownerController@productview']);
        Route::get('/detail/buy_now_click', ['as' => 'detail.buy_now_click', 'uses' => 'Shopowner\ShopownerController@buynowclick']);
        Route::get('/detail/unique_add_to_cart_click', ['as' => 'detail.unique_add_to_cart_click', 'uses' => 'Shopowner\ShopownerController@uniqueaddtocartclick']);
        Route::get('/detail/unique_whishlist_click', ['as' => 'detail.unique_whishlist_click', 'uses' => 'Shopowner\ShopownerController@uniquewhishlistclick']);
        Route::get('/detail/unique_ads_view', ['as' => 'detail.unique_ads_view', 'uses' => 'Shopowner\ShopownerController@uniqueadsview']);
        Route::get('/detail/unique_product_view', ['as' => 'detail.unique_product_view', 'uses' => 'Shopowner\ShopownerController@uniqueproductview']);
        Route::get('/detail/product_discount_view', ['as' => 'detail.product_discount_view', 'uses' => 'Shopowner\ShopownerController@discountproductview']);
        Route::get('/detail/get_shop_view', ['as' => 'detail.get_shop_view', 'uses' => 'Shopowner\ShopownerController@getshopownerview']);
        Route::get('/detail/get_buy_now_click', ['as' => 'detail.get_buy_now_click', 'uses' => 'Shopowner\ShopownerController@getbuynowclick']);
        Route::get('/detail/get_unique_add_to_cart_click', ['as' => 'detail.get_unique_add_to_cart_click', 'uses' => 'Shopowner\ShopownerController@getuniqueaddtocartclick']);
        Route::get('/detail/get_unique_whishlist_click', ['as' => 'detail.get_unique_whishlist_click', 'uses' => 'Shopowner\ShopownerController@getuniquewhishlistclick']);
        Route::get('/detail/get_unique_ads_view', ['as' => 'detail.get_unique_ads_view', 'uses' => 'Shopowner\ShopownerController@getuniqueadsview']);
        Route::get('/detail/get_discount_product_view', ['as' => 'detail.get_discount_product_view', 'uses' => 'Shopowner\ShopownerController@getdiscountproductview']);
        Route::get('/shop', ['as' => 'shop_detail', 'uses' => 'Shopowner\ShopownerController@shopdetail']);
        Route::put('/detail', ['as' => 'detail.update', 'uses' => 'Shopowner\ItemsController@fromDetailEdit']);

        Route::get('/edit', ['as' => 'edit', 'uses' => 'Shopowner\ShopownerController@edit']);
        Route::put('/edit/{id}', ['as' => 'update', 'uses' => 'Shopowner\ShopownerController@update']);


        Route::post('editajax', ['as' => 'editajax', 'uses' => 'Shopowner\ItemsController@editajax']);

        Route::post('customedit', ['as' => 'customedit', 'uses' => 'Shopowner\ItemsController@customedit']);
        Route::post('removeimage', ['as' => 'removeimage', 'uses' => 'Shopowner\ItemsController@removeimage']);

        Route::get('change-password', 'ChangePasswordController@index');
        Route::post('change-password', 'ChangePasswordController@store')->name('change.password');

        Route::get('update-password', 'UpdatePasswordController@index');
        Route::post('update-password', 'UpdatePasswordController@store')->name('update.password');

        Route::get('/item/discount/{id}', 'Shopowner\DiscountController@discount');
        Route::post('/item/discount/{id}', 'Shopowner\DiscountController@discount_save');
        Route::get('/item/discount_list', 'Shopowner\DiscountController@list');
        // Route::get('/item/discount_list', 'Shopowner\DiscountController@getDiscountItems')->name('discount.getDiscountItems');
        Route::delete('/item/discount_remove', 'Shopowner\DiscountController@remove');
        Route::get('/item/get_discount_items', 'Shopowner\DiscountController@getDiscountItems')->name('getDiscountItems');


        //collection
        Route::get('/collection/create', 'Shopowner\CollectionController@create');
        Route::post('/collection/create', 'Shopowner\CollectionController@store');
        Route::get('/collection/list', 'Shopowner\CollectionController@list');
        Route::get('/collection/detail/{id}', 'Shopowner\CollectionController@detail');
        Route::get('/collection/add/list/{id}', 'Shopowner\CollectionController@additemlist');
        Route::post('/collection/add/list/{id}', 'Shopowner\CollectionController@additem');
        Route::post('/collection/remove_item', 'Shopowner\CollectionController@removeitem');

        //collection


        Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\ShopownerLoginController@logout']);

        //message
        Route::post('/sendmessage', 'message\UsermessageController@sendmessagetoshopowner');
        Route::post('/sendimagemessage', 'message\UsermessageController@sendimagemessagetoshopowner');
        Route::get('/chatpannel', 'message\MessageController@chatpannel');
        Route::post('/sendmessagetouser', 'message\MessageController@sendmessagetouser');
        Route::get('/getshopschatslist', 'message\MessageController@getshopschatslist');
        Route::get('gettotalchatcountforshop','message\MessageController@gettotalchatcountforshop');
        Route::get('getspecificchatcountforshop/{user_id}','message\MessageController@getspecificchatcountforshop');
        Route::post('/getcurrentchatuser', 'message\MessageController@getcurrentchatuser');
        Route::post('/sendwhatshopisactive', 'message\MessageController@sendwhatshopisactive');
        Route::post('/setreadbyshop', 'message\MessageController@setreadbyshop');
        Route::post('/sendwhatshopisoffline', 'message\MessageController@sendwhatshopisoffline');
        Route::post('/sendwhatshopisofflinefromcustomer', 'message\UsermessageController@sendwhatshopisoffline');


        //firebase noti

        Route::post('/storefirebasetokenforshop', 'message\MessageController@storefirebasetokenforshop');

        //activity
        Route::get('/product/activity/item', 'Shopowner\ItemsController@item_activity_index')->name('so_activity.p_product');
        Route::get('/product/activity/multiprice', 'Shopowner\ItemsController@multiprice_activity_index')->name('so_activity.p_multiprice');
        Route::get('/product/activity/multidiscount', 'Shopowner\ItemsController@multidiscount_activity_index')->name('so_activity.p_multidiscount');
        Route::get('/product/activity/multipercent', 'Shopowner\ItemsController@multipercent_activity_index')->name('so_activity.p_multipercent');

        Route::get('/user/activity/product', 'Shopowner\ManagerController@u_product')->name('so_activity.u_product');
        Route::get('/user/activity/role', 'Shopowner\ManagerController@u_role')->name('so_activity.u_role');

        /** Point System */
        // Route::get('/user_points/add_price/','Shopowner\ShopownerController@add_price')->name('add_price');
        Route::post('/user_points/add_price/','Shopowner\ShopownerController@add_price_create')->name('add_price.create');

 //Start POS//
    Route::get('/sale_page', 'Shopowner\PosController@getSalePage')->name('pos.sale_page');

    //Purchase
        //gold
    Route::get('/purchase_list', 'Shopowner\PosController@getPurchaseList')->name('pos.purchase_list');
    Route::post('/gold_type_filter', 'Shopowner\PosController@goldtypeFilter')->name('pos.gold_type_filter');
    Route::get('/create_purchase', 'Shopowner\PosController@createPurchase')->name('pos.create_purchase');
    Route::post('/store_purchase', 'Shopowner\PosController@storePurchase')->name('pos.store_purchase');
    Route::post('/puchase_code', 'Shopowner\PosController@getPurchaseCode')->name('pos.codegenerate');
    Route::post('/quality_price', 'Shopowner\PosController@getQualityPrice')->name('pos.quality_gold_price');
    Route::post('/delete_purchase', 'Shopowner\PosController@deletePurchase')->name('pos.delete_purchase');
    Route::get('/edit_purchase/{id}', 'Shopowner\PosController@editPurchase')->name('pos.edit_purchase');
    Route::post('/update_purchase/{id}', 'Shopowner\PosController@updatePurchase')->name('pos.update_purchase');
        //kyout
    Route::get('/kpurchase_list', 'Shopowner\PosController@getKyoutPurchaseList')->name('pos.kyout_purchase_list');
    Route::post('/kyout_type_filter', 'Shopowner\PosController@kyouttypeFilter')->name('pos.kyout_type_filter');
    Route::get('/create_kpurchase', 'Shopowner\PosController@createKyoutPurchase')->name('pos.create_kyout_purchase');
    Route::post('/store_kpurchase', 'Shopowner\PosController@storeKyoutPurchase')->name('pos.store_kyout_purchase');
    Route::post('/fill_phno', 'Shopowner\PosController@getPhone')->name('pos.fill_phno');
    Route::post('/delete_kyout_purchase', 'Shopowner\PosController@deleteKyoutPurchase')->name('pos.delete_kyout_purchase');
    Route::get('/edit_kyout_purchase/{id}', 'Shopowner\PosController@editKyoutPurchase')->name('pos.edit_kyout_purchase');
    Route::post('/update_kyout_purchase/{id}', 'Shopowner\PosController@updateKyoutPurchase')->name('pos.update_kyout_purchase');
        //platinum
    Route::get('/ptmpurchase_list', 'Shopowner\PosController@getPtmPurchaseList')->name('pos.ptm_purchase_list');
    Route::post('/platinum_type_filter', 'Shopowner\PosController@ptmtypeFilter')->name('pos.ptm_type_filter');
    Route::get('/create_platinum_purchase', 'Shopowner\PosController@createPtmPurchase')->name('pos.create_ptm_purchase');
    Route::post('/quality_ptm_price', 'Shopowner\PosController@getPtmQualityPrice')->name('pos.quality_ptm_price');
    Route::post('/store_platinum_purchase', 'Shopowner\PosController@storePtmPurchase')->name('pos.store_ptm_purchase');
    Route::post('/delete_ptm_purchase', 'Shopowner\PosController@deletePtmPurchase')->name('pos.delete_ptm_purchase');
    Route::get('/edit_platinum_purchase/{id}', 'Shopowner\PosController@editPtmPurchase')->name('pos.edit_ptm_purchase');
    Route::post('/update_platinum_purchase/{id}', 'Shopowner\PosController@updatePtmPurchase')->name('pos.update_ptm_purchase');

    //Supplier
    Route::get('/supplier_list', 'Shopowner\PosController@getSupplierList')->name('pos.supplier_list');
    Route::get('/create_supplier', 'Shopowner\PosController@getCreateSupplier')->name('pos.create_supplier');
    Route::post('/change_state', 'Shopowner\PosController@changeState')->name('pos.change_state');
    Route::post('/type_filter', 'Shopowner\PosController@typeFilter')->name('pos.type_filter');
    Route::post('/store_supplier', 'Shopowner\PosController@storeSupplier')->name('pos.store_supplier');
    Route::get('/edit_supplier/{id}', 'Shopowner\PosController@editSupplier')->name('pos.edit_supplier');
    Route::post('/update_supplier/{id}', 'Shopowner\PosController@updateSupplier')->name('pos.update_supplier');
    Route::post('/delete_supplier', 'Shopowner\PosController@deleteSupplier')->name('pos.delete_supplier');

    //Assign Gold Price
    Route::get('/assign_gold', 'Shopowner\PosController@getAssignGold')->name('pos.assign_gold_list');
    Route::post('/assign_gold_price', 'Shopowner\PosController@getAssignGoldPrice')->name('pos.assign_gold_price');
    Route::post('/update_assign_gold_price/{id}', 'Shopowner\PosController@updateAssignGoldPrice')->name('pos.update_assign_gold_price');

    //Assign Platinum
    Route::get('/assign_platinum', 'Shopowner\PosController@getAssignPlatinum')->name('pos.assign_platinum_list');
    Route::get('/assign_platinum_price', 'Shopowner\PosController@getAssignPlatinumPrice')->name('pos.assign_platinum_price');
    Route::post('/store_assign_platinum_price', 'Shopowner\PosController@storeAssignPlatinumPrice')->name('pos.store_assign_platinum_price');
    Route::post('/update_assign_platinum_price/{id}', 'Shopowner\PosController@updateAssignPlatinumPrice')->name('pos.update_assign_platinum_price');
    });
?>
