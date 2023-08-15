@extends('layouts.app')
@section('content')
@component('components.card',[
    'title' => 'Detail Data',
    'button' => [
         [
            'label' => 'Kembali',
            'class' => 'btn bg-primary text-light mb-2',
            'link' => route('item-mutations.type',$type),
            'icon' => '<i class="uil uil-corner-up-left-alt me-1 fs-16"></i>'
        ],
    ]
])
@php
$type = $data->qty_in > 0 ? 'in' : 'out';
@endphp
    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th>
            <td>{{$data->id}}</td>
        </tr>
        <tr>
            <th>Gudang</th>
            <td>{{$data->warehouse}}</td>
        </tr>
        <tr>
            <th>Nama Barang</th>
            <td>{{$data->item->name}}</td>
        </tr>
        @if($type == "in")
            @if(in_array($data->warehouse,['finished','wip']))
                <tr>
                    <th>Nama Pelanggan</th>
                    <td>{{$data->item->vendor_name}}</td>
                </tr>
                <tr>
                    <th>Tanggal Masuk</th>
                    <td>{{$data->date_input->translatedFormat('l, d F Y')}}</td>
                </tr>
                <tr>
                    <th>Tanggal Produksi</th>
                    <td>{{$data->date_production->translatedFormat('l, d F Y')}}</td>
                </tr>
            @endif

            @if(in_array($data->warehouse,['child','raw']))
                <tr>
                    <th>No PO</th>
                    <td>{{$data->po_number}}</td>
                </tr>
                <tr>
                    <th>No Surat Jalan</th>
                    <td>{{$data->letter_number}}</td>
                </tr>
                <tr>
                    <th>Nama Supplier</th>
                    <td>{{$data->item->vendor_name}}</td>
                </tr>
                <tr>
                    <th>Tanggal Masuk</th>
                    <td>{{$data->date_input->translatedFormat('l, d F Y')}}</td>
                </tr>
            @endif
        @else
            @if($data->warehouse == "finished")
                <tr>
                    <th>Nama Pelanggan</th>
                    <td>{{$data->item->vendor_name}}</td>
                </tr>
                <tr>
                    <th>Tanggal Pengiriman</th>
                    <td>{{$data->date_delivery->translatedFormat('l, d F Y')}}</td>
                </tr>
                <tr>
                    <th>No Surat Jalan</th>
                    <td>{{$data->letter_number}}</td>
                </tr>
                <tr>
                    <th>No PO</th>
                    <td>{{$data->po_number}}</td>
                </tr>

            @endif

            @if(in_array($data->warehouse,['child','raw']))
                <tr>
                    <th>No PO</th>
                    <td>{{$data->po_number}}</td>
                </tr>
                <tr>
                    <th>No Surat Jalan</th>
                    <td>{{$data->letter_number}}</td>
                </tr>
                <tr>
                    <th>Nama Supplier</th>
                    <td>{{$data->item->vendor_name}}</td>
                </tr>
                <tr>
                    <th>Tanggal Masuk</th>
                    <td>{{$data->date_input->translatedFormat('l, d F Y')}}</td>
                </tr>
            @endif
            <tr>
                <th>Keterangan</th>
                <td>{{$data->description}}</td>
            </tr>
        @endif
        <tr>
            <th>Jumlah</th>
            <td>{{$data['qty_'.$type]}}</td>
        </tr>
        <tr>
            <th>Satuan</th>
            <td>{{ucwords($data->item->satuan)}}</td>
        </tr>
        <tr>
            <th>Dibuat</th>
            <td>{{$data->created_at->translatedFormat('l, d F Y H:i')}}</td>
        </tr>
        <tr>
            <th>Diperbaharui</th>
            <td>{{$data->updated_at->translatedFormat('l, d F Y H:i')}}</td>
        </tr>
    </table>
@endcomponent
@endsection
