<?php

namespace App\Http\Controllers;

use App\Ads;
use App\Ajax;
use App\Item;
use App\State;
use App\discount;
use App\Township;
use App\Usernoti;
use App\Contactus;
use App\Shopowner;
use App\UserPoint;
use App\Users_fav;
use Carbon\Carbon;
use App\Collection;
use App\Manager_fav;
use App\foraddtohome;
use App\Facade\Repair;
use App\frontuserlogs;
use App\Guestoruserid;
use App\Shopdirectory;
use App\BuyNowClickLog;
use App\Shop_owners_fav;
use App\WhislistClickLog;
use App\AddToCartClickLog;
use App\VisitorLogActivity;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\traid\logs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\traid\allshops;
use App\Http\Controllers\traid\category;
use App\Http\Controllers\traid\similarlogic;


class FrontController extends Controller
{

    use allshops;
    use similarlogic;
    use category;
    use logs;
    public function getstates(){
        $states=State::all();
        return response()->json(['data'=>$states]);
    }

    public function getshopbystate($id) {
      $shops = Shopowner::where('state', $id)->orderBy('shop_name', 'asc')->get();
      return response()->json($shops);
    }

    public function addtohomeupdate()
    {
        foraddtohome::where('user_id', Auth::guard('web')->user()->id)->update(['added' => 'yes']);
        return response()->json(['success' => true]);
    }
    public function directory()
    {
      $data = Shopdirectory::select(
        [
          'shop_directory.id as dir_id', 'shop_directory.shop_id as id',
          'shop_directory.shop_name as dir_shop_name', 'shop_owners.shop_name as shop_name',
          'shop_directory.shop_name_url as dir_shop_name_url', 'shop_owners.shop_name_url as shop_name_url',
          'shop_directory.main_phone as dir_main_phone', 'shop_owners.main_phone as main_phone',
          'shop_directory.shop_logo as dir_shop_logo', 'shop_owners.shop_logo as shop_logo',
          'shop_directory.facebook_link as dir_facebook_link', 'shop_owners.page_link as facebook_link',
          'shop_directory.website_link as website_link',
          'shop_owners.premium as premium'
        ]
      )->leftjoin('shop_owners', 'shop_directory.shop_id', '=', 'shop_owners.id')
      ->orderBy('shop_directory.created_at', 'DESC')
      ->limit(20)->get()
      ->map(fn($data) => [
        'shweshops_premium_status' => $data->premium ? $data->premium : null,
        'id' => $data->id ? $data->id : $data->dir_id,
        'shop_name' => $data->dir_shop_name ? $data->dir_shop_name : $data->shop_name,
        'shop_name_url' => $data->dir_shop_name_url ? $data->dir_shop_name_url : $data->shop_name_url,
        'main_phone' => $data->dir_main_phone ? $data->dir_main_phone : $data->main_phone,
        'dir_shop_logo' => $data->dir_shop_logo ? $data->dir_shop_logo : null,
        'shop_logo' => $data->shop_logo ? $data->shop_logo : null,
        'facebook_link' => $data->dir_facebook_link ? $data->dir_facebook_link : $data->facebook_link,
        'website_link' => $data->website_link ? $data->website_link : null
      ]);

      $states = State::get();
      // dd($data);
      return view('front.directory.directory',['data'=>$data, 'states'=>$states]);
    }
    public function directdetail($shopname)
    {
        $data=Shopdirectory::whereRaw("REPLACE(shop_name,' ','') = '" . $shopname . "'")
                           ->orWhereRaw("REPLACE(shop_name_url,' ','') = '" . $shopname . "'");
        if($data->count() == 0){
            return abort(404);
        }
        return view('front.directory.detail',['item'=>$data->first()]);
    }

    public function get_shop_directory(Request $request) {

      if($request->filtertype['state'] == 0) {
        $dir_state = 'shop_directory.state >= 0';
        $state = 'shop_owners.state >= 0';
      } else {
        // $dir_state = "shop_directory.state = " . $request->filtertype['state'];
        $dir_state = "shop_directory.state REGEXP '\"" . $request->filtertype['state'] . "\"'";
        $state = "shop_owners.state = " . $request->filtertype['state'];
      }

      if($request->filtertype['township'] == 0) {
        $dir_township = 'shop_directory.township >= 0';
        $township = 'shop_owners.township >= 0';
      } else {
        // $dir_township = "shop_directory.township = " . $request->filtertype['township'];
        $dir_township = "shop_directory.township REGEXP '\"" . $request->filtertype['township'] . "\"'";
        $township = "shop_owners.township = " . $request->filtertype['township'];
      }

      if($request->filtertype['shopname'] == '') {
        $shopname = '%';
        $dir_shopname = '%';
      } else {
        $shopname = '%' . $request->filtertype['shopname'] . '%';
      }

      $shops = Shopdirectory::select(
        [
          'shop_directory.id as dir_id', 'shop_directory.shop_id as id',
          'shop_directory.shop_name as dir_shop_name', 'shop_owners.shop_name as shop_name',
          'shop_directory.shop_name_url as dir_shop_name_url', 'shop_owners.shop_name_url as shop_name_url',
          'shop_directory.main_phone as dir_main_phone', 'shop_owners.main_phone as main_phone',
          'shop_directory.shop_logo as dir_shop_logo', 'shop_owners.shop_logo as shop_logo',
          'shop_directory.facebook_link as dir_facebook_link', 'shop_owners.page_link as facebook_link',
          'shop_directory.website_link as website_link',
          'shop_owners.premium as premium'
        ]
      )->leftjoin('shop_owners', 'shop_directory.shop_id', '=', 'shop_owners.id')
      ->orderBy('shop_directory.created_at', 'DESC')
      ->where(function($query) use ($state, $dir_state) {
          $query->whereRaw($state)
              ->orWhereRaw($dir_state);
      })
      ->where(function($query) use ($township, $dir_township) {
        $query->whereRaw($township)
              ->orWhereRaw($dir_township);
      })
      ->where(function($query) use ($shopname,) {
        $query->where('shop_directory.shop_name', 'like', $shopname)
              ->orWhere('shop_directory.shop_name_myan', 'like', $shopname)
              ->orWhere('shop_owners.shop_name', 'like', $shopname)
              ->orWhere('shop_owners.shop_name_myan', 'like', $shopname);
      })
      ->skip($request->filtertype['shoplimit'])->take('20')->get()
      ->map(fn($data) => [
        'shweshops_premium_status' => $data->premium ? $data->premium : null,
        'id' => $data->id ? $data->id : $data->dir_id,
        'shop_name' => $data->dir_shop_name ? $data->dir_shop_name : $data->shop_name,
        'shop_name_url' => $data->dir_shop_name_url ? $data->dir_shop_name_url : $data->shop_name_url,
        'main_phone' => $data->dir_main_phone ? $data->dir_main_phone : $data->main_phone,
        'dir_shop_logo' => $data->dir_shop_logo ? $data->dir_shop_logo : null,
        'shop_logo' => $data->shop_logo ? $data->shop_logo : null,
        'facebook_link' => $data->dir_facebook_link ? $data->dir_facebook_link : $data->facebook_link,
        'website_link' => $data->website_link ? $data->website_link : null
      ]);

      if (count($shops) < 20) {
        $empty_on_server = 1;
      } else {
        $empty_on_server = 0;
      }

      return response()->json(['shops' => $shops, 'count' => count($shops), 'empty_on_server' => $empty_on_server]);
    }

    public function getTownshipbyState($id) {
      $townships = Township::select('id', 'name', 'myan_name')->where('state_id', $id)->get();
      return response()->json($townships);
    }

    public function index()
    {
        // return $_SERVER['HTTP_USER_AGENT'];
        // $browser = get_browser();
        // return $browser;
//      return Browser::isBot();



        //Ads
        Ads::where('end', '<=', Carbon::now()->format('Y-m-d H:i:s A'))->delete();
        $collection = Ads::where('start', '<=', Carbon::now()->format('Y-m-d H:i:s A'))->get();
        $ads = $collection->shuffle()->all();
        //Ads end

        //for new item every shop
        //get all distinct shopid from table
        $new_items = DB::table('items')->select('shop_id')->distinct()->orderBy('created_at', 'desc')->get();

        $get_by_shopid = [];
        //        loop and retrive data by shop id greater than last 10 day
        $count = 0;
        $current_shop_count = 0;
        foreach ($new_items as $ni) {
            if ($count > 19) {
                break;
            } else {
                $tmpgbsid = Item::where('shop_id', $ni->shop_id)->whereDate('created_at', '>', Carbon::today()->subDay(60))->orderBy('created_at', 'desc')->limit(4)->get();
                foreach ($tmpgbsid as $tmpsid) {
                    array_push($get_by_shopid, $tmpsid);
                }
                $count += count($tmpgbsid);
                $current_shop_count += 1;
            }

        }

        //randomize result
        $get_by_shopid = collect($get_by_shopid)->shuffle()->values();
        //randomize result


        //for all cat count
//        $all = Item::where('id', '!=', 0)->get();


        //values function is beacause filter retrun {{}} but i need [{}]
        $remove_discount_new = collect($get_by_shopid)->filter(function ($value, $key) {
            return $value->check_discount == 0;
        })->values();




//        //for all cat count
//        $all = Item::where('id', '!=', 0)->get();


        //        return $allcatcount;
        $catlist = DB::table('categories')->leftjoin('items', 'categories.name', '=', 'items.category_id')->select('categories.*')->where('items.deleted_at', '=', NULL)->groupBy('categories.name')->orderByRaw("CASE
                        WHEN count(items.category_id) = 0 THEN categories.id END ASC,
            case when count(items.category_id) != 0 then count(categories.name) end DESC")->get();
        //
        //  foreach ($catlist as $c) {
        //      if (empty($allcatcount[$c->name])) {
        //            $allcatcount[$c->name] = 0;
        //         }
        //
        //
        //    }


//        $col_count = Collection::where('id', '!=', 0)->get();
//        $collection_item = Item::orderBy('name', 'desc')->where('collection_id', '!=', 0)->groupBy('collection_id')->limit(20)->get();

        //for all cat count

//        $shops = Shopowner::orderBy('created_at', 'desc')->limit(20)->get();
//        $shops = $shops->shuffle()->values();
        $premiumshops = Shopowner::orderBy('created_at', 'desc')->where('premium', 'yes')->limit(20)->get();


//        //for discount slide and promotion pannel
//        $discount = discount::orderBy('percent', 'desc')->get();
//        //for discount slide and promotion pannel

        // for account
        //forlogs
        $this->addlog(url()->current(), 'all', 'all', 'homepage', '0');

        //forlogs


        //Daily Login Point Check
//        if(Auth::guard('web')->check()){
//            $isUserPoint = UserPoint::where('user_id', Auth::guard('web')->id())->where('point_id',1)->first();
//            $is_user_register_time= UserPoint::where('user_id', Auth::guard('web')->id())
//                ->where('point_id',1)
//                ->where('login_expired','>',Carbon::now())
//                ->count();
//            $is_user_login_time = UserPoint::where('user_id', Auth::guard('web')->id())->where('point_id',4)
//                ->where('login_expired','>',Carbon::now())
//                ->count();
//            $user_point = new UserPoint();
//            if(isset($isUserPoint)){
//                if($is_user_register_time == 0 || $is_user_login_time == 0){
//                    $user_point->user_id = Auth::guard('web')->id();
//                    $user_point->login_expired = Carbon::now()->addDay(1);
//                    $user_point->point_id = 4;
//                    $user_point->save();
//                }
//            }else{
//                $user_point->user_id = Auth::guard('web')->id();
//                $user_point->login_expired = Carbon::now()->addDay(1);
//                $user_point->point_id = 1;
//                $user_point->save();
//            }
//        }


        return view('front.index', ['ads' => $ads,'catlist' => $catlist, 'new_items' => $remove_discount_new, 'current_shop_count' => $current_shop_count, 'premium' => $premiumshops]);


    }
    public function initial_pop_items(Request $request){
        $pop = Item::whereDate('created_at', '>', Carbon::today()->subDay(60))->orderBy('view_count', 'DESC')->limit(10)->get();

//        $remove_discount_pop = collect($pop)->filter(function ($value, $key) {
//            return $value->check_discount == 0;
//        })->values();
        return response()->json([$pop]);

    }


    public function get_newitems_ajax(Request $request)
    {
        //return $request->data;
        $total_count = DB::table('items')->select('shop_id')->distinct()->orderBy('created_at', 'desc')->get()->count();
        $limit = $total_count - $request->filtertype['shop_limit'];
        $shop_ids = DB::table('items')->select('shop_id')->distinct()->orderBy('created_at', 'desc')->skip($request->filtertype['shop_limit'])->take($limit)->get();

        //return $request[0]['id'];
        $get_by_shopid = [];

        if ($request->filtertype["latest"] === true) {
            $date = '>';
        } else {
            $date = '<';
        }

        $count = 0;
        $current_shop_count = 0;

        foreach ($shop_ids as $ni) {
            if ($count > 19) {
                break;
            } else {
                $tmpgbsid = Item::where('shop_id', $ni->shop_id)->whereDate('created_at', $date, Carbon::today()->subDay(60))->orderBy('created_at', 'desc')->skip($request->filtertype["item_limit"])->limit(4)->get();
                foreach ($tmpgbsid as $tmpsid) {
                    array_push($get_by_shopid, $tmpsid);
                }
                $count += count($tmpgbsid);
                $current_shop_count += 1;
            }

        }

        //randomize result
        $get_by_shopid = collect($get_by_shopid)->values();

        $remove_discount_new = collect($get_by_shopid)->filter(function ($value, $key) {
            return $value->check_discount == 0;
        })->shuffle()->values();


        //product empty check
        if ($count == 0 && $current_shop_count + $request->filtertype['shop_limit'] == $total_count) {
            $itemsemptyonserver = 1;
        } else {
            $itemsemptyonserver = 0;
        }

        //shop list empty check
        if (($count == 0) || ($current_shop_count == 0) || ($current_shop_count + $request->filtertype['shop_limit'] == $total_count)) {
            $shopsempty = 1;
        } else {
            $shopsempty = 0;
        }

        return response()->json(['newitems' => $remove_discount_new, "shopsempty" => $shopsempty, "itemsemptyonserver" => $itemsemptyonserver, "current_shop_limit" => $current_shop_count]);
    }


    public function get_popitems_ajax($latest, $limit)
    {

//        $latestviewcount = Item::where('id', $latestid)->first()->view_count;
//
//        $pop_items = Item::where('view_count', '=', $latestviewcount)->limit(20)->get();
//        if (count($pop_items) != 0) {
//            $pop_items = Item::Where([['view_count', '=', $latestviewcount], ['id', '>', $latestid]])->orWhere([['view_count', '<', $latestviewcount], ['id', '!=', $latestid]])->orderBy('view_count', 'desc')->limit(20)->get();
//
//        } else {
//            $pop_items = Item::Where([['view_count', '<', $latestviewcount], ['id', '!=', $latestid]])->orderBy('view_count', 'desc')->limit(20)->get();
//
//        }
        if ($latest === "true") {
            $date = '>';
        } else {
            $date = '<';
        }

        $pop_items = Item::whereDate('created_at', $date, Carbon::today()->subDay(60))->orderBy('view_count', 'DESC')->skip($limit)->take(10)->get();

        $remove_discount_pop = collect($pop_items)->filter(function ($value, $key) {
            return $value->check_discount == 0;
        })->values();

        // if($latest !== "true") {
        //   $remove_discount_pop = collect($remove_discount_pop)->shuffle()->values();
        // }

        //        for seeall button check if data has in database
        if (count($pop_items) < 10) {
            $emptyonserver = 1;
        } else {
            $emptyonserver = 0;
        }
        //  for seeall button

        return response()->json([$remove_discount_pop, 10, $emptyonserver]);

    }

    public function search()
    {
        $categories = Item::select('category_id')->groupBy('category_id')->get();
        $shops = Shopowner::all();
        $priceFrom = Item::select('price')->orderBy('price', 'asc')->get();
        $priceTo = Item::select('price')->orderBy('price', 'desc')->get();
        $gold_quality = Item::select('gold_quality')->groupBy('gold_quality')->get();
        $gold_color = Item::select('gold_colour')->groupBy('gold_colour')->get();

        return view('front.search', ['gold_quality' => $gold_quality, 'gold_color' => $gold_color, 'categories' => $categories, 'shops' => $shops, 'priceFrom' => $priceFrom, 'priceTo' => $priceTo]);
    }

    public function search_by_type(Request $request)
    {
        // if(empty($request['data'])){
        //     return response()->json(['resultdataitems' => [], 'resultdatashops' => []]);

        // }
        if (empty($request['data'])) {
            return response()->json(['resultdatashops' => []]);

        }

        // $checkcat = \App\Category::whereRaw("mm_name REGEXP '(" . $request['data'] . ")'");
        // if ($checkcat->count() > 0) {
        //     $request['data'] = $checkcat->first()->name;
        // }

        // $search_result = Item::select('items.*')->leftjoin('tagging_tagged', 'items.id', '=', 'tagging_tagged.taggable_id')->orWhere(function ($query) use ($request) {
        //     $query->orwhereRaw("items.name REGEXP '" . $request['data'] . "'");

        // })->orwhereRaw("tagging_tagged.tag_name REGEXP '(" . $request['data'] . ")'")->orWhere('items.category_id', 'like', $request['data'])->orWhere('items.product_code', 'like', '%' . $request['data'] . '%')->skip($request['limit'])->take('20')->get();

        $search_result_shops = Shopowner::where(function ($query) use ($request) {
            //remove space from incoming str
            $remove_space = str_replace(' ', '', $request['data']);
            $query->whereRaw("REPLACE(shop_name,' ','')  REGEXP '(" . $remove_space . ")'");
        })->skip($request['limit'])->take('20')->get();


        // return response()->json(['resultdataitems' => $search_result, 'resultdatashops' => $search_result_shops]);
        return response()->json(['resultdatashops' => $search_result_shops]);

    }

    public function ajax_search_result($searchtext = null)
    {
        $catlist = DB::table('categories')->leftjoin('items', 'categories.name', '=', 'items.category_id')->select('categories.*')->where('items.deleted_at', '=', NULL)->groupBy('categories.name')->orderByRaw("CASE
                        WHEN count(items.category_id) = 0 THEN categories.id END ASC,
            case when count(items.category_id) != 0 then count(categories.name) end DESC")->get();
        $all_shop_id = Shopowner::where('id', '!=', 1)->orderBy('shop_name', 'asc')->get();
        // $all_shop_id = Shopowner::where('id', '!=', 1)->orderBy('created_at', 'desc')->get();


        return view('front.searchresult', ['searchtext' => $searchtext, 'catlist' => $catlist, 'shop_ids' => $all_shop_id]);


    }


    public function product_detail($shop_name, $product_id)
    {


        $itemc = Item::where('id', $product_id);
        if($itemc->count() == 0){
            return abort(404);
        }
        $item = Item::where('id', $product_id)->first();

        // return dd($item->id);

        // zh item-log
        //forlogs
        $this->addlog(url()->current(), $product_id, $item->shop_id, 'product_detail', '0');
        //forlogs

        //***************************similar and related items logic***************************
        $similar_minimum_products = Item::select('items.*')->leftjoin('discount', 'items.id', '=', 'discount.item_id')->where(function ($query) use ($product_id) {
            $query->whereRaw($this->getsimilarsqlcode($product_id));
        })->where('items.shop_id', '=', $item->shop_id)->where('items.category_id', $item->category_id)->orderByRaw("CASE
                        WHEN discount.discount_price = 0 THEN discount.discount_min
            WHEN discount.discount_price !=  0 THEN discount.discount_price
            WHEN items.price=0 THEN min_price
            WHEN items.price!=0 THEN price
            END
            ASC")->limit(20)->get();
        $similar_minimum_products_other_shops = Item::select('items.*')->leftjoin('discount', 'items.id', '=', 'discount.item_id')->where(function ($query) use ($product_id) {
            $query->whereRaw($this->getsimilarsqlcode($product_id));
        })->where('items.shop_id', '!=', $item->shop_id)->where('items.category_id', $item->category_id)->orderByRaw("CASE
                        WHEN discount.discount_price = 0 THEN discount.discount_min
            WHEN discount.discount_price !=  0 THEN discount.discount_price
            WHEN items.price=0 THEN min_price
            WHEN items.price!=0 THEN price
            END
            ASC")->limit(20)->get();


        $add_view_count = $item->view_count + 1;
        $view_count = Item::where('id', $product_id)->update(['view_count' => $add_view_count]);

        // for account

        $checkShopOwnerFav = Shop_owners_fav::where('fav_id', $product_id)->pluck('user_id');
        $checkManagerFav = Manager_fav::where('fav_id', $product_id)->pluck('user_id');
        $checkUserFav = Users_fav::where('fav_id', $product_id)->pluck('user_id');

        $fav_total_count = count($checkShopOwnerFav) + count($checkManagerFav) + count($checkUserFav);


        return view('front.product_detail', ['item' => $item, 'category' => $item->category_id, 'sim_items' => $similar_minimum_products, 'sim_items_othershops' => $similar_minimum_products_other_shops, 'fav_total_count' => $fav_total_count]);

    }

    public function buynow(Request $request)
    {
        $item = Item::where('id', $request->id)->first();

        $getuserorguestid = $this->getidoftable_userorguestid();

        BuyNowClickLog::create(['item_id' => $request->id, 'userorguestid' => $getuserorguestid]);

        echo json_encode($item);
    }

    public function addtocartclick(Request $request)
    {
        $item = Item::where('id', $request->id)->first();
        $getuserorguestid = $this->getidoftable_userorguestid();
        $check_atc_logs_exit = AddToCartClickLog::where([['item_id', '=', $request->id], ['userorguestid', '=', $getuserorguestid]]);
        if ($check_atc_logs_exit->count() != 0) {
            AddToCartClickLog::where([['item_id', '=', $request->id], ['userorguestid', '=', $getuserorguestid]])->delete();
        } else {
            AddToCartClickLog::create(['item_id' => $request->id, 'userorguestid' => $getuserorguestid]);

        }


        echo json_encode($item);
    }

    public function whislistclick(Request $request)
    {
        $item = Item::where('id', $request->id)->first();

        $getuserorguestid = $this->getidoftable_userorguestid();
        $check_atc_logs_exit = WhislistClickLog::where([['item_id', '=', $request->id], ['userorguestid', '=', $getuserorguestid]]);
        if ($check_atc_logs_exit->count() != 0) {
            WhislistClickLog::where([['item_id', '=', $request->id], ['userorguestid', '=', $getuserorguestid]])->delete();
        } else {
            WhislistClickLog::create(['item_id' => $request->id, 'userorguestid' => $getuserorguestid]);

        }
        echo json_encode($item);
    }


    public function shop_detail($shopname)
    {
        $id = DB::table('shop_owners')->where('name', $shopname)->value('id');

        $shop = Shopowner::whereRaw("REPLACE(shop_name,' ','') = '" . $shopname . "'")
            ->orWhere('shop_name_url', $shopname)
            ->with(['getPhotos'])
            ->first();
        if(empty($shop)){
            return abort(404);
        }
        // \ShopLogActivity::shopaddToLog($shop->name);
        $id = $shop->id;

//        for log
        if (!Str::contains(url()->previous(), 'adsclick')) {
            $this->addlog(url()->current(), 'all', $id, 'shopdetail', '0');

        }
//        for log

        $premiumshops = Shopowner::orderBy('created_at', 'desc')->where('premium', 'yes')->limit(20)->get();

        $othersellers = Shopowner::orderBy('created_at', 'desc')->where('premium', '!=', 'yes')->orWhereNull('premium')->limit(20)->get();

        $allitems = Item::where('shop_id', $id)->orderBy('created_at', 'desc');
        //for load more button
        $remove_discount_item_for_count = collect($allitems->get())->filter(function ($value, $key) {
            return $value->check_discount == 0;
        })->values();

        $forcheck_count = $remove_discount_item_for_count->count();

        if ($forcheck_count < 21) {
            $forcheck_count = 0;
        } else {
            $forcheck_count = 1;
        }
        //
        $get_pop_items = Item::where('shop_id', $id)->orderBy('view_count', 'desc')->limit(12)->get();
        $items = Item::where('shop_id', $id)->orderBy('created_at', 'desc')->limit(20)->get();
        $remove_discount_item = collect($items)->filter(function ($value, $key) {
            return $value->check_discount == 0;
        })->values();
        $remove_discount_pop_item = collect($get_pop_items)->filter(function ($value, $key) {
            return $value->check_discount == 0;
        })->values();
        $shops = Shopowner::where('id', '!=', $id)->orderBy('created_at', 'desc')->limit(20)->get();
        // $discount = discount::where('shop_id', $id)->orderBy('created_at', 'desc')->limit(20)->get();
        $discount = Item::select('items.*')->leftjoin('discount', 'items.id', '=', 'discount.item_id')->where('discount.shop_id', $id)->whereNotNull('discount.id')->orderBy('discount.percent', 'DESC')->limit('12')->get();
        $allcatcount = DB::table('categories')->leftjoin('items', 'categories.name', '=', 'items.category_id')->select('items.category_id', 'categories.mm_name', DB::raw('count(items.category_id) as catcount'))->where('items.deleted_at', '=', NULL)->groupBy('categories.name')->orderByRaw("CASE
                        WHEN count(items.category_id) = 0 THEN categories.id END ASC,
            case when count(items.category_id) != 0 then count(categories.name) end DESC")->where('shop_id', $id)->get();


        if (isset(Auth::guard('web')->user()->id)) {
            $uid = Auth::guard('web')->user()->id;

            $checkItem = DB::table('item_log_activities')->where('user_id', $uid)->select('item_id')->get();
            $categories = [];
            $price = [];
            $min_price = [];
            $max_price = [];

            if (count($checkItem) == 0) {
                $shuffled_Recommended_items = Item::where('shop_id', $id)->inRandomOrder()->limit(20)->get();
            } else {
                foreach ($checkItem as $key1 => $value1) {
                    foreach ($value1 as $item => $item_id) {
                        $result = DB::table('items')->where('id', $item_id)->select('category_id')->get();

                        foreach ($result as $k => $v) {
                            if (count($result) != 0) {
                                $category = json_decode(json_encode($v), true);
                                foreach ($category as $k2 => $v2) {
                                    array_push($categories, $v2);
                                }

                            }
                        }
                    }
                }

                $categories_count = array_count_values($categories);
                arsort($categories_count);
                //Recommend price get

                foreach ($checkItem as $key1 => $value1) {
                    foreach ($value1 as $item => $item_id) {

                        $result = DB::table('items')->where('id', $item_id)->select('price')->get();

                        foreach ($result as $k => $v) {
                            if (count($result) != 0) {
                                $category = json_decode(json_encode($v), true);
                                foreach ($category as $k2 => $v2) {
                                    if ($v2 != 0) {
                                        array_push($price, $v2);
                                    }
                                }
                            }
                        }
                    }

                }
                foreach ($checkItem as $key1 => $value1) {
                    foreach ($value1 as $item => $item_id) {
                        $result = DB::table('items')->where('id', $item_id)->select('min_price')->get();
                        foreach ($result as $k => $v) {
                            if (count($result) != 0) {
                                $category = json_decode(json_encode($v), true);
                                foreach ($category as $k2 => $v2) {
                                    if ($v2 != 0) {
                                        array_push($min_price, $v2);
                                    }
                                }
                            }
                        }
                    }
                }
                foreach ($checkItem as $key1 => $value1) {
                    foreach ($value1 as $item => $item_id) {
                        $result = DB::table('items')->where('id', $item_id)->select('max_price')->get();
                        foreach ($result as $k => $v) {
                            if (count($result) != 0) {
                                $category = json_decode(json_encode($v), true);
                                foreach ($category as $k2 => $v2) {
                                    if ($v2 != 0) {
                                        array_push($max_price, $v2);
                                    }
                                }
                            }
                        }
                    }
                }

                //price craft

                $price_round = [];
                if ($price) {
                    foreach ($price as $p) {
                        // var_dump($p);
                        $p_rounded = (strlen((string)$p) - 1);
                        $temp = round($p, -($p_rounded));
                        array_push($price_round, (int)$temp);
                    }
                } else {
                    foreach ($min_price as $p) {
                        // var_dump($p);
                        $p_rounded = (strlen((string)$p) - 1);
                        $temp = round($p, -($p_rounded));
                        array_push($price_round, (int)$temp);
                    }
                    foreach ($max_price as $p) {
                        // var_dump($p);
                        $p_rounded = (strlen((string)$p) - 1);
                        $temp = round($p, -($p_rounded));
                        array_push($price_round, (int)$temp);
                    }
                }
                $price_count = array_count_values($price_round);
                arsort($price_count);

                // print_r($price_count);
                //price min-max

                $Recommended_1stprice_start = array_key_first($price_count);
                $Recommended_2ndprice_start = isset(array_keys($price_count)[1]) ? array_keys($price_count)[1] : null;

                if (strlen((string)$Recommended_1stprice_start) < 5) {
                    $Recommended_1stprice_end = 100000;

                } elseif (strlen((string)$Recommended_2ndprice_start) > 7) {
                    $Recommended_1stprice_end = (($Recommended_1stprice_start / pow(10, (strlen((string)$Recommended_1stprice_start) - 1))) + 1) * pow(10, 6);

                } else {
                    $Recommended_1stprice_end = (($Recommended_1stprice_start / pow(10, (strlen((string)$Recommended_1stprice_start) - 1))) + 1) * pow(10, (strlen((string)$Recommended_1stprice_start) - 1));

                }
                $min_price_rc = $Recommended_1stprice_start - (($Recommended_1stprice_start * 20) / 100);
                $max_price_rc = $Recommended_1stprice_end + (($Recommended_1stprice_end * 20) / 100);
                if (isset(array_keys($price_count)[1])) {
                    if (strlen((string)$Recommended_2ndprice_start) < 5) {

                        $Recommended_2ndprice_end = 100000;
                    } elseif (strlen((string)$Recommended_2ndprice_start) > 7) {
                        $Recommended_2ndprice_end = (($Recommended_2ndprice_start / pow(10, (strlen((string)$Recommended_2ndprice_start) - 1))) + 1) * pow(10, 6);
                    } else {
                        $Recommended_2ndprice_end = (($Recommended_2ndprice_start / pow(10, (strlen((string)$Recommended_2ndprice_start) - 1))) + 1) * pow(10, (strlen((string)$Recommended_2ndprice_start) - 1));
                    }
                    $min_price_rc_2nd = $Recommended_2ndprice_start - (($Recommended_2ndprice_start * 20) / 100);
                    $max_price_rc_2nd = $Recommended_2ndprice_end + (($Recommended_2ndprice_end * 20) / 100);
                }


                //Recommend array
                $Recommended_items = (object)[];
                // for($i=0; $i<count($categories_count) &&$i< 5; $i++){
                //     $Recommended_items_1 = Item::where('shop_id', $id)->where('category_id', array_keys($categories_count)[$i])->orderBy('created_at', 'desc')->limit(5-$i)->get();
                // }
                if (count($categories_count) < 1) {
                    $Recommended_items = Item::where('shop_id', $id)->inRandomOrder()->limit(20)->get();
                }
                if (count($categories_count) >= 1) {
                    $Recommended_items_1 = Item::where('shop_id', $id)->where('category_id', array_keys($categories_count)[0])->where(function ($query) use ($min_price_rc, $max_price_rc) {
                        $query->where(function ($query2) use ($min_price_rc, $max_price_rc) {
                            $query2->where('min_price', '=', 0)->whereBetween('price', [$min_price_rc, $max_price_rc]);
                        })->orWhere(function ($query3) use ($min_price_rc, $max_price_rc) {
                            $query3->where('price', '=', 0)->where('min_price', '>=', $min_price_rc)->where('max_price', '<=', $max_price_rc);
                        });
                    })->orderBy('created_at', 'desc')->limit(3)->get();
                    $Recommended_items = $Recommended_items_1;


                    if (isset(array_keys($price_count)[1])) {
                        $Recommended_items_01 = Item::where('shop_id', $id)->where('category_id', array_keys($categories_count)[0])->where(function ($query) use ($min_price_rc_2nd, $max_price_rc_2nd) {
                            $query->where(function ($query2) use ($min_price_rc_2nd, $max_price_rc_2nd) {
                                $query2->where('min_price', '=', 0)->whereBetween('price', [$min_price_rc_2nd, $max_price_rc_2nd]);
                            })->orWhere(function ($query3) use ($min_price_rc_2nd, $max_price_rc_2nd) {
                                $query3->where('price', '=', 0)->where('min_price', '>=', $min_price_rc_2nd)->where('max_price', '<=', $max_price_rc_2nd);
                            });
                        })->orderBy('created_at', 'desc')->limit(2)->get();
                        $Recommended_items = $Recommended_items->merge($Recommended_items_01);
                    }
                }

                if (count($categories_count) >= 2) {
                    $Recommended_items_2 = Item::where('shop_id', $id)->where('category_id', array_keys($categories_count)[1])->where(function ($query) use ($min_price_rc, $max_price_rc) {
                        $query->where(function ($query2) use ($min_price_rc, $max_price_rc) {
                            $query2->where('min_price', '=', 0)->whereBetween('price', [$min_price_rc, $max_price_rc]);
                        })->orWhere(function ($query3) use ($min_price_rc, $max_price_rc) {
                            $query3->where('price', '=', 0)->where('min_price', '>=', $min_price_rc)->where('max_price', '<=', $max_price_rc);
                        });

                    })->orderBy('created_at', 'desc')->limit(2)->get();
                    $Recommended_items = $Recommended_items->merge($Recommended_items_2);
                    if (isset(array_keys($price_count)[1])) {
                        $Recommended_items_02 = Item::where('shop_id', $id)->where('category_id', array_keys($categories_count)[1])->where(function ($query) use ($min_price_rc_2nd, $max_price_rc_2nd) {
                            $query->where(function ($query2) use ($min_price_rc_2nd, $max_price_rc_2nd) {
                                $query2->where('min_price', '=', 0)->whereBetween('price', [$min_price_rc_2nd, $max_price_rc_2nd]);
                            })->orWhere(function ($query3) use ($min_price_rc_2nd, $max_price_rc_2nd) {
                                $query3->where('price', '=', 0)->where('min_price', '>=', $min_price_rc_2nd)->where('max_price', '<=', $max_price_rc_2nd);
                            });
                        })->orderBy('created_at', 'desc')->limit(2)->get();
                        $Recommended_items = $Recommended_items->merge($Recommended_items_02);
                    }
                }
                if (count($categories_count) >= 3) {
                    $Recommended_items_3 = Item::where('shop_id', $id)->where('category_id', array_keys($categories_count)[2])->where(function ($query) use ($min_price_rc, $max_price_rc) {
                        $query->where(function ($query2) use ($min_price_rc, $max_price_rc) {
                            $query2->where('min_price', '=', 0)->whereBetween('price', [$min_price_rc, $max_price_rc]);
                        })->orWhere(function ($query3) use ($min_price_rc, $max_price_rc) {
                            $query3->where('price', '=', 0)->where('min_price', '>=', $min_price_rc)->where('max_price', '<=', $max_price_rc);
                        });
                    })->orderBy('created_at', 'desc')->limit(2)->get();
                    $Recommended_items = $Recommended_items->merge($Recommended_items_3);
                    if (isset(array_keys($price_count)[1])) {
                        $Recommended_items_03 = Item::where('shop_id', $id)->where('category_id', array_keys($categories_count)[2])->where(function ($query) use ($min_price_rc_2nd, $max_price_rc_2nd) {
                            $query->where(function ($query2) use ($min_price_rc_2nd, $max_price_rc_2nd) {
                                $query2->where('min_price', '=', 0)->whereBetween('price', [$min_price_rc_2nd, $max_price_rc_2nd]);
                            })->orWhere(function ($query3) use ($min_price_rc_2nd, $max_price_rc_2nd) {
                                $query3->where('price', '=', 0)->where('min_price', '>=', $min_price_rc_2nd)->where('max_price', '<=', $max_price_rc_2nd);
                            });
                        })->orderBy('created_at', 'desc')->limit(1)->get();
                        $Recommended_items = $Recommended_items->merge($Recommended_items_03);
                    }
                }
                if (count($categories_count) >= 4) {
                    $Recommended_items_4 = Item::where('shop_id', $id)->where('category_id', array_keys($categories_count)[3])->where(function ($query) use ($min_price_rc, $max_price_rc) {
                        $query->where(function ($query2) use ($min_price_rc, $max_price_rc) {
                            $query2->where('min_price', '=', 0)->whereBetween('price', [$min_price_rc, $max_price_rc]);
                        })->orWhere(function ($query3) use ($min_price_rc, $max_price_rc) {
                            $query3->where('price', '=', 0)->where('min_price', '>=', $min_price_rc)->where('max_price', '<=', $max_price_rc);
                        });
                    })->orderBy('created_at', 'desc')->limit(2)->get();
                    $Recommended_items = $Recommended_items->merge($Recommended_items_4);
                    if (isset(array_keys($price_count)[1])) {
                        $Recommended_items_04 = Item::where('shop_id', $id)->where('category_id', array_keys($categories_count)[3])->where(function ($query) use ($min_price_rc_2nd, $max_price_rc_2nd) {
                            $query->where(function ($query2) use ($min_price_rc_2nd, $max_price_rc_2nd) {
                                $query2->where('min_price', '=', 0)->whereBetween('price', [$min_price_rc_2nd, $max_price_rc_2nd]);
                            })->orWhere(function ($query3) use ($min_price_rc_2nd, $max_price_rc_2nd) {
                                $query3->where('price', '=', 0)->where('min_price', '>=', $min_price_rc_2nd)->where('max_price', '<=', $max_price_rc_2nd);
                            });
                        })->orderBy('created_at', 'desc')->limit(1)->get();
                        $Recommended_items = $Recommended_items->merge($Recommended_items_04);
                    }
                }
                if (count($categories_count) >= 5) {
                    $Recommended_items_5 = Item::where('shop_id', $id)->where('category_id', array_keys($categories_count)[4])->where(function ($query) use ($min_price_rc, $max_price_rc) {
                        $query->where(function ($query2) use ($min_price_rc, $max_price_rc) {
                            $query2->where('min_price', '=', 0)->whereBetween('price', [$min_price_rc, $max_price_rc]);
                        })->orWhere(function ($query3) use ($min_price_rc, $max_price_rc) {
                            $query3->where('price', '=', 0)->where('min_price', '>=', $min_price_rc)->where('max_price', '<=', $max_price_rc);
                        });
                    })->orderBy('created_at', 'desc')->limit(2)->get();
                    $Recommended_items = $Recommended_items->merge($Recommended_items_5);
                    if (isset(array_keys($price_count)[1])) {
                        $Recommended_items_05 = Item::where('shop_id', $id)->where('category_id', array_keys($categories_count)[4])->where(function ($query) use ($min_price_rc_2nd, $max_price_rc_2nd) {
                            $query->where(function ($query2) use ($min_price_rc_2nd, $max_price_rc_2nd) {
                                $query2->where('min_price', '=', 0)->whereBetween('price', [$min_price_rc_2nd, $max_price_rc_2nd]);
                            })->orWhere(function ($query3) use ($min_price_rc_2nd, $max_price_rc_2nd) {
                                $query3->where('price', '=', 0)->where('min_price', '>=', $min_price_rc_2nd)->where('max_price', '<=', $max_price_rc_2nd);
                            });
                        })->orderBy('created_at', 'desc')->limit(1)->get();
                        $Recommended_items = $Recommended_items->merge($Recommended_items_05);
                    }
                }
                if (count($categories_count) >= 6) {
                    $Recommended_items_6 = Item::where('shop_id', $id)->where('category_id', array_keys($categories_count)[5])->where(function ($query) use ($min_price_rc, $max_price_rc) {
                        $query->where(function ($query2) use ($min_price_rc, $max_price_rc) {
                            $query2->where('min_price', '=', 0)->whereBetween('price', [$min_price_rc, $max_price_rc]);
                        })->orWhere(function ($query3) use ($min_price_rc, $max_price_rc) {
                            $query3->where('price', '=', 0)->where('min_price', '>=', $min_price_rc)->where('max_price', '<=', $max_price_rc);
                        });
                    })->orderBy('created_at', 'desc')->limit(1)->get();
                    $Recommended_items = $Recommended_items->merge($Recommended_items_6);
                    if (isset(array_keys($price_count)[1])) {
                        $Recommended_items_06 = Item::where('shop_id', $id)->where('category_id', array_keys($categories_count)[5])->where(function ($query) use ($min_price_rc_2nd, $max_price_rc_2nd) {
                            $query->where(function ($query2) use ($min_price_rc_2nd, $max_price_rc_2nd) {
                                $query2->where('min_price', '=', 0)->whereBetween('price', [$min_price_rc_2nd, $max_price_rc_2nd]);
                            })->orWhere(function ($query3) use ($min_price_rc_2nd, $max_price_rc_2nd) {
                                $query3->where('price', '=', 0)->where('min_price', '>=', $min_price_rc_2nd)->where('max_price', '<=', $max_price_rc_2nd);
                            });
                        })->orderBy('created_at', 'desc')->limit(1)->get();
                        $Recommended_items = $Recommended_items->merge($Recommended_items_06);
                    }
                }
                if (count($Recommended_items) < 20) {
                    $Recommended_item_array = [];
                    foreach ($Recommended_items as $Recommended_item) {
                        $Recommended_item_array[] = $Recommended_item->id; // Label
                    }
                    $Recommended_items_7 = Item::where('shop_id', $id)->whereNotIn('id', $Recommended_item_array)->where(function ($query) use ($min_price_rc, $max_price_rc) {
                        $query->where(function ($query2) use ($min_price_rc, $max_price_rc) {
                            $query2->where('min_price', '=', 0)->whereBetween('price', [$min_price_rc, $max_price_rc]);
                        })->orWhere(function ($query3) use ($min_price_rc, $max_price_rc) {
                            $query3->where('price', '=', 0)->where('min_price', '>=', $min_price_rc)->where('max_price', '<=', $max_price_rc);
                        });
                    })->inRandomOrder()->limit((int)ceil((20 - count($Recommended_items)) / 2))->get();
                    $Recommended_items = $Recommended_items->merge($Recommended_items_7);

                    if (isset(array_keys($price_count)[1])) {
                        $Recommended_items_07 = Item::where('shop_id', $id)->whereNotIn('id', $Recommended_item_array)->where(function ($query) use ($min_price_rc_2nd, $max_price_rc_2nd) {
                            $query->where(function ($query2) use ($min_price_rc_2nd, $max_price_rc_2nd) {
                                $query2->where('min_price', '=', 0)->whereBetween('price', [$min_price_rc_2nd, $max_price_rc_2nd]);
                            })->orWhere(function ($query3) use ($min_price_rc_2nd, $max_price_rc_2nd) {
                                $query3->where('price', '=', 0)->where('min_price', '>=', $min_price_rc_2nd)->where('max_price', '<=', $max_price_rc_2nd);
                            });
                        })->inRandomOrder()->limit((int)floor((20 - count($Recommended_items)) / 2))->get();
                        $Recommended_items = $Recommended_items->merge($Recommended_items_07);
                    }
                }
                if (count($Recommended_items) < 20) {
                    foreach ($Recommended_items as $Recommended_item) {
                        $Recommended_item_array[] = $Recommended_item->id; // Label
                    }
                    $Recommended_items_8 = Item::where('shop_id', $id)->whereNotIn('id', $Recommended_item_array)->where(function ($query) use ($min_price_rc, $max_price_rc) {
                        $query->where(function ($query2) use ($min_price_rc, $max_price_rc) {
                            $query2->where('min_price', '=', 0)->whereBetween('price', [$min_price_rc, $max_price_rc]);
                        })->orWhere(function ($query3) use ($min_price_rc, $max_price_rc) {
                            $query3->where('price', '=', 0)->where('min_price', '>=', $min_price_rc)->where('max_price', '<=', $max_price_rc);
                        });
                    })->inRandomOrder()->limit((20 - count($Recommended_items)))->get();
                    $Recommended_items = $Recommended_items->merge($Recommended_items_8);
                }
                if (count($Recommended_items) < 20) {
                    $Recommended_items_9 = Item::where('shop_id', $id)->inRandomOrder()->limit(20 - count($Recommended_items))->get();
                    $Recommended_items = $Recommended_items->merge($Recommended_items_9);
                }
                $shuffled_Recommended_items = $Recommended_items->shuffle();
                $shuffled_Recommended_items->all();
            }


        } else {
            $price = [];
            $categories = [];

            $shuffled_Recommended_items = Item::where('shop_id', $id)->inRandomOrder()->limit(20)->get();
        };
        return view('front.shop_detail', ['premium' => $premiumshops, 'othersellers' => $othersellers, 'shop_data' => $shop, 'forcheck_count' => $forcheck_count, 'get_pop_items' => $get_pop_items, 'items' => $remove_discount_item, 'shops' => $shops, 'allcatcount' => $allcatcount, 'discount' => $discount, 'Recommended_items' => $shuffled_Recommended_items]);
    }


    public function search_result(Request $request)
    {
        $input = $request->except('_token');
        if (empty($request->category_id)) {
            //'%' mean any brand name
            $input['category_id'] = '%';
        }
        if (empty($request->gold_color)) {
            //'%' mean any brand name
            $input['gold_color'] = '%';
        }
        if (empty($request->gold_quality)) {
            //'%' mean any brand name
            $input['gold_quality'] = '%';
        }

        if (empty($request->price_range)) {
            //'%' mean any brand name
            $input['price_from'] = 0;
            $input['price_to'] = 10000000000000;

        } else {

            $str_toarray = explode(" ", str_replace("-", ' ', $request->price_range));
            $input['price_from'] = intval($str_toarray[0]);
            if ($input['price_from'] == 0) {
                $input['price_from'] = 1;
            }
            $input['price_to'] = intval($str_toarray[1]);
        }

        if (empty($request->shops)) {

        } else {
            foreach ($request->shops as $shop) {


            }
        }

        if (empty($request->shops)) {
            $search_result = Item::where([['gold_quality', 'like', $input['gold_quality']], ['category_id', 'like', $input['category_id']], ['gold_colour', 'like', $input['gold_color']]])->where(function ($query) use ($input) {

                $query->whereBetween('price', [$input['price_from'], $input['price_to']])->orWhere(function ($query) use ($input) {
                    $query->where([['min_price', '>', intval($input['price_from'])], ['max_price', '<', intval($input['price_to'])]]);
                });
            })->get();

        } else {
            $search_result = [];
            foreach ($request->shops as $shop) {
                $result_byshop = Item::where([['shop_id', '=', $shop], ['gold_quality', 'like', $input['gold_quality']], ['category_id', 'like', $input['category_id']], ['gold_colour', 'like', $input['gold_color']]])->where(function ($query) use ($input) {

                    $query->whereBetween('price', [$input['price_from'], $input['price_to']])->orWhere(function ($query) use ($input) {
                        $query->where([['min_price', '>', intval($input['price_from'])], ['max_price', '<', intval($input['price_to'])]]);
                    });
                })->get();
                foreach ($result_byshop as $rbs) {
                    array_push($search_result, $rbs);
                }
            }
        }

//        return $search_result;
        return view('front.searchresult', ['search_result' => $search_result]);
    }

    public function getitem_fromshop_bycat($shopid, $cat)
    {
        $items = Item::where([['shop_id', '=', $shopid], ['category_id', '=', $cat]])->orderBy('created_at', 'desc')->limit(30)->get();
        if (count($items) == 0) {
            $catname = '';
        } else {
            $catname = Item::where([['shop_id', '=', $shopid], ['category_id', '=', $cat]])->first()->ykbeauty_cat;

        }


        $allitems = Item::where('shop_id', $shopid)->orderBy('created_at', 'desc');
        //for load more button
        $remove_discount_item_for_count = collect($allitems->get())->filter(function ($value, $key) {
            return $value->check_discount == 0;
        })->values();
        $forcheck_count = $remove_discount_item_for_count->count();

        if ($forcheck_count < 21) {
            $forcheck_count = 0;
        } else {
            $forcheck_count = 1;
        }
        //
        $discount = discount::where('shop_id', $shopid)->orderBy('created_at', 'desc')->limit(20)->get();
        $shops = Shopowner::where('id', '!=', $shopid)->orderBy('created_at', 'desc')->limit(30)->get();
        $shop = Shopowner::where('id', $shopid)->first();
        $allcatcount = collect($allitems->get())->countBy('category_id')->all();

        return view('front.getitembyshocat', ['forcheck_count' => $forcheck_count, 'discount' => $discount, 'items' => $items, 'shops' => $shops, 'shop_data' => $shop, 'catname' => $catname, 'allcatcount' => $allcatcount]);

    }


    public function gold_calculator()
    {
        return view('front.goldcalculator');
    }


    public function see_all_new()
    {


        $shop_ids = DB::table('items')->select('shop_id')->distinct()->get();
        $get_by_shopid = [];
//loop and retrive data by shop id greater than last 10 day
        $count = 0;
        foreach ($shop_ids as $ni) {
            if ($count > 19) {
                break;
            } else {
                $tmpgbsid = Item::where('shop_id', $ni->shop_id)->orderBy('id', 'desc')->limit(10)->get();
                foreach ($tmpgbsid as $tmpsid) {
                    array_push($get_by_shopid, $tmpsid);
                }
                $count += count($tmpgbsid);
            }

        }


        //randomize result
        $get_by_shopid = collect($get_by_shopid)->shuffle()->values();
        //randomize result

        //


//        Cache::remember($tmp_key, now()->addMinutes(60),function () use ($tmp_cache_data,$get_by_shopid){
//            return ['ini_data'=>[$get_by_shopid,0]];
//        });


//        return Cache::get($tmp_key);


        $all_shop_id = Shopowner::where('id', '!=', 1)->orderBy('shop_name', 'asc')->get();
        // $all_shop_id = Shopowner::where('id', '!=', 1)->orderBy('created_at', 'desc')->get();

        return view('front.see_all', ['new_items' => $get_by_shopid, 'shop_ids' => $all_shop_id]);

        // return $get_by_shopid;

    }

    public function see_all_for_shop($neworpop, $shop_id)
    {
        if ($neworpop == 'latest') {
            $new_items = Item::where('shop_id', $shop_id)->orderBy('created_at', 'desc')->limit(20)->get();

        } else {
            $new_items = Item::where('shop_id', $shop_id)->orderBy('view_count', 'desc')->limit(20)->get();

        }

        $temp_shop_name = Shopowner::where('id', $shop_id)->first()->shop_name;

        $forselected = $temp_shop_name;
        //values function is beacause filter retrun {{}} but i need [{}]

        return view('front.seeall_for_shop', ['neworpop' => $neworpop, 'shop_ids' => $this->getallshops(), 'selected_shop' => $forselected, 'new_items' => $new_items, 'shop_id' => $shop_id]);

    }

    public function see_all_pop()
    {

        $pop = Item::orderBy('view_count', 'desc')->limit(20)->get();
        //values function is beacause filter retrun {{}} but i need [{}]
//        $remove_discount_pop = collect($pop)->filter(function ($value, $key) {
//            return $value->check_discount == 0;
//        })->values();
        $all_shop_id = Shopowner::where('id', '!=', 1)->orderBy('shop_name', 'asc')->get();
        // $all_shop_id = Shopowner::where('id', '!=', 1)->orderBy('created_at', 'desc')->get();

        return view('front.seeall_pop', ['pop_items' => $pop, 'shop_ids' => $all_shop_id]);


    }

    public function contact_us()
    {
        $contact = Contactus::where('active', 1)->first();
        return view('front.ContactUs.contactus', ['contact' => $contact]);
    }

    //sync add to cart and fav
    public function fav_search(Request $request)
    {

        $search_result = Item::wherein('id', $request['data'])->get();
        return response()->json(collect($search_result)->values());
    }

    public function addtocart_search(Request $request)
    {
        $search_result = Item::wherein('id', $request['data'])->get();
        return response()->json(collect($search_result)->values());
    }

    public function addtocart_update(Request $request)

    {
        $modelName = "App\\" . ($request['users'] . "_selection");
        $cleanup = $modelName::where('user_id', $request['id'])->delete();
        if ($request['newSelection'] != null) {
            $id_value = array_values($request['newSelection']);
            for ($i = 0; $i < count($id_value); $i++) {
                $user = $modelName::where('user_id', $request['id'])->where('selection_id', $id_value[$i]);
                $query = $user->updateOrInsert(['user_id' => $request['id']], ['selection_id' => $id_value[$i]]);
            }
            return response('Selection update success');
        } else {
            return response('Selection update is null');
        }
    }

    public function fav_update(Request $request)
    {
        $modelName = "App\\" . $request['users'] . "_fav";
        $cleanup = $modelName::where('user_id', $request['id'])->delete();
        if ($request['newFav'] != null) {
            $id_value = array_values($request['newFav']);
            for ($i = 0; $i < count($id_value); $i++) {
                $user = $modelName::where('user_id', $request['id'])->where('fav_id', $id_value[$i]);
                $query = $user->updateOrInsert(['user_id' => $request['id']], ['fav_id' => $id_value[$i]]);
            }
            return response('Fav update success');
        } else {
            return response('Fav update is null');
        }

    }

    public function getNoti()
    {
        if (isset(Auth::guard('shop_owner')->user()->id) || isset(Auth::guard('web')->user()->id) || isset(Auth::guard('shop_role')->user()->id)) {
            return ('noti');
        } else {
            abort(404);
        }
    }

    public function readNoti(Request $request)
    {
        $readNoti = Usernoti::where('sender_shop_id', $request['sender'])->where('receiver_user_id', $request['receiver'])->where('user_type', $request['user'])->where('item_id', $request['item']);
        $query = $readNoti->update(['read_by_receiver' => $request['read_by_receiver']]);
        return redirect()->back();
    }

    public function getShops()
    {
        $shops = Shopowner::orderBy('created_at', 'desc')->get();
        return view('front.shops', ['shops' => $shops]);
    }

    // public function getNewsandEvents() {
    //   return view('font.newsandevents');
    // }

    public function baydins(){
        return view('front.baydins.baydin');
    }

}
