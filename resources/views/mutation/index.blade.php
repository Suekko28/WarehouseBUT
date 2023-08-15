@extends('layouts.app')
@section('content')
 <a href="{{ route('item-mutations.type.create',$type) }}" class="btn bg-primary text-light mb-2"><i class="uil uil-plus-circle me-1 fs-16"></i> Tambah Data</a>

 <h3>{{$type == "in" ? "Barang Masuk" : "Barang Keluar"}}</h3>
 <hr class="text-dark">
 @forelse ($data as $item)
 <div class="card">
    <div class="card-header bg-secondary text-light">
        <span class="header-title">{{$item['label']}}</span>
    </div>
    <div class="card-body">
        @include('mutation.components.table',[
            'warehouse' => $item['warehouse'],
            'data' => $item['query'],
            'label' => $item['label'],
            'vendor_name' => $item['vendor_name'],
            'type' => $type
        ])
    </div>
</div>
 @empty
 @endforelse
@endsection
