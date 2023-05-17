<?php

namespace App\Imports;

use App\Item;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Http\Controllers\traid\UserRole;

class ItemsImport implements ToCollection
{
    use UserRole;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $tocheck=Item::where('id',$row[0]);
            if($tocheck->count() > 0){
                if($tocheck->first()->shop_id == $this->getshopid()){
                    if(Str::contains($row[2],'-')){
                        $org=$row[2];
                        $strposi=strpos($org,'-');
                        $min=substr($org,0,$strposi);
                        $max=substr($org,$strposi+1,100);
                        Item::where('id',$row[0])->update(['min_price'=>$min,'max_price'=>$max]);

                    }else{
                        Item::where('id',$row[0])->update(['price'=>$row[2]]);

                    }
                }


            }
        }
    }
}
