<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemMutation;
use Illuminate\Http\Request;

class ItemMutationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($type = null)
    {
        $data = [];
        $qty_str = $type == 'in' ? 'qty_in' : 'qty_out';
        foreach (warehouse() as $key => $value) {
            $data[$key] = [
                'query' => ItemMutation::whereHas('item',function($q) use($key) {
                    $q->where('warehouse',$key);
                })
                ->where($qty_str,'>',0)
                ->get(),
                'warehouse' => $key,
                'label' => $value['label'],
                'type' => $type,
                'vendor_name' => get_vendor_name($value['vendor_name'])
            ];
        }
        return view('mutation.index',[
            'data' => $data,
            'type' => $type
        ]);
    }

    public function form(Request $request) {


        $item_mutation = ItemMutation::find($request->data);
        $data = [
            'items' => Item::where('warehouse',$request->warehouse)->get(),
            'data' => $item_mutation,
        ];

        $qty = 0;
        if(isset($request->edit)) {
            if($request->type == "in") {
                $qty = $item_mutation->qty_in;
            } else {
                $qty = $item_mutation->qty_out;
            }
            $data['qty'] = $qty;
            $data['edit'] = true;
        }


        if($request->type == "in") {
            $data['qty_str'] = 'qty_in';
            if(in_array($request->warehouse,['finished','wip']))
            return view('mutation.components.in.form_finished_wip',$data);
            else if(in_array($request->warehouse,['raw','child']))
            return view('mutation.components.in.form_raw_child',$data);
        } else  if($request->type == "out") {
            $data['qty_str'] = 'qty_out';
            if($request->warehouse == "finished")
                return view('mutation.components.out.form_finished',$data);
            else if($request->warehouse == "wip")
                return view('mutation.components.out.form_wip',$data);
            else if(in_array($request->warehouse,['raw','child']))
                return view('mutation.components.out.form_raw_child',$data);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($type = null)
    {
        return view('mutation.form',[
            'items' => Item::all(),
            'type' => $type
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $type = $request->type == 'in' ? 'qty_in' : 'qty_out';
        $data = [];
        if($request->type == 'in') {
            if(in_array($request->warehouse,['finished','wip'])) {
                $data = $request->validate([
                    'warehouse' => 'required',
                    'item_id' => 'required|exists:items,id',
                    $type => 'required',
                    'date_input' => 'required|date',
                    'date_production' => 'required|date',
                ],[],[
                    'item_id' => 'Barang',
                    $type => 'Jumlah',
                    'date_input' => 'Tanggal',
                    'date_production' => 'Tanggal Produksi',
                ]);
            } else if(in_array($request->warehouse,['raw','child'])) {
                $data = $request->validate([
                    'warehouse' => 'required',
                    'item_id' => 'required|exists:items,id',
                    'letter_number'=> 'required',
                    'po_number' => 'required',
                    $type => 'required',
                    'date_input' => 'required|date',
                ],[],[
                    'item_id' => 'Barang',
                    'letter_number' => 'Surat Jalan',
                    'po_number' => 'Nomor PO',
                    $type => 'Jumlah',
                    'date_input' => 'Tanggal Masuk',
                ]);
            }

        } else {
            if($request->warehouse == "finished") {
                $data = $request->validate([
                    'warehouse' => 'required',
                    'item_id' => 'required|exists:items,id',
                    'letter_number'=> 'required',
                    'po_number' => 'required',
                    $type => 'required',
                    'date_delivery' => 'required|date',
                    'description' => 'required'
                ],[],[
                    'item_id' => 'Barang',
                    'letter_number' => 'Surat Jalan',
                    'po_number' => 'Nomor PO',
                    $type => 'Jumlah',
                    'date_delivery' => 'Tanggal Pengiriman',
                    'description' => 'Keterangan'
                ]);
            } else if($request->warehouse == "wip") {
                $data = $request->validate([
                    'warehouse' => 'required',
                    'item_id' => 'required|exists:items,id',
                    'machine' => 'required',
                    $type => 'required',
                    'date_production' => 'required|date',
                    'ok' => 'nullable',
                    'reject' => 'nullable',
                    'description' => 'required'
                ],[],[
                    'item_id' => 'Barang',
                    'machine' => 'Mesin',
                    $type => 'Jumlah',
                    'date_production' => 'Tanggal Produksi',
                    'ok' => 'OK',
                    'reject' => 'Reject',
                    'description' => 'Keterangan'
                ]);
            } else if(in_array($request->warehouse,['child','raw'])) {
                $data = $request->validate([
                    'warehouse' => 'required',
                    'item_id' => 'required|exists:items,id',
                    $type => 'required',
                    'date_input' => 'required|date',
                    'pic' => 'required',
                    'description' => 'required'
                ],[],[
                    'item_id' => 'Barang',
                    $type => 'Jumlah',
                    'date_input' => 'Tanggal Keluar',
                    'pic' => 'PIC',
                    'description' => 'Keterangan'
                ]);
            }
        }
        if(empty($data['date_input'])) {
            if(!empty($data['date_production']))
                $data['date_input'] = $data['date_production'];
            else if(!empty($data['date_delivery']))
                $data['date_input'] = $data['date_delivery'];
        }
        ItemMutation::create($data);
        return redirect()->route('item-mutations.type',$request->type)->with('success','Berhasil Tambah data');
    }

    /**
     * Display the specified resource.
     */
    public function show($type = null,ItemMutation $itemMutation)
    {
        return view('mutation.show',[
            'type' => $type,
            'data' => $itemMutation
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($type = null ,ItemMutation $itemMutation)
    {
        return view('mutation.form',[
            'edit' => true,
            'type' => $type,
            'items' => Item::all(),
            'data' => $itemMutation
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ItemMutation $itemMutation)
    {
        $type = $request->type == 'in' ? 'qty_in' : 'qty_out';
        $data = [];
        if($request->type == 'in') {
            if(in_array($request->warehouse,['finished','wip'])) {
                $data = $request->validate([
                    'warehouse' => 'required',
                    'item_id' => 'required|exists:items,id',
                    $type => 'required',
                    'date_input' => 'required|date',
                    'date_production' => 'required|date',
                ],[],[
                    'item_id' => 'Barang',
                    $type => 'Jumlah',
                    'date_input' => 'Tanggal',
                    'date_production' => 'Tanggal Produksi',
                ]);
            } else if(in_array($request->warehouse,['raw','child'])) {
                $data = $request->validate([
                    'warehouse' => 'required',
                    'item_id' => 'required|exists:items,id',
                    'letter_number'=> 'required',
                    'po_number' => 'required',
                    $type => 'required',
                    'date_input' => 'required|date',
                ],[],[
                    'item_id' => 'Barang',
                    'letter_number' => 'Surat Jalan',
                    'po_number' => 'Nomor PO',
                    $type => 'Jumlah',
                    'date_input' => 'Tanggal Masuk',
                ]);
            }

        } else {
            if($request->warehouse == "finished") {
                $data = $request->validate([
                    'warehouse' => 'required',
                    'item_id' => 'required|exists:items,id',
                    'letter_number'=> 'required',
                    'po_number' => 'required',
                    $type => 'required',
                    'date_delivery' => 'required|date',
                    'description' => 'required'
                ],[],[
                    'item_id' => 'Barang',
                    'letter_number' => 'Surat Jalan',
                    'po_number' => 'Nomor PO',
                    $type => 'Jumlah',
                    'date_delivery' => 'Tanggal Pengiriman',
                    'description' => 'Keterangan'
                ]);
            } else if($request->warehouse == "wip") {
                $data = $request->validate([
                    'warehouse' => 'required',
                    'item_id' => 'required|exists:items,id',
                    'machine' => 'required',
                    $type => 'required',
                    'date_production' => 'required|date',
                    'ok' => 'nullable',
                    'reject' => 'nullable',
                    'description' => 'required'
                ],[],[
                    'item_id' => 'Barang',
                    'machine' => 'Mesin',
                    $type => 'Jumlah',
                    'date_production' => 'Tanggal Produksi',
                    'ok' => 'OK',
                    'reject' => 'Reject',
                    'description' => 'Keterangan'
                ]);
            } else if(in_array($request->warehouse,['child','raw'])) {
                $data = $request->validate([
                    'warehouse' => 'required',
                    'item_id' => 'required|exists:items,id',
                    $type => 'required',
                    'date_input' => 'required|date',
                    'pic' => 'required',
                    'description' => 'required'
                ],[],[
                    'item_id' => 'Barang',
                    $type => 'Jumlah',
                    'date_input' => 'Tanggal Keluar',
                    'pic' => 'PIC',
                    'description' => 'Keterangan'
                ]);
            }
        }
        if(empty($data['date_input'])) {
            if(!empty($data['date_production']))
                $data['date_input'] = $data['date_production'];
            else if(!empty($data['date_delivery']))
                $data['date_input'] = $data['date_delivery'];
        }
        $itemMutation->update($data);
        return redirect()->route('item-mutations.type',$request->type)->with('success','Berhasil Update data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemMutation $itemMutation)
    {
        $itemMutation->delete();
    }
}
