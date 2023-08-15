<?php

namespace App\Exports;

use App\Models\ItemMutation;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ItemMutationExportExcel implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $requestData = [];

    public function whereData($data)
    {
        $this->requestData = $data;
        return $this;
    }

    function getRequestData($key)
    {
        return isset($this->requestData[$key]) && !empty($this->requestData[$key]) ? $this->requestData[$key] : '';
    }

    public function view(): View
    {
        $data = $data = ItemMutation::query()->with('item');
        $qty_str = $this->getRequestData('type') == 'in' ? 'qty_in' : 'qty_out';

        $data = $data->where($qty_str,'>',0)->orderBy('id','DESC');

        // warehouse
        if(!empty($this->getRequestData('warehouse'))) {
            $warehouse = $this->getRequestData('warehouse');
            $data = $data->whereHas('item',function($q) use($warehouse) {
                $q->where('warehouse',$warehouse);
            });
        }

        if(!empty($this->getRequestData('start_date')) && !empty($this->getRequestData('end_date')))
         $data = $data
         ->whereRaw('DATE(date_input) BETWEEN ? AND ?',[$this->getRequestData('start_date'),$this->getRequestData('end_date')]);

        if($data->count() > 0) {
            $data = $data->get()->map(function($item) use ($qty_str) {
                $item->qty = $item[$qty_str];
                $item->warehouse = warehouse($item->item->warehouse)['label'];
                $item->date_input_custom = Carbon::parse($item->date_input)->translatedFormat('l, d F Y');
                return $item;
            });
        } else {
            $data = [];
        }

        // $data = $data->get();


        return view('report.format_table',compact('data'));
    }
}
