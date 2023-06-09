<?php

namespace App\Http\Controllers\forfacebook;

use App\facebooktable;
use App\Http\Controllers\Controller;
use App\Http\Controllers\traid\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacebookController extends Controller
{
    use UserRole;
    //

//    public function __construct()
//    {
//
//        $this->middleware('auth:shop_owner,shop_role');
//
//    }
    public function checkwehavetoken(){
//             $shop_id=Auth::guard('shop_owner')->user()->id;
             $shop_id=$this->getshopid();
             $countrecords=facebooktable::where('shop_owner_id',$shop_id)->count();
             if($countrecords == 0){
                 return response()->json(['status'=>false]);
             }else{
                 return response()->json(['status'=>true]);

             }
    }

    public function storetoken(Request $request){
//             $shop_id=Auth::guard('shop_owner')->user()->id;
        $shop_id=$this->getshopid();

        $input=$request->all();
        $input['shop_id']=$shop_id;
        $input['shop_owner_id']=$shop_id;
        $countrecords=facebooktable::create($input)->count();
        if($countrecords == 0){
            return response()->json(['status'=>false]);
        }else{
            return response()->json(['status'=>true]);

        }
    }
}
