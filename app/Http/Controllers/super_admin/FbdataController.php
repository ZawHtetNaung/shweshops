<?php

namespace App\Http\Controllers\super_admin;

use App\Event;
use App\facebooktable;
use App\Shopowner;
use App\Facade\Repair;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FbdataController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:super_admin', 'admin']);
    }

    public function list()
    {
        return view('backend.super_admin.fbdata.list');
    }
    public function getall(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        $searchByFromdate = $request->get('searchByFromdate');
        $searchByTodate = $request->get('searchByTodate');

        if ($searchByFromdate == null) {
            $searchByFromdate = '0-0-0 00:00:00';
        }
        if ($searchByTodate == null) {
            $searchByTodate = Carbon::now();
        }



        $totalRecords = facebooktable::leftjoin('shop_owners','facebook.shop_owner_id','=','shop_owners.id')->select('count(facebook.*) as allcount')

            ->orWhere(function ($query) use ($searchValue) {
                $query->where('shop_owners.name', 'like', '%' . $searchValue . '%')
                    ->orWhere('shop_owners.shop_name_myan', 'like', '%' . $searchValue . '%')
                    ->orWhere('shop_owners.email', 'like', '%' . $searchValue . '%')
                    ->orWhere('shop_owners.address', 'like', '%' . $searchValue . '%')
                    ->orWhere('shop_owners.main_phone', 'like', '%' . $searchValue . '%')
                    ->orWhere('facebook.pagename', 'like', '%' . $searchValue . '%')->orWhere('facebook.shop_id', 'like', '%' . $searchValue . '%');
                ;
            })
            ->whereBetween('facebook.created_at', [$searchByFromdate, $searchByTodate])->count();
        $totalRecordswithFilter = $totalRecords;
        if($columnName == 'shop_name'){
            $columnName='shop_owners.name';
        }
        if($columnName == 'created_at'){
            $columnName='facebook.created_at';
        }
        if($columnName == 'page_name'){
            $columnName='facebook.pagename';
        }
        $records = facebooktable::leftjoin('shop_owners','facebook.shop_owner_id','=','shop_owners.id')->orderBy($columnName, $columnSortOrder)
            ->orderBy('facebook.created_at', 'desc')

            ->orWhere(function ($query) use ($searchValue) {
                $query->where('shop_owners.name', 'like', '%' . $searchValue . '%')
                    ->orWhere('shop_owners.shop_name_myan', 'like', '%' . $searchValue . '%')
                    ->orWhere('shop_owners.email', 'like', '%' . $searchValue . '%')
                    ->orWhere('shop_owners.address', 'like', '%' . $searchValue . '%')
                    ->orWhere('shop_owners.main_phone', 'like', '%' . $searchValue . '%')
                    ->orWhere('facebook.pagename', 'like', '%' . $searchValue . '%')
                    ->orWhere('facebook.shop_id', 'like', '%' . $searchValue . '%');
            })
            ->whereBetween('facebook.created_at', [$searchByFromdate, $searchByTodate])
            ->select('*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {

            $data_arr[] = array(
                "id" => $record->id,
                "shop_name" => $record->shop_name,
                "page_name" => $record->pagename,
                "created_at" => date('F d, Y ( h:i A )',strtotime($record->created_at)),

            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );
        echo json_encode($response);
    }

    public function getcount(Request $request){
        $allcount=facebooktable::all();
        $allcountbydate=facebooktable::whereBetween('created_at',[$request->from,$request->to])->get();
        return response()->json(['all'=>count($allcount),'alld'=>count($allcountbydate)]);
    }

}
