@extends('layouts.app')
@section('content')
@component('components.card',[
    'title' => 'Detail Data',
    'button' => [
         [
            'label' => 'Kembali',
            'class' => 'btn bg-primary text-light mb-2',
            'link' => route('items.index'),
            'icon' => '<i class="uil uil-corner-up-left-alt me-1 fs-16"></i>'
        ],
    ]
])
    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th>
            <td>{{$data->id}}</td>
        </tr>
        <tr>
            <th>Nama</th>
            <td>{{$data->name}}</td>
        </tr>
        <tr>
            <th>Kode</th>
            <td>{{$data->code}}</td>
        </tr>
        <tr>
            <th>Jenis</th>
            <td>{{$data->type}}</td>
        </tr>
        <tr>
            <th>Gudang</th>
            <td>{{warehouse($data->warehouse)['label'] ?? ''}}</td>
        </tr>
        <tr>
            <th>Diinput oleh</th>
            <td>{{$data->user->name}}</td>
        </tr>
        <tr>
            <th>Data Dibuat</th>
            <td>{{$data->created_at->translatedFormat('l, d F Y H:i')}}</td>
        </tr>
        <tr>
            <th>Data Dibuat</th>
            <td>{{$data->updated_at->translatedFormat('l, d F Y H:i')}}</td>
        </tr>
    </table>
@endcomponent
@endsection
