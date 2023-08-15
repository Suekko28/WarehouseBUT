@extends('layouts.app')
@section('content')
 @component('components.card',[
    'title' => 'Data Gudang',
 ])
 <table class="table table-bordered table-striped" id="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Barang</th>
            <th>Jenis</th>
            <th>Jumlah</th>
            <th>Satuan</th>
        </tr>
    </thead>
    <tbody>
    @forelse ($data as $item)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item['name']}}</td>
            <td>{{$item['type']}}</td>
            <td>{{$item['qty']}}</td>
            <td>{{$item['satuan']}}</td>
        </tr>
    @empty
    @endforelse

    </tbody>
 </table>
 @endcomponent
@endsection
