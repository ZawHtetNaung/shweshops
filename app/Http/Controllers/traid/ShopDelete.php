<?php
namespace App\Http\Controllers\traid;

use App\Ads;
use App\Item;
use App\Event;
use App\Manager;
use App\discount;
use App\Collection;
use App\Promotions;
use App\facebooktable;
use App\BuyNowClickLog;
use App\ItemLogActivity;
use App\Percent_template;
use App\AddToCartClickLog;
use App\BackroleLogActivity;
use App\CountSetting;
use App\MultipleDamageLogs;
use App\MultipleDiscountLogs;
use App\MultiplePriceLogs;
use App\ShopLogActivity;
use App\ShopownerLogActivity;

trait ShopDelete
{
    /** Shop Relevant Destroy */
    private function shop_relevant_destroy($id)
    {
        $this->model_accept_delete(new Ads(),$id);
        $this->model_accept_delete(new Event,$id);
        $this->model_accept_delete(new Promotions(),$id);
        //items
        $this->model_accept_delete(new Item(),$id);
        $this->model_accept_delete(new Collection(),$id);
        $this->model_accept_delete(new discount(),$id);
        $this->model_accept_delete(new Percent_template(),$id);
        $this->model_accept_delete(new ItemLogActivity(), $id); //recheck
        $this->model_accept_delete(new facebooktable(),$id);
        //log activities
        // $this->model_accept_delete(new AddToCartClickLog(),$id);
        $this->model_accept_delete(new BackroleLogActivity(),$id);
        // $this->model_accept_delete(new BuyNowClickLog(),$id);
        $this->model_accept_delete(new ShopownerLogActivity(),$id);
        $this->model_accept_delete2(new ShopLogActivity(),$id);
        $this->model_accept_delete(new MultipleDamageLogs(),$id);
        $this->model_accept_delete(new MultipleDiscountLogs(),$id);
        $this->model_accept_delete(new MultiplePriceLogs(),$id);
        //users role
        $this->model_accept_delete(new Manager(),$id);

        $this->model_accept_delete(new CountSetting(),$id);

    }
    private function model_accept_delete($model,$id)
    {
        $get_id = $model::where('shop_id',$id)->pluck('id'); 
        $model::destroy($get_id);
    }
    private function model_accept_delete2($model,$id)
    {
        $get_id = $model::where('shop',$id)->pluck('id'); 
        return $model::destroy($get_id);
    }

    /** Shop Relevant Restore */
    private function shop_relevant_restore($id)
    {
        $this->model_accept_restore(new Ads(),$id);
        $this->model_accept_restore(new Event(),$id);
        $this->model_accept_restore(new Promotions(),$id);
        $this->model_accept_restore(new Item(),$id);
        $this->model_accept_restore(new Collection(),$id);
        $this->model_accept_restore(new discount(),$id);
        $this->model_accept_restore(new Percent_template(),$id);
        $this->model_accept_restore(new ItemLogActivity(),$id);
        $this->model_accept_restore(new facebooktable(),$id);
        // $this->model_accept_restore(new AddToCartClickLog(),$id);
        $this->model_accept_restore(new BackroleLogActivity(),$id);
        // $this->model_accept_restore(new BuyNowClickLog(),$id);
        $this->model_accept_restore(new ShopownerLogActivity(),$id);
        $this->model_accept_restore(new Manager(),$id);
        $this->model_accept_restore2(new ShopLogActivity(),$id);
        $this->model_accept_restore(new MultipleDamageLogs(),$id);
        $this->model_accept_restore(new MultipleDiscountLogs(),$id);
        $this->model_accept_restore(new MultiplePriceLogs(),$id);
        $this->model_accept_restore(new CountSetting(),$id);
    }
    private function model_accept_restore($model,$id)
    {
        $model::onlyTrashed()->where('shop_id',$id)->restore();
    }
    private function model_accept_restore2($model,$id)
    {
        $model::onlyTrashed()->where('shop',$id)->restore();
    }

      /** Shop Relevant ForceDelete */
    private function shop_relevant_force_delete($id)
    {
        $this->model_accept_force_delete(new Ads(),$id);
        $this->model_accept_force_delete(new Event,$id);
        $this->model_accept_force_delete(new Promotions(),$id);
        //items
        $this->model_accept_force_delete(new Item(),$id);
        $this->model_accept_force_delete(new Collection(),$id);
        $this->model_accept_force_delete(new discount(),$id);
        $this->model_accept_force_delete(new Percent_template(),$id);
        $this->model_accept_force_delete(new ItemLogActivity(), $id); //recheck
        $this->model_accept_force_delete(new facebooktable(),$id);
        //log activities
        // $this->model_accept_force_delete(new AddToCartClickLog(),$id);
        $this->model_accept_force_delete(new BackroleLogActivity(),$id);
        // $this->model_accept_force_delete(new BuyNowClickLog(),$id);
        $this->model_accept_force_delete(new ShopownerLogActivity(),$id);
        $this->model_accept_force_delete2(new ShopLogActivity(),$id);
        $this->model_accept_force_delete(new MultipleDamageLogs(),$id);
        $this->model_accept_force_delete(new MultipleDiscountLogs(),$id);
        $this->model_accept_force_delete(new MultiplePriceLogs(),$id);
        //users role
        $this->model_accept_force_delete(new Manager(),$id);
        $this->model_accept_force_delete(new CountSetting(),$id);
    }

    private function model_accept_force_delete($model,$id)
    {
        $get_id = $model::where('shop_id',$id)->onlyTrashed()->pluck('id'); 
        foreach($get_id as $i){
            $model::onlyTrashed()->findOrFail($i)->forceDelete();
        }
    }
    private function model_accept_force_delete2($model,$id)
    {
        $get_id = $model::where('shop',$id)->onlyTrashed()->pluck('id'); 
        foreach($get_id as $i){
             $model::onlyTrashed()->findOrFail($i)->forceDelete();
        }
    }
}
