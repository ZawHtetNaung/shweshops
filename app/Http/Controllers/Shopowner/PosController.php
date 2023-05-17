<?php

namespace App\Http\Controllers\Shopowner;

use App\Staff;
use App\State;
use App\Diamond;
use App\Quality;
use App\Category;
use App\Purchase;
use App\Supplier;
use App\Township;
use App\Shopowner;
use App\PosQuality;
use App\KyoutPurchase;
use App\AssignGoldPrice;
use App\PlatinumPurchase;
use Illuminate\Support\Str;
use App\AssignPlatinumPrice;
use Illuminate\Http\Request;
use App\View\Components\alert;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use PhpParser\Node\Stmt\Foreach_;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\traid\TzRule;
use App\Http\Controllers\traid\ykimage;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\traid\UserRole;
use App\Http\Requests\ItemsRecapRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\traid\MultipleItem;
use App\Http\Requests\ItemsRecapUpdateRequest;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\MultiplePriceUpdateRequest;

class PosController extends Controller
{
    use ykimage, UserRole, MultipleItem;

    public $err_data = [];

    public function __construct()
    {
        $this->middleware(['auth:shop_owner,shop_role','can_use_pos']);
    }

    public function getSalePage()
    {
        $shopowner = Shopowner::where('id', $this->getshopid())->orderBy('created_at', 'desc')->get();

        return view('backend.pos.sale_page',['shopowner'=>$shopowner]);
    }

    //Purchase
       //gold

    public function getPurchaseList(){
        $shopowner = Shopowner::where('id', $this->getshopid())->orderBy('created_at', 'desc')->get();
        $purchases = Purchase::all();

        return view('backend.pos.purchase_list',['shopowner'=>$shopowner,'purchases'=>$purchases]);
    }

    public function goldtypeFilter(Request $request){
        // dd($request->all());
        if($request->type == 1){
            $type = explode('/',$request->text);
        $types = [];
        foreach($type as $t){
            $sup = Purchase::where('type', 'like', '%' . $t . '%')->with('supplier')->get();
            array_push($types,$sup);
        }
        foreach($types as $tp){
            $data = collect($tp)->unique('id')->all();
        }
        }
        if($request->type == 2){
            $data = Purchase::whereBetween('date', [$request->start_date, $request->end_date])->with('supplier')->get();
        }

        return response()->json([
            'data' => $data,
        ]);
    }

    public function createPurchase(){
        $shopowner = Shopowner::where('id', $this->getshopid())->orderBy('created_at', 'desc')->get();
        $categories = Category::all();
        $suppliers = Supplier::orderBy('count', 'desc')->get();
        $quality = DB::table('pos_qualities')->get();
        $date = Carbon::now();
        // $price = AssignGoldPrice::where('date',$date->toDateString())->first();
        $price = AssignGoldPrice::first();
        // dd($price->open_price);
        $shop_price = explode('/',$price->open_price)[0];
        $out_price = explode('/',$price->open_price)[1];

        return view('backend.pos.create_purchase',['shopowner'=>$shopowner,'categories'=>$categories,'suppliers'=>$suppliers,'quality'=>$quality,'shop_price'=>$shop_price,'out_price'=>$out_price]);
    }

    public function storePurchase(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'code_number' => 'required|unique:purchases,code_number',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try{
           if($request->hasfile('photo')){
               $image = $request->file('photo');
               $filename = time()."-".$image->getClientOriginalName();
               $image->move(public_path() . '/pos/goldpurchase_photo/', $filename);
            }else{
                $filename = 'default.png';
            }
            if($request->inlineCheckbox1){$inlineCheckbox1 = $request->inlineCheckbox1;}else{$inlineCheckbox1 = 'no';}
            if($request->inlineCheckbox2){$inlineCheckbox2 = $request->inlineCheckbox2;}else{$inlineCheckbox2 = 'no';}
            if($request->inlineCheckbox3){$inlineCheckbox3 = $request->inlineCheckbox3;}else{$inlineCheckbox3 = 'no';}
            if($request->inlineCheckbox4){$inlineCheckbox4 = $request->inlineCheckbox4;}else{$inlineCheckbox4 = 'no';}

            $purchase = Purchase::create([
                'date' => $request->date,
                'supplier_id' => $request->supplier_id,
                'quality_id' => $request->quality,
                'staff_id' => $request->staff_id,
                'purchase_price' => $request->purchase_price,
                'category_id' => $request->category_id,
                'code_number' => $request->code_number,
                'product_gram_kyat_pe_yway' => $request->product_gram.'/'.$request->product_kyat.'/'.$request->product_pe.'/'.$request->product_yway,
                'decrease_pe_yway' => $request->decrease_pe.'/'.$request->decrease_yway,
                'profit_pe_yway' => $request->profit_pe.'/'.$request->profit_yway,
                'service_pe_yway' => $request->service_pe.'/'.$request->service_yway,
                'decrease_price' => $request->decrease_price.'/'.$request->currency,
                'gold_price' => $request->gold_price,
                'profit' => $request->profit.'/'.$request->currency1,
                'service_fee' => $request->service_fee.'/'.$request->currency2,
                'gold_fee' => $request->gold_fee,
                'gold_type' => $request->gold_type,
                'gold_name' => $request->gold_name,
                'selling_price' => $request->selling_price,
                'remark' => $request->remark,
                'photo' => $filename,
                'barcode_text' => $request->barcode_text,
                'type' => $inlineCheckbox1.'/'.
                      $inlineCheckbox2.'/'.
                      $inlineCheckbox3.'/'.
                      $inlineCheckbox4,
            ]);

            $count = Supplier::find($request->supplier_id);
            $count->count += 1;
            $count->save();

            Session::flash('message', 'Purchase was successfully Created!');

            return redirect()->route('backside.shop_owner.pos.purchase_list');
        } catch (\Exception $e) {

            Session::flash('alert-class', 'Something Wrong!');
            return redirect()->back();

        }

    }

    public function getPurchaseCode(Request $request){
        try{
        $category = Category::find($request->category_id);
        $letter = strtoupper(mb_substr($category->name, 0, 1));
        if($request->type == 'gold'){
            $purchase = Purchase::all();
        }
        if($request->type == 'kyout'){
            $purchase = KyoutPurchase::all();
        }
        $count = count($purchase);
        $code = $letter.sprintf("%04s", $count+1);

        return response()->json([
            'code' => $code,
        ]);
        } catch (\Exception $e) {

           return response()->json([
            'code' => 0,
           ]);

        }
    }

    public function getQualityPrice(Request $request){
        $assign = AssignGoldPrice::first();
        if($request->quality_id == 1){
            $price = $assign->price_16;
        }
        if($request->quality_id == 2){
            $price = $assign->outprice_15;
        }
        if($request->quality_id == 3){
            $price = $assign->inprice_15;
        }
        if($request->quality_id == 4){
            $price = $assign->outprice_14;
        }
        if($request->quality_id == 5){
            $price = $assign->inprice_14;
        }
        if($request->quality_id == 6){
            $price = $assign->outprice_14_2;
        }
        if($request->quality_id == 7){
            $price = $assign->inprice_14_2;
        }
        if($request->quality_id == 8){
            $price = $assign->outprice_13;
        }
        if($request->quality_id == 9){
            $price = $assign->inprice_13;
        }
        if($request->quality_id == 10){
            $price = $assign->outprice_12;
        }
        if($request->quality_id == 11){
            $price = $assign->inprice_12;
        }
        if($request->quality_id == 12){
            $price = $assign->outprice_12_2;
        }
        if($request->quality_id == 13){
            $price = $assign->inprice_12_2;
        }
        $p = explode('/',$price)[0];
        return response()->json($p);
    }

    public function deletePurchase(Request $request){
        $purchase = Purchase::find($request->pid);
        $purchase->delete();
        Session::flash('message', 'Purchase was successfully Deleted!');
        return response()->json([
            'data'=> 'success'
        ],200);
    }

    public function editPurchase($id){
        $shopowner = Shopowner::where('id', $this->getshopid())->orderBy('created_at', 'desc')->get();
        $categories = Category::all();
        $suppliers = Supplier::orderBy('count', 'desc')->get();
        $purchase = Purchase::find($id);
        $quality = PosQuality::all();
        $date = Carbon::now();
        // $price = AssignGoldPrice::where('date',$date->toDateString())->first();
        $price = AssignGoldPrice::first();
        // dd($price->open_price);
        $shop_price = explode('/',$price->open_price)[0];
        $out_price = explode('/',$price->open_price)[1];

        return view('backend.pos.edit_purchase',['shopowner'=>$shopowner,'categories'=>$categories,'suppliers'=>$suppliers,'purchase'=>$purchase,'quality'=>$quality,'shop_price'=>$shop_price,'out_price'=>$out_price]);
    }

    public function updatePurchase(Request $request,$id){
       try{
        $purchase = Purchase::find($id);
        if($request->hasfile('photo')){
            $image = $request->file('photo');
            $filename = time()."-".$image->getClientOriginalName();
            $image->move(public_path() . '/pos/purchase_photo/', $filename);

            // dd($filename);
         }else{
             $filename = $purchase->photo;
            //  dd($filename);
         }

        if($request->inlineCheckbox1){$inlineCheckbox1 = $request->inlineCheckbox1;}else{$inlineCheckbox1 = 'no';}
        if($request->inlineCheckbox2){$inlineCheckbox2 = $request->inlineCheckbox2;}else{$inlineCheckbox2 = 'no';}
        if($request->inlineCheckbox3){$inlineCheckbox3 = $request->inlineCheckbox3;}else{$inlineCheckbox3 = 'no';}
        if($request->inlineCheckbox4){$inlineCheckbox4 = $request->inlineCheckbox4;}else{$inlineCheckbox4 = 'no';}

        $purchase->date = $request->date;
        $purchase->supplier_id = $request->supplier_id;
        $purchase->quality_id = $request->quality;
        $purchase->staff_id = $request->staff_id;
        $purchase->purchase_price = $request->purchase_price;
        $purchase->category_id = $request->category_id;
        $purchase->code_number = $request->code_number;
        $purchase->product_gram_kyat_pe_yway = $request->product_gram.'/'.$request->product_kyat.'/'.$request->product_pe.'/'.$request->product_yway;
        $purchase->decrease_pe_yway = $request->decrease_pe.'/'.$request->decrease_yway;
        $purchase->profit_pe_yway = $request->profit_pe.'/'.$request->profit_yway;
        $purchase->service_pe_yway = $request->service_pe.'/'.$request->service_yway;
        $purchase->decrease_price = $request->decrease_price.'/'.$request->currency;
        $purchase->gold_price = $request->gold_price;
        $purchase->profit = $request->profit.'/'.$request->currency1;
        $purchase->service_fee = $request->service_fee.'/'.$request->currency2;
        $purchase->gold_fee = $request->gold_fee;
        $purchase->gold_type = $request->gold_type;
        $purchase->gold_name = $request->gold_name;
        $purchase->selling_price = $request->selling_price;
        $purchase->remark = $request->remark;
        $purchase->photo = $filename;
        $purchase->barcode_text = $request->barcode_text;
        $purchase->type = $inlineCheckbox1.'/'.
                      $inlineCheckbox2.'/'.
                      $inlineCheckbox3.'/'.
                      $inlineCheckbox4;
        $purchase->save();
        Session::flash('message', 'Purchase was successfully Updated!');
        return redirect()->route('backside.shop_owner.pos.purchase_list');
       } catch (\Exception $e) {
        return redirect()->back();
       }
    }

        //kyout
    public function getKyoutPurchaseList(){
        $shopowner = Shopowner::where('id', $this->getshopid())->orderBy('created_at', 'desc')->get();
        $purchases = KyoutPurchase::all();
        return view('backend.pos.kyout_purchase_list',['shopowner'=>$shopowner,'purchases'=>$purchases]);
    }

    public function kyouttypeFilter(Request $request){
        // dd($request->all());
        if($request->type == 1){
            $type = explode('/',$request->text);
        $types = [];
        foreach($type as $t){
            $sup = KyoutPurchase::where('type', 'like', '%' . $t . '%')->with('supplier')->get();
            array_push($types,$sup);
        }
        foreach($types as $tp){
            $data = collect($tp)->unique('id')->all();
        }
        }
        if($request->type == 2){
            $data = KyoutPurchase::whereBetween('date', [$request->start_date, $request->end_date])->with('supplier')->with('quality')->get();
        }

        return response()->json([
            'data' => $data,
        ]);
    }

    public function createKyoutPurchase(){
        $shopowner = Shopowner::where('id', $this->getshopid())->orderBy('created_at', 'desc')->get();
        $categories = Category::all();
        $suppliers = Supplier::orderBy('count', 'desc')->get();
        $quality = DB::table('pos_qualities')->get();
        $price = AssignGoldPrice::first();
        // dd($price->open_price);
        $shop_price = explode('/',$price->open_price)[0];
        $out_price = explode('/',$price->open_price)[1];

        return view('backend.pos.create_kyout_purchase',['shopowner'=>$shopowner,'categories'=>$categories,'suppliers'=>$suppliers,'quality'=>$quality,'shop_price'=>$shop_price,'out_price'=>$out_price]);
    }

    public function getPhone(Request $request){
        $supplier = Supplier::find($request->supplier_id);
        return response()->json($supplier);
    }

    public function storeKyoutPurchase(Request $request){
        $validator = Validator::make($request->all(), [
            'code_number' => 'required|unique:kyout_purchases,code_number',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try{
            if($request->hasfile('photo')){
                $image = $request->file('photo');
                $filename = time()."-".$image->getClientOriginalName();
                $image->move(public_path() . '/pos/kyoutpurchase_photo/', $filename);
             }else{
                 $filename = 'default.png';
             }
             if($request->inlineCheckbox1){$inlineCheckbox1 = $request->inlineCheckbox1;}else{$inlineCheckbox1 = 'no';}
             if($request->inlineCheckbox2){$inlineCheckbox2 = $request->inlineCheckbox2;}else{$inlineCheckbox2 = 'no';}
             if($request->inlineCheckbox3){$inlineCheckbox3 = $request->inlineCheckbox3;}else{$inlineCheckbox3 = 'no';}
             if($request->inlineCheckbox4){$inlineCheckbox4 = $request->inlineCheckbox4;}else{$inlineCheckbox4 = 'no';}

             $purchase = KyoutPurchase::create([
                 'date' => $request->date,
                 'supplier_id' => $request->supplier_id,
                 'quality_id' => $request->quality,
                 'staff_id' => $request->staff_id,
                 'diamond_id' => $request->diamond_id,
                 'purchase_price' => $request->purchase_price,
                 'category_id' => $request->category_id,
                 'code_number' => $request->code_number,
                 'gold_gram_kyat_pe_yway' => $request->gold_gram.'/'.$request->gold_kyat.'/'.$request->gold_pe.'/'.$request->gold_yway,
                 'diamond_gram_kyat_pe_yway' => $request->diamond_gram.'/'.$request->diamond_kyat.'/'.$request->diamond_pe.'/'.$request->diamond_yway,
                 'decrease_pe_yway' => $request->decrease_pe.'/'.$request->decrease_yway,
                 'profit_pe_yway' => $request->profit_pe.'/'.$request->profit_yway,
                 'service_pe_yway' => $request->service_pe.'/'.$request->service_yway,
                 'decrease_price' => $request->decrease_price.'/'.$request->currency,
                 'gold_price' => $request->gold_price,
                 'profit' => $request->profit.'/'.$request->currency1,
                 'service_fee' => $request->service_fee.'/'.$request->currency2,
                 'gold_fee' => $request->gold_fee,
                 'gold_type' => $request->gold_type,
                 'gold_name' => $request->gold_name,
                 'selling_price' => $request->selling_price,
                 'diamond_selling_price' => $request->diamond_selling_price,
                 'capital' => $request->capital,
                 'remark' => $request->remark,
                 'photo' => $filename,
                 'barcode_text' => $request->barcode_text,
                 'type' => $inlineCheckbox1.'/'.
                       $inlineCheckbox2.'/'.
                       $inlineCheckbox3.'/'.
                       $inlineCheckbox4,
             ]);

             $count = Supplier::find($request->supplier_id);
             $count->count += 1;
             $count->save();

             Session::flash('message', 'Purchase was successfully Created!');

             return redirect()->route('backside.shop_owner.pos.kyout_purchase_list');
         } catch (\Exception $e) {

             Session::flash('alert-class', 'Something Wrong!');
             return redirect()->back();

         }


    }

    public function editKyoutPurchase($id){
        $shopowner = Shopowner::where('id', $this->getshopid())->orderBy('created_at', 'desc')->get();
        $categories = Category::all();
        $suppliers = Supplier::orderBy('count', 'desc')->get();
        $purchase = KyoutPurchase::find($id);
        $quality = PosQuality::all();
        $price = AssignGoldPrice::first();
        // dd($price->open_price);
        $shop_price = explode('/',$price->open_price)[0];
        $out_price = explode('/',$price->open_price)[1];

        return view('backend.pos.edit_kyout_purchase',['shopowner'=>$shopowner,'purchase'=>$purchase,'categories'=>$categories,'suppliers'=>$suppliers,'quality'=>$quality,'shop_price'=>$shop_price,'out_price'=>$out_price]);
    }

    public function updateKyoutPurchase(Request $request,$id){
        try{
         $purchase = KyoutPurchase::find($id);
         if($request->hasfile('photo')){
             $image = $request->file('photo');
             $filename = time()."-".$image->getClientOriginalName();
             $image->move(public_path() . '/pos/kyoutpurchase_photo/', $filename);
          }else{
              $filename = $purchase->photo;
          }

        if($request->inlineCheckbox1){$inlineCheckbox1 = $request->inlineCheckbox1;}else{$inlineCheckbox1 = 'no';}
        if($request->inlineCheckbox2){$inlineCheckbox2 = $request->inlineCheckbox2;}else{$inlineCheckbox2 = 'no';}
        if($request->inlineCheckbox3){$inlineCheckbox3 = $request->inlineCheckbox3;}else{$inlineCheckbox3 = 'no';}
        if($request->inlineCheckbox4){$inlineCheckbox4 = $request->inlineCheckbox4;}else{$inlineCheckbox4 = 'no';}

        $purchase->date = $request->date;
        $purchase->supplier_id = $request->supplier_id;
        $purchase->quality_id = $request->quality;
        $purchase->staff_id = $request->staff_id;
        $purchase->diamond_id = $request->diamond_id;
        $purchase->purchase_price = $request->purchase_price;
        $purchase->category_id = $request->category_id;
        $purchase->code_number = $request->code_number;
        $purchase->gold_gram_kyat_pe_yway = $request->gold_gram.'/'.$request->gold_kyat.'/'.$request->gold_pe.'/'.$request->gold_yway;
        $purchase->diamond_gram_kyat_pe_yway = $request->diamond_gram.'/'.$request->diamond_kyat.'/'.$request->diamond_pe.'/'.$request->diamond_yway;
        $purchase->decrease_pe_yway = $request->decrease_pe.'/'.$request->decrease_yway;
        $purchase->profit_pe_yway = $request->profit_pe.'/'.$request->profit_yway;
        $purchase->service_pe_yway = $request->service_pe.'/'.$request->service_yway;
        $purchase->decrease_price = $request->decrease_price.'/'.$request->currency;
        $purchase->gold_price = $request->gold_price;
        $purchase->profit = $request->profit.'/'.$request->currency1;
        $purchase->service_fee = $request->service_fee.'/'.$request->currency2;
        $purchase->gold_fee = $request->gold_fee;
        $purchase->gold_type = $request->gold_type;
        $purchase->gold_name = $request->gold_name;
        $purchase->selling_price = $request->selling_price;
        $purchase->diamond_selling_price = $request->diamond_selling_price;
        $purchase->capital = $request->capital;
        $purchase->remark = $request->remark;
        $purchase->photo = $filename;
        $purchase->barcode_text = $request->barcode_text;
        $purchase->type = $inlineCheckbox1.'/'.
                      $inlineCheckbox2.'/'.
                      $inlineCheckbox3.'/'.
                      $inlineCheckbox4;
        $purchase->save();
         Session::flash('message', 'Purchase was successfully Updated!');
         return redirect()->route('backside.shop_owner.pos.kyout_purchase_list');
        } catch (\Exception $e) {
         return redirect()->back();
        }
     }

    public function deleteKyoutPurchase(Request $request){
        $purchase = KyoutPurchase::find($request->pid);
        $purchase->delete();
        Session::flash('message', 'Kyout Purchase was successfully Deleted!');
        return response()->json([
            'data'=> 'success'
        ],200);
    }

    //Platinum
    public function getPtmPurchaseList(){
        $shopowner = Shopowner::where('id', $this->getshopid())->orderBy('created_at', 'desc')->get();
        $purchases = PlatinumPurchase::all();
        return view('backend.pos.platinum_purchase_list',['shopowner'=>$shopowner,'purchases'=>$purchases]);
    }
    public function createPtmPurchase(){
        $shopowner = Shopowner::where('id', $this->getshopid())->orderBy('created_at', 'desc')->get();
        $categories = Category::all();
        $date = Carbon::now();
        // $price = AssignGoldPrice::where('date',$date->toDateString())->first();
        $price = AssignPlatinumPrice::first();
        // dd($price->open_price);
        $gradeA = $price->gradeA;
        $gradeB = $price->gradeB;

        return view('backend.pos.create_platinum_purchase',['shopowner'=>$shopowner,'categories'=>$categories,'gradeA'=>$gradeA,'gradeB'=>$gradeB]);
    }
    public function getPtmQualityPrice(Request $request){
        $assign = AssignPlatinumPrice::first();
        if($request->quality == 'Grade A'){
            $price = $assign->gradeA;
        }
        if($request->quality == 'Grade B'){
            $price = $assign->gradeB;
        }
        if($request->quality == 'Grade C'){
            $price = $assign->gradeC;
        }
        if($request->quality == 'Grade D'){
            $price = $assign->gradeD;
        }
        return response()->json($price);
    }
    public function storePtmPurchase(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'code_number' => 'required|unique:purchases,code_number',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try{
           if($request->hasfile('photo')){
               $image = $request->file('photo');
               $filename = time()."-".$image->getClientOriginalName();
               $image->move(public_path() . '/pos/platinumpurchase_photo/', $filename);
            }else{
                $filename = 'default.png';
            }
            if($request->inlineCheckbox1){$inlineCheckbox1 = $request->inlineCheckbox1;}else{$inlineCheckbox1 = 'no';}
            if($request->inlineCheckbox2){$inlineCheckbox2 = $request->inlineCheckbox2;}else{$inlineCheckbox2 = 'no';}
            if($request->inlineCheckbox3){$inlineCheckbox3 = $request->inlineCheckbox3;}else{$inlineCheckbox3 = 'no';}
            if($request->inlineCheckbox4){$inlineCheckbox4 = $request->inlineCheckbox4;}else{$inlineCheckbox4 = 'no';}

            $purchase = PlatinumPurchase::create([
                'date' => $request->date,
                'quality' => $request->quality,
                'staff_id' => $request->staff_id,
                'purchase_price' => $request->purchase_price,
                'category_id' => $request->category_id,
                'code_number' => $request->code_number,
                'product_gram' => $request->product_gram,
                'platinum_price' => $request->ptm_price,
                'profit' => $request->profit.'/'.$request->currency1,
                'platinum_type' => $request->ptm_type,
                'platinum_name' => $request->ptm_name,
                'selling_price' => $request->selling_price,
                'remark' => $request->remark,
                'photo' => $filename,
                'capital' => $request->capital,
                'barcode_text' => $request->barcode_text,
                'type' => $inlineCheckbox1.'/'.
                      $inlineCheckbox2.'/'.
                      $inlineCheckbox3.'/'.
                      $inlineCheckbox4,
            ]);

            Session::flash('message', 'Purchase was successfully Created!');

            return redirect()->route('backside.shop_owner.pos.ptm_purchase_list');
        } catch (\Exception $e) {

            return redirect()->back();

        }

    }
    public function editPtmPurchase($id){
        $shopowner = Shopowner::where('id', $this->getshopid())->orderBy('created_at', 'desc')->get();
        $categories = Category::all();
        $date = Carbon::now();
        $purchase = PlatinumPurchase::find($id);
        $price = AssignPlatinumPrice::first();
        // dd($price->open_price);
        $gradeA = $price->gradeA;
        $gradeB = $price->gradeB;

        return view('backend.pos.edit_platinum_purchase',['shopowner'=>$shopowner,'categories'=>$categories,'gradeA'=>$gradeA,'gradeB'=>$gradeB,'purchase'=>$purchase]);
    }
    public function deletePtmPurchase(Request $request){
        $purchase = PlatinumPurchase::find($request->pid);
        $purchase->delete();
        Session::flash('message', 'Purchase was successfully Deleted!');
        return response()->json([
            'data'=> 'success'
        ],200);
    }
    public function updatePtmPurchase(Request $request,$id){
        try{
         $purchase = PlatinumPurchase::find($id);
         if($request->hasfile('photo')){
             $image = $request->file('photo');
             $filename = time()."-".$image->getClientOriginalName();
             $image->move(public_path() . '/pos/platinumpurchase_photo/', $filename);

             // dd($filename);
          }else{
              $filename = $purchase->photo;
             //  dd($filename);
          }

         if($request->inlineCheckbox1){$inlineCheckbox1 = $request->inlineCheckbox1;}else{$inlineCheckbox1 = 'no';}
         if($request->inlineCheckbox2){$inlineCheckbox2 = $request->inlineCheckbox2;}else{$inlineCheckbox2 = 'no';}
         if($request->inlineCheckbox3){$inlineCheckbox3 = $request->inlineCheckbox3;}else{$inlineCheckbox3 = 'no';}
         if($request->inlineCheckbox4){$inlineCheckbox4 = $request->inlineCheckbox4;}else{$inlineCheckbox4 = 'no';}

         $purchase->date = $request->date;
         $purchase->quality = $request->quality;
         $purchase->staff_id = $request->staff_id;
         $purchase->purchase_price = $request->purchase_price;
         $purchase->category_id = $request->category_id;
         $purchase->code_number = $request->code_number;
         $purchase->product_gram = $request->product_gram;
         $purchase->platinum_price = $request->ptm_price;
         $purchase->profit = $request->profit.'/'.$request->currency1;
         $purchase->platinum_type = $request->ptm_type;
         $purchase->platinum_name = $request->ptm_name;
         $purchase->selling_price = $request->selling_price;
         $purchase->remark = $request->remark;
         $purchase->photo = $filename;
         $purchase->capital = $request->capital;
         $purchase->barcode_text = $request->barcode_text;
         $purchase->type = $inlineCheckbox1.'/'.
                       $inlineCheckbox2.'/'.
                       $inlineCheckbox3.'/'.
                       $inlineCheckbox4;
         $purchase->save();
         Session::flash('message', 'Purchase was successfully Updated!');
         return redirect()->route('backside.shop_owner.pos.ptm_purchase_list');
        } catch (\Exception $e) {
         return redirect()->back();
        }
     }
     public function ptmtypeFilter(Request $request){
        // dd($request->all());
        if($request->type == 1){
            $type = explode('/',$request->text);
        $types = [];
        foreach($type as $t){
            $sup = PlatinumPurchase::where('type', 'like', '%' . $t . '%')->get();
            array_push($types,$sup);
        }
        foreach($types as $tp){
            $data = collect($tp)->unique('id')->all();
        }
        }
        if($request->type == 2){
            $data = PlatinumPurchase::whereBetween('date', [$request->start_date, $request->end_date])->get();
        }

        return response()->json([
            'data' => $data,
        ]);
    }

    //Diamond
    public function getDiamondList(){
        $shopowner = Shopowner::where('id', $this->getshopid())->orderBy('created_at', 'desc')->get();
        $diamonds = Diamond::all();
        return view('backend.pos.diamond_list',['shopowner'=>$shopowner,'diamonds'=>$diamonds]);
    }

    public function storeDiamond(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'code_number' => 'required|unique:diamonds,code_number',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $diamond = Diamond::create([
            'code_number' => $request->code_number,
            'diamond_name' => $request->diamond_name,
            'remark' => $request->remark,
        ]);

        Session::flash('message', 'Diamond was successfully Created!');

        return redirect()->back();

    }

    public function updateDiamond(Request $request,$id){
        try{
            $diamond = Diamond::find($id);
            $diamond->code_number = $request->code_number;
            $diamond->diamond_name = $request->diamond_name;
            $diamond->remark = $request->remark;
            $diamond->save();
            Session::flash('message', 'Diamond was successfully Edited!');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back();
        }
        }

        public function deleteDiamond(Request $request){
            $diamond = Diamond::find($request->sid);
            $diamond->delete();
            Session::flash('message', 'Diamond was successfully Deleted!');
            return response()->json([
                'data'=> 'success'
            ],200);
        }

    //Staff
     public function getStaffList(){
        $shopowner = Shopowner::where('id', $this->getshopid())->orderBy('created_at', 'desc')->get();
        $staffs = Staff::all();
        return view('backend.pos.diamond_list',['shopowner'=>$shopowner,'staffs'=>$staffs]);
    }

    public function storeStaff(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'code_number' => 'required|unique:diamonds,code_number',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $staff = Staff::create([
            'code_number' => $request->code_number,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'counter_shop' => $request->counter_shop,
        ]);

        Session::flash('message', 'Staff was successfully Created!');

        return redirect()->back();

    }

    public function updateStaff(Request $request,$id){
        try{
            $staff = Staff::find($id);
            $staff->code_number = $request->code_number;
            $staff->name = $request->name;
            $staff->phone = $request->phone;
            $staff->address = $request->address;
            $staff->counter_shop = $request->counter_shop;
            $staff->save();
            Session::flash('message', 'Staff was successfully Edited!');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back();
        }
        }

        public function deleteStaff(Request $request){
            $staff = Staff::find($request->sid);
            $staff->delete();
            Session::flash('message', 'Staff was successfully Deleted!');
            return response()->json([
                'data'=> 'success'
            ],200);
        }

    //Supplier

    public function getSupplierList(){
        $shopowner = Shopowner::where('id', $this->getshopid())->orderBy('created_at', 'desc')->get();
        $suppliers = Supplier::all();

        return view('backend.pos.supplier_list',['shopowner'=>$shopowner,'suppliers'=>$suppliers]);
    }

    public function getCreateSupplier(){
        $shopowner = Shopowner::where('id', $this->getshopid())->orderBy('created_at', 'desc')->get();
        $state = State::all();
        $township = Township::all();
        return view('backend.pos.create_supplier',['shopowner'=>$shopowner,'state'=>$state,'township'=>$township]);
    }

    public function changeState(Request $request){
        $township = Township::where('state_id',$request->sid)->get();
        return response()->json($township);
    }

    public function typeFilter(Request $request){
        if($request->type == 1){
            $type = explode('/',$request->text);
        $types = [];
        foreach($type as $t){
            $sup = Supplier::where('type', 'like', '%' . $t . '%')->get();
            array_push($types,$sup);
        }
        foreach($types as $tp){
            $data = collect($tp)->unique('id')->all();
        }
        }
        if($request->type == 2){
            $data = Supplier::whereBetween('date', [$request->start_date, $request->end_date])->get();
        }

        return response()->json($data);
    }

    public function storeSupplier(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'code_number' => 'required|unique:suppliers,code_number',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if($request->inlineCheckbox1){$inlineCheckbox1 = $request->inlineCheckbox1;}else{$inlineCheckbox1 = 'no';}
        if($request->inlineCheckbox2){$inlineCheckbox2 = $request->inlineCheckbox2;}else{$inlineCheckbox2 = 'no';}
        if($request->inlineCheckbox3){$inlineCheckbox3 = $request->inlineCheckbox3;}else{$inlineCheckbox3 = 'no';}
        if($request->inlineCheckbox4){$inlineCheckbox4 = $request->inlineCheckbox4;}else{$inlineCheckbox4 = 'no';}
        $supplier = Supplier::create([
            'code_number' => $request->code_number,
            'date' => $request->date,
            'name' => $request->name,
            'shop_name' => $request->shop_name,
            'shop_type' => $request->shop_type,
            'phone' => $request->phone,
            'other_phone' => $request->other_phone,
            'state_id' => $request->state,
            'township_id' => $request->township,
            'address' => $request->address,
            'remark' => $request->remark,
            'type' => $inlineCheckbox1.'/'.
                      $inlineCheckbox2.'/'.
                      $inlineCheckbox3.'/'.
                      $inlineCheckbox4,
        ]);

        Session::flash('message', 'Supplier was successfully Created!');

        return redirect()->route('backside.shop_owner.pos.supplier_list');

    }

    public function editSupplier($id){
        $shopowner = Shopowner::where('id', $this->getshopid())->orderBy('created_at', 'desc')->get();
        $supplier = Supplier::find($id);
        $state = State::all();
        $township = Township::all();
        return view('backend.pos.edit_supplier',['shopowner'=>$shopowner,'supplier'=>$supplier,'state'=>$state,'township'=>$township]);
    }

    public function updateSupplier(Request $request,$id){
        // dd($request->all());
    try{
        if($request->inlineCheckbox1){$inlineCheckbox1 = $request->inlineCheckbox1;}else{$inlineCheckbox1 = 'no';}
        if($request->inlineCheckbox2){$inlineCheckbox2 = $request->inlineCheckbox2;}else{$inlineCheckbox2 = 'no';}
        if($request->inlineCheckbox3){$inlineCheckbox3 = $request->inlineCheckbox3;}else{$inlineCheckbox3 = 'no';}
        if($request->inlineCheckbox4){$inlineCheckbox4 = $request->inlineCheckbox4;}else{$inlineCheckbox4 = 'no';}
        $supplier = Supplier::find($id);
        $supplier->code_number = $request->code_number;
        $supplier->name = $request->name;
        $supplier->shop_name = $request->shop_name;
        $supplier->date = $request->date;
        $supplier->shop_type = $request->shop_type;
        $supplier->other_phone = $request->other_phone;
        $supplier->state_id = $request->state;
        $supplier->township_id = $request->township;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->remark = $request->remark;
        $supplier->type = $inlineCheckbox1.'/'.
                      $inlineCheckbox2.'/'.
                      $inlineCheckbox3.'/'.
                      $inlineCheckbox4;
        $supplier->save();
        Session::flash('message', 'Supplier was successfully Edited!');
        return redirect()->route('backside.shop_owner.pos.supplier_list');
    } catch (\Exception $e) {
        return redirect()->back();
    }
    }

    public function deleteSupplier(Request $request){
        $supplier = Supplier::find($request->sid);
        $purchase = Purchase::where('supplier_id',$supplier->id)->delete();
        $kpurchase = KyoutPurchase::where('supplier_id',$supplier->id)->delete();
        $supplier->delete();
        Session::flash('message', 'Supplier was successfully Deleted!');
        return response()->json([
            'data'=> 'success'
        ],200);
    }

    //Assign Gold
    public function getAssignGold(){
        $shopowner = Shopowner::where('id', $this->getshopid())->orderBy('created_at', 'desc')->get();
        $assign_gold_price = AssignGoldPrice::first();
        return view('backend.pos.assign_gold_price',['shopowner'=>$shopowner,'assign_gold_price'=>$assign_gold_price]);
    }

    public function getAssignGoldPrice(Request $request){
        // dd($request->open_price.'/'.$request->out_open_price);
        $assign = AssignGoldPrice::create([
            'date' => $request->date,
            'open_price' => $request->open_price.'/'.$request->out_open_price,
            'shop_price' => $request->shop_price.'/'.$request->out_shop_price,
            'price_16' => $request->price_16,
            'outprice_15' => $request->outprice_15.'/'.$request->out_outprice_15,
            'inprice_15' => $request->inprice_15.'/'.$request->out_inprice_15,
            'outprice_14' => $request->outprice_14.'/'.$request->out_outprice_14,
            'inprice_14' => $request->inprice_14.'/'.$request->out_inprice_14,
            'outprice_14_2' => $request->outprice_14_2.'/'.$request->out_outprice_14_2,
            'inprice_14_2' => $request->inprice_14_2.'/'.$request->out_inprice_14_2,
            'outprice_13' => $request->outprice_13.'/'.$request->out_outprice_13,
            'inprice_13' => $request->inprice_13.'/'.$request->out_inprice_13,
            'outprice_12' => $request->outprice_12.'/'.$request->out_outprice_12,
            'inprice_12' => $request->inprice_12.'/'.$request->out_inprice_12,
            'outprice_12_2' => $request->outprice_12_2.'/'.$request->out_outprice_12_2,
            'inprice_12_2' => $request->inprice_12_2.'/'.$request->out_inprice_12_2,
        ]);
        Session::flash('message','Gold Price was successfully Assigned for today!');
        return redirect()->back();
    }

    public function updateAssignGoldPrice(Request $request,$id){
        // dd($request->all());
        try{
            $assign = AssignGoldPrice::find($id);
            $assign->date = $request->date;
            $assign->open_price = $request->open_price.'/'.$request->out_open_price;
            $assign->shop_price = $request->shop_price.'/'.$request->out_shop_price;
            $assign->price_16 = $request->price_16;
            $assign->outprice_15 = $request->outprice_15.'/'.$request->out_outprice_15;
            $assign->inprice_15 = $request->inprice_15.'/'.$request->out_inprice_15;
            $assign->outprice_14 = $request->outprice_14.'/'.$request->out_outprice_14;
            $assign->inprice_14 = $request->inprice_14.'/'.$request->out_inprice_14;
            $assign->outprice_14_2 = $request->outprice_14_2.'/'.$request->out_outprice_14_2;
            $assign->inprice_14_2 = $request->inprice_14_2.'/'.$request->out_inprice_14_2;
            $assign->outprice_13 = $request->outprice_13.'/'.$request->out_outprice_13;
            $assign->inprice_13 = $request->inprice_13.'/'.$request->out_inprice_13;
            $assign->outprice_12 = $request->outprice_12.'/'.$request->out_outprice_12;
            $assign->inprice_12 = $request->inprice_12.'/'.$request->out_inprice_12;
            $assign->outprice_12_2 = $request->outprice_12_2.'/'.$request->out_outprice_12_2;
            $assign->inprice_12_2 = $request->inprice_12_2.'/'.$request->out_inprice_12_2;
            $assign->save();
        Session::flash('message','Gold Price was successfully Assigned for today!');
        return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back();
        }

    }

    //Assign Platinum
    public function getAssignPlatinum(){
        $shopowner = Shopowner::where('id', $this->getshopid())->orderBy('created_at', 'desc')->get();
        $assign_gold_price = AssignPlatinumPrice::first();
        return view('backend.pos.assign_platinum_history',['shopowner'=>$shopowner,'assign_gold_price'=>$assign_gold_price]);
    }
    public function getAssignPlatinumPrice(){
        $shopowner = Shopowner::where('id', $this->getshopid())->orderBy('created_at', 'desc')->get();
        $assign_gold_price = AssignPlatinumPrice::first();
        return view('backend.pos.assign_platinum_price',['shopowner'=>$shopowner,'assign_gold_price'=>$assign_gold_price]);
    }
    public function storeAssignPlatinumPrice(Request $request){
        $assign = AssignPlatinumPrice::create([
            'date' => $request->date,
            'gradeA' => $request->gradeA,
            'gradeB' => $request->gradeB,
            'gradeC' => $request->gradeC,
            'gradeD' => $request->gradeD,
        ]);
        Session::flash('message','Platinum Price was successfully Assigned for today!');
        return redirect()->back();
    }
    public function updateAssignPlatinumPrice(Request $request,$id){
        // dd($request->all());
        try{
            $assign = AssignPlatinumPrice::find($id);
            $assign->date = $request->date;
            $assign->gradeA = $request->gradeA;
            $assign->gradeB = $request->gradeB;
            $assign->gradeC = $request->gradeC;
            $assign->gradeD = $request->gradeD;
            $assign->save();
        Session::flash('message','Platinum Price was successfully Assigned for today!');
        return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back();
        }

    }

}
