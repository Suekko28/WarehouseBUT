<?php

namespace App\Http\Controllers;

use App\Exports\ItemMutationExportExcel;
use App\Models\ItemMutation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
class ReportController extends Controller
{
    public function index($type = null, Request $request) {
        if($request->ajax()) {
            $data = ItemMutation::query()->with('item');

            $qty_str = $type == 'in' ? 'qty_in' : 'qty_out';

            $data = $data->where($qty_str,'>',0)->orderBy('id','DESC');

            if(!empty($request->warehouse))
            $data = $data->whereHas('item',function($q) use($request) {
                $q->where('warehouse',$request->warehouse);
            });

            if(!empty($request->start_date) && !empty($request->end_date))
             $data = $data
             ->whereRaw('DATE(date_input) BETWEEN ? AND ?',[$request->start_date,$request->end_date]);


            return DataTables::of($data)
            ->addColumn('qty',function($data) use ($qty_str) {
                return $data[$qty_str];
            })
            ->editColumn('item.warehouse',function($data) {
                return warehouse($data->item->warehouse)['label'];
            })
            ->editColumn('date_input',function($data) {
                return Carbon::parse($data->date_input)->translatedFormat('l, d F Y');
            })
            ->addIndexColumn()
            ->make(true);
        }
        return view('report.index',[
            'type' => $type,
            'warehouse' => warehouse()
        ]);
    }

    public function export(Request $request) {
        if($request->action == "excel") {
            return Excel::download((new ItemMutationExportExcel())->whereData($request->all()), 'laporan-excel.xlsx');
        } else if($request->action == "pdf") {
            $data = $data = ItemMutation::query()->with('item');
            $qty_str = $request->type == 'in' ? 'qty_in' : 'qty_out';

            $data = $data->where($qty_str,'>',0)->orderBy('id','DESC');

            // warehouse
            if(!empty($request->warehouse)) {
                $warehouse = request('warehouse');
                $data = $data->whereHas('item',function($q) use($warehouse) {
                    $q->where('warehouse',$warehouse);
                });
            }

            if(!empty($request->start_date) && !empty($request->end_date))
             $data = $data
             ->whereRaw('DATE(date_input) BETWEEN ? AND ?',[$request->start_date,$request->end_date]);

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
            return view('report.format_print_table',['data' => $data]);
        }
    }
}
