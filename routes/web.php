<?php
use App\Sign;
use App\User;
use App\Manager;
use App\Shopowner;
use Carbon\Carbon;
use function Safe\strtotime;
use Illuminate\Http\Request;
use App\View\Components\alert;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\traid\ykimage;

use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;

//URL::forceScheme('https');  //at the top of the file
Route::get('/getprice', 'Shopowner\DiscountController@price_update');


Route::group(['middleware' => ['web', 'foratc']],
    function () {
//    for frontend user
        Route::get('/adsclick/{name}/{id}', 'LogController@storeadsclicklog');
        Route::get('/support', 'SupportFrontController@support');
        Route::post('/get_support_by_cat', 'SupportFrontController@get_support_by_cat');
        Route::post('/get_support', 'SupportFrontController@get_support');
        Route::get('/initial_pop_items', 'FrontController@initial_pop_items');


        Route::post('/addtohome/update', 'FrontController@addtohomeupdate');

        //for chat

        Route::get('getuserchatlistsfromserver', 'message\UsermessageController@getuserchatlistsfromserver');
        Route::get('gettotalchatcountforuser', 'message\UsermessageController@gettotalchatcountforuser');
        Route::get('getspecificchatcountforuser/{shop_id}', 'message\UsermessageController@getspecificchatcountforuser');
        Route::post('/getcurrentchatshops', 'message\UsermessageController@getcurrentchatshops');
        Route::post('/setreadbyuser', 'message\UsermessageController@setreadbyuser');
        Route::post('/sendwhatuserisactive', 'message\UsermessageController@sendwhatuserisactive');
        Route::post('/sendwhatuserisoffline', 'message\UsermessageController@sendwhatuserisoffline');
        Route::get('/getpostbyproductid/{item_id}', 'message\UsermessageController@getpostbyproductid');
        Route::post('/getitemdata', 'message\UsermessageController@getitemdata');

        Route::get('/directory/all', 'FrontController@directory');
        Route::get('/directory/detail/{shop_name}', 'FrontController@directdetail');
        Route::post('/get_shop_directory', 'FrontController@get_shop_directory');
        Route::get('/get_township_bystate/{id}', 'FrontController@getTownshipbyState');
        Route::get('/getstates', 'FrontController@getstates');
        Route::get('/getshopbystate/{id}', 'FrontController@getshopbystate');

        //forchat

        Route::get('/', function () {
            return view('welcome');
        })->middleware('auth');


//all routes for authenciation defined here
        Auth::routes();
        //for super admin

        require "superadminroutes.php";

        //for super admin


        //for webservice

        require "shopownerroutes.php";
        //for webservice


        //for user
        require "userroutes.php";
        require "payment.php";

//for frontend
        Route::post('checkvalidate', 'Auth\RegisterController@checkvalidate');
        Route::post('checkvalidateregister', 'Auth\RegisterController@check_validate_register');
        Route::post('checkcodereg', 'Auth\RegisterController@checkcodereg');
        Route::post('updatename', 'Auth\RegisterController@update_name');
        Route::get('/', 'FrontController@index')->name('front');
        Route::get('/gold_calculator', 'FrontController@gold_calculator');
// zh
        Route::get('/{shop_name}/product_detail/{product_id}', 'FrontController@product_detail')->name('front_productdetail');
        Route::get('/buynow', 'FrontController@buynow')->name('buynow');
        Route::get('/addtocartclick', 'FrontController@addtocartclick')->name('addtocartclick');
        Route::post('/whislistclick', 'FrontController@whislistclick')->name('whislistclick');
//    Route::get('/search', 'FrontController@search');
//    Route::post('/search', 'FrontController@search_result');
        Route::post('/get_newitems_ajax', 'FrontController@get_newitems_ajax');
        Route::get('/get_popitems_forshop_ajax/{latest}/{shop_id}', 'FrontShopController@get_popitems_forshop_ajax');
        Route::get('/get_newitems_forshop_ajax/{limit}/{shop_id}', 'FrontShopController@get_newitems_forshop_ajax');
        Route::get('/get_popitems_ajax/{latest}/{limit}', 'FrontController@get_popitems_ajax');
        Route::get('/get_discount_ajax/{limit}/{shop_id?}', 'FrontfordiscountController@get_discount_ajax');
        Route::get('/get_discount_forshop_ajax/{limit}/{shop_id?}', 'FrontfordiscountController@get_discount_forshop_ajax');
        Route::get('/get_shop_ajax/{limit}', 'FrontShopController@view_more_ajax');
        Route::get('/see_all_discount/{shop_id}', 'FrontfordiscountController@see_all');
        Route::get('/see_all_discount_for_shop/{shop_id}', 'FrontfordiscountController@see_all');

        Route::post('/search_by_type', 'FrontController@search_by_type');
        Route::get('/ajax_search_result/{searchtext?}', 'FrontController@ajax_search_result');


        Route::get('/shop_detail/{id}/{cat}', 'FrontController@getitem_fromshop_bycat');
        Route::get('/see_all_new', 'FrontController@see_all_new');
        Route::get('/see_all_for_shop/{neworpop}/{shop_id}', 'FrontController@see_all_for_shop');
        Route::get('/get_newitems_forshop_ajax/{shop_id}', 'FrontController@get_newitems_forshop_ajax');
        Route::get('/see_all_pop', 'FrontController@see_all_pop');
        Route::get('/see_by_categories/{id}', 'FrontforcatController@see_all');
        //for search page
        Route::get('/see_by_categories', 'FrontforcatController@search_items');
        //for search page
        //all 404 error page is not show by this link (need to repair later)
        Route::get('/{shop_name}/{cat_name}/{shop_id}', 'FrontShopController@see_all');
        //all 404 error page is not show by this link (need to repair later)

        Route::post('/get_items_cat_ajax/{id}', 'FrontforcatController@get_items_cat_ajax');
        Route::post('/catfilter', 'FrontforcatController@catfilter');
        Route::get('/tags/{name}', 'TagsController@index');
        Route::post('/tags_items', 'TagsController@get_tags_items');
        Route::get('/allcollections', 'FrontcollectionController@see_all');
//for similar
        Route::get('/{shop_name}/similar_items/{cat}/{item_id}/{shop_id}', 'FrontSimilarOrotherController@similar_by_cat');

        //forgot password user

        Route::get('forgot_password', ['as' => 'forgot_password', 'uses' => 'Auth\YkforgotpasswordController@showLinkRequestForm']);
        Route::post('forgot_password', ['as' => 'send_reset_code', 'uses' => 'Auth\YkforgotpasswordController@send_reset_code_form']);

        Route::post('check_code', ['as' => 'send_reset_code', 'uses' => 'Auth\YkforgotpasswordController@codeCheck']);
        Route::post('add_new_password', ['as' => 'add_new_password', 'uses' => 'Auth\YkforgotpasswordController@add_new_password']);


        Route::get('/temp/see_all_cato', 'TempController@see_all_cato')->name('temp');

        Route::get('/addtocart', function () {

            // for account
            if (isset(Auth::guard('shop_owner')->user()->id)) {
                $shopowner_acc = Shopowner::where('id', Auth::guard('shop_owner')->user()->id)->orderBy('created_at', 'desc')->get();
            } else if (isset(Auth::guard('shop_role')->user()->id)) {
                $manager = Manager::where('id', Auth::guard('shop_role')->user()->id)->pluck('shop_id');
                $shopowner_acc = Shopowner::where('id', $manager)->orderBy('created_at', 'desc')->get();
            }

            if (isset(Auth::guard('shop_owner')->user()->id)) {
                return view('front.temp.addtocart', ['shopowner_acc' => $shopowner_acc]);
            } elseif (isset(Auth::guard('shop_role')->user()->id)) {
                return view('front.temp.addtocart', ['shopowner_acc' => $shopowner_acc]);
            } else {
                return view('front.temp.addtocart');
            }
        });
        Route::get('/myfav', function () {
            // for account
            if (isset(Auth::guard('shop_owner')->user()->id)) {
                $shopowner_acc = Shopowner::where('id', Auth::guard('shop_owner')->user()->id)->orderBy('created_at', 'desc')->get();
            } else if (isset(Auth::guard('shop_role')->user()->id)) {
                $manager = Manager::where('id', Auth::guard('shop_role')->user()->id)->pluck('shop_id');
                $shopowner_acc = Shopowner::where('id', $manager)->orderBy('created_at', 'desc')->get();
            }

            if (isset(Auth::guard('shop_owner')->user()->id)) {
                return view('front.temp.fav', ['shopowner_acc' => $shopowner_acc]);
            } elseif (isset(Auth::guard('shop_role')->user()->id)) {
                return view('front.temp.fav', ['shopowner_acc' => $shopowner_acc]);
            } else {
                return view('front.temp.fav');
            }
        });

        Route::put('/addtocart', 'FrontController@addtocart_search');
        Route::put('/myfav', 'FrontController@fav_search');

        Route::get('/addtocart/update', function () {

            // for account
            if (isset(Auth::guard('shop_owner')->user()->id)) {
                $shopowner_acc = Shopowner::where('id', Auth::guard('shop_owner')->user()->id)->orderBy('created_at', 'desc')->get();
            } else if (isset(Auth::guard('shop_role')->user()->id)) {
                $manager = Manager::where('id', Auth::guard('shop_role')->user()->id)->pluck('shop_id');
                $shopowner_acc = Shopowner::where('id', $manager)->orderBy('created_at', 'desc')->get();
            }

            if (isset(Auth::guard('shop_owner')->user()->id)) {
                return view('front.temp.addtocart', ['shopowner_acc' => $shopowner_acc]);
            } elseif (isset(Auth::guard('shop_role')->user()->id)) {
                return view('front.temp.addtocart', ['shopowner_acc' => $shopowner_acc]);
            } else {
                return view('front.temp.addtocart');
            }
        });
        Route::get('/myfav/update', function () {
            // for account
            if (isset(Auth::guard('shop_owner')->user()->id)) {
                $shopowner_acc = Shopowner::where('id', Auth::guard('shop_owner')->user()->id)->orderBy('created_at', 'desc')->get();
            } else if (isset(Auth::guard('shop_role')->user()->id)) {
                $manager = Manager::where('id', Auth::guard('shop_role')->user()->id)->pluck('shop_id');
                $shopowner_acc = Shopowner::where('id', $manager)->orderBy('created_at', 'desc')->get();
            }

            if (isset(Auth::guard('shop_owner')->user()->id)) {
                return view('front.temp.fav', ['shopowner_acc' => $shopowner_acc]);
            } elseif (isset(Auth::guard('shop_role')->user()->id)) {
                return view('front.temp.fav', ['shopowner_acc' => $shopowner_acc]);
            } else {
                return view('front.temp.fav');
            }
        });

        Route::get('baydin_detail/{id}', function(Request $request,$id){
            $baydin = Sign::findOrFail($id);
            $sign = $baydin->name;
            $baydins = Sign::where('id', '!=', $id)->where('name',$sign)->get();
            // return dd($baydins);
            if (isset(Auth::guard('web')->user()->id)) {
            return view('front.baydins.baydin_detail',compact('baydin','baydins'));
            }else{
                return redirect()->back();
            }
        })->name('baydin_detail');

        Route::post('/addtocart/update', 'FrontController@addtocart_update');
        Route::post('/myfav/update', 'FrontController@fav_update');
        Route::get('/contact-us', 'FrontController@contact_us');


//-------------------------------------------------------------------------
        //for webservice

        require "webserviceroutes.php";
        //for webservice

//For unit testing
        require "unittest.php";


    });


Route::get('webhook', 'FacebookWebhookController@webhook');
Route::get('checkwehavetoken', 'forfacebook\FacebookController@checkwehavetoken');
Route::post('storetoken', 'forfacebook\FacebookController@storetoken');
Route::post('webhook', 'FacebookWebhookController@webhook_post');
Route::get('forgetstart/{id}', 'FacebookWebhookController@forgetstart');

Route::get('testfbpost', function(){
    $response = Http::withHeaders([
        'Content-Type' => "application/json"
    ])->post('https://graph.facebook.com/107646812265437/feed',
        [
            'message'=>'test message',
            'link'=>'https://test.shweshops.com/MoeGaungGoldShop/product_detail/6888',
            'access_token'=>'EAAHrG0ta9TIBAFP46COMZCTcbTzo8WY2C8GFgBMpSegmbEBHtJjhqivfYNxXSVIS44fngAvc9EPV0Qd297DrjCtYjCiTZAmVnv2LWPOovmidJ0WpvmNaKo4k8oyzP6iTg9X76JimjqN9rKUWZAzsm55wLlzX32Lew4IQePu9bTxDqypFegHOgQDOm9zYydMOx6hIRyYrwZDZD'

        ]);
    return $response;
});

// zh log activity
Route::get('add-to-log', 'LogController@myTestAddToLog');
Route::get('logActivity', 'LogController@logActivity');

Route::get('notification', 'FrontController@getNoti');
Route::post('notification', 'FrontController@readNoti');

Route::get('shops', 'FrontController@getShops');

// News and Events
Route::get('news&events', 'Shwe_News\NewsFrontController@index');
Route::get('news_and_events/{id}', 'Shwe_News\NewsFrontController@show');
Route::get('news', 'Shwe_News\NewsFrontController@allNews');
Route::get('promotions', 'Shwe_News\NewsFrontController@allPromotions');
Route::get('events', 'Shwe_News\NewsFrontController@allEvents');
Route::get('news/{slug}', 'Shwe_News\NewsFrontController@NewsDetail')->name('news.detail');
Route::get('promotions/{slug}', 'Shwe_News\NewsFrontController@PromotionDetail')->name('promotions.detail');
Route::get('event/{slug}', 'Shwe_News\NewsFrontController@EventDetail')->name('events.detail');

//test
Route::get('backside/pos/index', 'Shopowner\PosController@index');

//for live stream
Route::get('livestream', function () {
    return view('front.livestream.main');
});

Route::get('baydin', 'Auth\RegisterController@baydin');



Route::get('terms', function () {
    return view('front.terms');
});

Route::get('/{shop_name}', 'FrontController@shop_detail');
Route::get('/sms/test', function () {
    $response = Http::withToken(env('PHONE_CODE_TOKEN'))->get('https://smspoh.com/api/v2/get-sender-names');
    return $response;
});
