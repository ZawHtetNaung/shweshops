<?php

namespace App\Http\Controllers;

use App\Http\Controllers\traid\category;
use App\Item;
use App\Shopowner;
use App\Manager;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Http\Controllers\traid\similarlogic;
use Illuminate\Support\Facades\Auth;


class FrontforcatController extends Controller
{

    use similarlogic;
    use category;

    public function __construct()
    {
//        $this->middleware('user_temp_token');
    }

    public function see_all($id)
    {


        $shop_ids = DB::table('items')->select('shop_id')->where('category_id', $id)->distinct()->get();
        $get_by_shopid = [];
      //loop and retrive data by shop id greater than last 10 day
        $count = 0;
        foreach ($shop_ids as $ni) {
            if ($count > 19) {
                break;
            } else {
                $tmpgbsid = Item::where('shop_id', $ni->shop_id)->where('category_id', $id)->limit(10)->get();
                foreach ($tmpgbsid as $tmpsid) {
                    array_push($get_by_shopid, $tmpsid);
                }
                $count += count($tmpgbsid);
            }

        }
        //for category list
        $allcatcount = $this->getallcatlistbycount();
        //for category list

        //randomize result
        $get_by_shopid = collect($get_by_shopid)->shuffle()->values();
        //randomize result
        $all_shop_id = Shopowner::where('id', '!=', 1)->orderBy('shop_name', 'asc')->get();
        // $all_shop_id = Shopowner::where('id', '!=', 1)->orderBy('created_at', 'desc')->get();


        \LogActivity::addToLog($id);


        return view('front.forcat', ['cat_list' => $allcatcount, 'data' => $get_by_shopid, 'cat_id' => $id, 'shop_ids' => $all_shop_id]);
        // return $get_by_shopid;

    }

    public function search_items()
    {


        $shop_ids = DB::table('items')->select('shop_id')->distinct()->get();
        $get_by_shopid = [];
//loop and retrive data by shop id greater than last 10 day
        $count = 0;
        foreach ($shop_ids as $ni) {
            if ($count > 19) {
                break;
            } else {
                $tmpgbsid = Item::where('shop_id', $ni->shop_id)->limit(10)->get();
                foreach ($tmpgbsid as $tmpsid) {
                    array_push($get_by_shopid, $tmpsid);
                }
                $count += count($tmpgbsid);
            }

        }


        //randomize result
        $get_by_shopid = collect($get_by_shopid)->shuffle()->values();
        //randomize result
        $all_shop_id = Shopowner::where('id', '!=', 1)->orderBy('shop_name', 'asc')->get();
        // $all_shop_id = Shopowner::where('id', '!=', 1)->orderBy('created_at', 'desc')->get();

        return view('front.forcat', ['data' => $get_by_shopid, 'cat_id' => 'all', 'shop_ids' => $all_shop_id]);
        // return $get_by_shopid;
    }

    public function catfilter(Request $request)
    {
        // return $request;
        if ($request->filtertype['discount'] == 'yes') {
            $discountquery = 'discount.id IS NOT NULL';
        } else {
            $discountquery = 'items.id IS NOT NULL';

        }

        if ($request->filtertype['item_id'] != 'empty') {
            $similar = $this->getsimilarsqlcode($request->filtertype['item_id']);
            $forkey = 'forsim';
        } else {
            $similar = "IF (items.id > 0,items.id,'')";
            $forkey = 'forcat';
        }
        //for cache main key
        $tmp_key = Session::get('tmp_token');

        $all_id = [];

        //create cache key
        $cache_key = ($request->filtertype['ini_checked']) ? 'ini' : '' . $forkey . 'cat_id'
          . str_replace(' ', '', implode("_", $request->filtertype['cat_id'])) . 'price_range' . $request->filtertype['price_range']
          . 'byshop' . str_replace(' ', '', implode("_", $request->filtertype['byshop']))
          . 'sort' . $request->filtertype['sort'] . 'gender' . $request->filtertype['gender']
          . 'gems' . str_replace(' ', '', implode("_", $request->filtertype['gems']))
          . 'goldcolour' . $request->filtertype['gold_colour'] . 'goldquality' . $request->filtertype['gold_quality'];
        //create cache key

        //to check all data id from client payload

        if ($request->filtertype['ini_checked']) {
            $ini_items = $request->data;
            foreach ($request->data as $dt) {
                array_push($all_id, $dt['id']);
            }
        }

        if (!empty(Cache::get($tmp_key)['filter'][$cache_key])) {
            foreach (Cache::get($tmp_key)['filter'][$cache_key] as $rd) {
                array_push($all_id, $rd['id']);
            }
        } else {
            $all_id = [0, 0];
        }
        //to check all data id from client payload

        //for filters

        if(!$request->filtertype['cat_id']) {
          $cat_id = [];
        } else {
          $cat_id = $request->filtertype['cat_id'];
        }


        if ($request->filtertype['price_range'] == 'all') {
            $price_from = 0;
            $price_to = 10000000000000;
        } else {
            $str_toarray = explode(" ", str_replace("-", ' ', $request->filtertype['price_range']));
            $price_from = intval($str_toarray[0]);

            $price_to = intval($str_toarray[1]);
        }
        // $get_shopname_id = Shopowner::where('shop_name', $request->filtertype['byshop'])->first();
        $get_shopname_id = Shopowner::whereIn('id', $request->filtertype['byshop'])->get();
        if ($request->filtertype['byshop'][0] == 'all') {
          $shops = 'all';
            if ($request->filtertype['additional'] == 'no') {
                $tmp_shop_id = 'items.shop_id > 0';
            } else {
                $tmp_shop_id = 'items.shop_id !=' . $request->filtertype['additional'];
            }

        } else {
          $shops = '';
            $tmp_shop_id = [];
            foreach ($get_shopname_id as $gsi) {
                $tmp_shop_id[] = $gsi->id;
            }
        }
        if ($request->filtertype['sort'] == 'price_low_to_high') {
            $tmp_order = "CASE
                        WHEN discount.discount_price = 0 THEN discount.discount_min
            WHEN discount.discount_price !=  0 THEN discount.discount_price
            WHEN items.price=0 THEN min_price
            WHEN items.price!=0 THEN price
            END
            ASC";
        }
        if ($request->filtertype['sort'] == 'price_high_to_low') {
            $tmp_order = "CASE
                        WHEN discount.discount_price = 0 THEN discount.discount_min
            WHEN discount.discount_price !=  0 THEN discount.discount_price
            WHEN items.price=0 THEN min_price
            WHEN items.price!=0 THEN price
            END
            DESC";
        }
        if ($request->filtertype['sort'] == 'latest') {

            $tmp_order = 'items.id DESC';
        }
        if ($request->filtertype['sort'] == 'all') {

            $tmp_order = 'items.id DESC';
        }
        if ($request->filtertype['sort'] == 'popular') {

            $tmp_order = 'items.view_count DESC';
        }
        if ($request->filtertype['sort'] == 'discountpercent') {

            $tmp_order = 'discount.percent DESC';
        }

        if(!$request->filtertype['gems']) {
          $gems = [];
        } else {
          $gems = $request->filtertype['gems'];
        }

        if($request->filtertype['gender'] == 'all') {
          $gender = '%';
        } else {
          $gender = $request->filtertype['gender'] . '%';
        }

        if($request->filtertype['gold_colour'] == 'all') {
          $gold_colour = '%';
        } else {
          $gold_colour = $request->filtertype['gold_colour'];
        }

        if($request->filtertype['gold_quality'] == 'all') {
          $gold_quality = '%';
        } else {
          $gold_quality = $request->filtertype['gold_quality'];
        }

        //for filters

        // To fix

        if ($request->filtertype['typesearch'] != "") {
          $checkcat = \App\Category::whereRaw("mm_name REGEXP '(" .  $request->filtertype['typesearch']. ")'");
          if ($checkcat->count() > 0) {
              $checkcat = $checkcat->first()->name;
          } else {
            $checkcat = $request->filtertype['typesearch'];
          }

          $typesearchresult = Item::select('items.id')
            ->leftjoin('tagging_tagged', 'items.id', '=', 'tagging_tagged.taggable_id')
            ->leftjoin('for_gems_and_diamonds', 'items.id', '=', 'for_gems_and_diamonds.item_id')
            ->where(function ($query) use ($request, $checkcat){
              $query->where('items.name', 'like', '%' . $request->filtertype['typesearch'] . '%')
                    ->orWhere('items.name', 'like', '%' . $request->filtertype['typesearch'] . '%')
                    ->orwhereRaw("tagging_tagged.tag_name REGEXP '(" . $request->filtertype['typesearch'] . ")'")
                    ->orWhere('items.category_id', 'like', $checkcat)
                    ->orWhere('items.gold_quality', 'like', $request->filtertype['typesearch'] . '%')
                    ->orWhere('items.gold_colour', 'like', $request->filtertype['typesearch'] . '%')
                    ->orWhere('items.gender', 'like', $request->filtertype['typesearch'] . '%')
                    ->orWhere('items.product_code', 'like', '%' . $request->filtertype['typesearch'] . '%')
                    ->orWhere('items.product_code', 'like', '%' . $request->filtertype['typesearch'] . '%');
            })
            // ->toSql();
            ->pluck('id');

          $tostring=implode(",",$typesearchresult->toArray());
          $typesearchquery='items.id IN ('.$tostring.')';
        }else{
            $typesearchquery='items.id != 0';
        }


        if ($request->filtertype['typesearch'] != "" && empty($tostring)) {
          return response()->json([[], 0, 'empty_on_server' => 1, 'search_key' => []]);
        }

        $tmp_data = Item::select('items.*')
            ->leftjoin('discount', 'items.id', '=', 'discount.item_id')
            ->leftjoin('for_gems_and_diamonds', 'items.id', '=', 'for_gems_and_diamonds.item_id')
            ->whereRaw($typesearchquery)
            ->where(function($query) use ($gems) {
              if(!empty($gems)){
                foreach ($gems as $gem) {
                  $query->orwhereRaw("for_gems_and_diamonds.gems REGEXP '" . $gem . "'");
                }
              }
            })
            ->where(function ($query) use ($similar) {
                $query->whereRaw($similar);
            })
            ->where('items.gender', 'like', $gender)
            ->where('items.gold_colour', 'like', $gold_colour)
            ->where('items.gold_quality', 'like', $gold_quality)
            ->where(function($query) use ($cat_id) {
              if(!empty($cat_id)){
                foreach ($cat_id as $ci) {
                  $query->orWhere("items.category_id", 'like', $ci);
                }
              }
            })
            ->where(function ($query) use ($discountquery) {
              $query->whereRaw($discountquery);
            })
            ->where(function ($query) use ($tmp_shop_id, $shops) {
              if($shops == 'all') {
                $query->whereRaw($tmp_shop_id);
              } else {
                $query->whereIn('items.shop_id', $tmp_shop_id);
              }
            })
            ->where(function ($query) use ($price_to, $price_from) {
                $query->where('items.price', '!=', 0)
                      ->whereBetween('items.price', [$price_from, $price_to])
                      ->orWhere(function ($query) use ($price_to, $price_from) {
                        $query->where([['items.min_price', '>', $price_from], ['items.max_price', '<', $price_to]]);
                      });
            })->orderByRaw($tmp_order)

            // ->toSql();
            ->skip($request->filtertype['limit'])
            ->take('20')->get();

        // dd($tmp_data);

        if (count($tmp_data) < 20) {
            $empty_on_server = 1;

        } else {
            $empty_on_server = 0;

        }
        if ($request->filtertype['ini_checked']) {
            $random = collect($tmp_data)->shuffle()->values();
        } else {
            $random = $tmp_data;
        }


        return response()->json([$random, 0, 'empty_on_server' => $empty_on_server, 'search_key' => $cache_key]);
    }
}
