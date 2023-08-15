<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemMutation;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function warehouse($type = null)
    {
        $data = Item::where('warehouse',$type);

        if($data->count() > 0){
            $data = $data->get()->map(function($item){
                $sum_qty = 0;
                if($item->itemMutations()->exists()) {
                    $sum_qty = $item->itemMutations()->sum('qty_in') - $item->itemMutations()->sum('qty_out');
                }
                return [
                    'name' => $item->name,
                    'qty' => $sum_qty,
                    'warehouse' => $item->warehouse,
                    'satuan' => ucwords($item->satuan),
                    'type' => ucwords($item->type),
                    'created_at' => $item->created_at->format('d-m-Y H:i:s'),
                ];
            });
        }else{
            $data = [];
        }
        return view('information.warehouse',compact('data'));
    }
}
