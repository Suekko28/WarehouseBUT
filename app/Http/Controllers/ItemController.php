<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];

        foreach (warehouse() as $key => $value) {
            $data[$key] = [
                'query' => Item::where('warehouse',$key)->get(),
                'label' => $value['label'],
                'vendor_name' => get_vendor_name($value['vendor_name'])
            ];
        }
        return view('items.index',[
            'data' => $data
        ]);
    }

    public function ajax(Request $request)
    {
        if($request->ajax()) {
            if($request->type == "get-vendor") {
                $data = warehouse($request->warehouse) ? get_vendor_name(warehouse($request->warehouse)['vendor_name']) : null;
                return $data;
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('items.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'code' => 'required|unique:items,code',
            'type' => 'required',
            'warehouse' => 'required',
            'vendor_name' => 'required',
            'satuan' => 'required'
        ],[],[
            'name' => 'Nama',
            'code' => 'Kode',
            'type' => 'Jenis',
            'warehouse' => 'Gudang',
            'vendor_name' => warehouse($request->warehouse) ? get_vendor_name(warehouse($request->warehouse)['vendor_name']) : null,
            'satuan' => 'Satuan'
        ]);
        $data['user_id'] = auth()->user()->id;
        Item::create($data);
        return redirect()->route('items.index')->with('success','Berhasil Tambah data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return view('items.show',[
            'data' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        return view('items.form',[
            'edit' => true,
            'data' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $data = $request->validate([
            'name' => 'required',
            'code' => 'required|unique:items,code,'.$item->id,
            'type' => 'required',
            'warehouse' => 'required',
            'vendor_name' => 'required',
            'satuan' => 'required'
        ],[],[
            'name' => 'Nama',
            'code' => 'Kode',
            'type' => 'Jenis',
            'warehouse' => 'Gudang',
            'vendor_name' => warehouse($request->warehouse) ? get_vendor_name(warehouse($request->warehouse)['vendor_name']) : null,
            'satuan' => 'Satuan'
        ]);
        $item->update($data);
        return redirect()->route('items.index')->with('success','Berhasil Update data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();
    }
}
