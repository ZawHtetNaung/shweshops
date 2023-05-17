<?php

namespace App\Http\Controllers\Shopowner;
use App\Collection;
use App\Http\Controllers\Controller;


use App\Item;
use App\Shopowner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CollectionController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('manager');
    }
    public function list(){
        $collection=Collection::all();
        $shopowner = Shopowner::where('id', Auth::guard('shop_owner')->user()->id)->orderBy('created_at', 'desc')->get();
        return view('backend.shopowner.item.collection.list',['shopowner' => $shopowner,'collection'=>$collection]);
    }

    public function create(){
        $shopowner = Shopowner::where('id', Auth::guard('shop_owner')->user()->id)->orderBy('created_at', 'desc')->get();
        return view('backend.shopowner.item.collection.create',['shopowner' => $shopowner]);
    }
    public function store(Request $request){
        $input=$request->except('_token');
        $rules = [

            'name' => ['required', 'string', 'max:255'],


        ];
        $input['shop_id']=Auth::guard('shop_owner')->user()->id;
        $validate = Validator::make($input, $rules);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }else{
           if(Collection::create($input)){
               Session::flash('message', 'Your collection was successfully added');

               return redirect('/backside/shop_owner/collection/list');

           }

        }
    }

    public function detail($id){
        $col_items=Item::where([['shop_id','=',Auth::guard('shop_owner')->user()->id],['collection_id','=',$id]])->get();
        $col=Collection::where('id',$id)->first();
        $shopowner = Shopowner::where('id', Auth::guard('shop_owner')->user()->id)->orderBy('created_at', 'desc')->get();

        return view('backend.shopowner.item.collection.detail',['shopowner' => $shopowner,'col'=>$col,'col_items'=>$col_items]);
    }
    public function additemlist($id){
        $col_items=Item::where([['shop_id','=',Auth::guard('shop_owner')->user()->id],['collection_id','=',0]])->get();
        $col=Collection::where('id',$id)->first();

        return view('backend.shopowner.item.collection.itemlist',['col'=>$col,'col_items'=>$col_items]);
    }
    public function additem($id,Request $request){
        $col=Collection::where('id',$id)->first();

        Item::where([['shop_id','=',Auth::guard('shop_owner')->user()->id],['id','=',$request->item_id]])->update(['collection_id'=>$request->col_id]);
        Session::flash('message', 'Your item was successfully added to '.$col->name.'collection');

        return redirect(url('/backside/shop_owner/collection/add/list/'.$id));
    }
    public function removeitem(Request $request){

        Item::where([['shop_id','=',Auth::guard('shop_owner')->user()->id],['id','=',$request->item_id]])->update(['collection_id'=>0]);
        Session::flash('message', 'Your item was successfully removed');

        return redirect()->back();
    }
}
