@extends('layouts.app')
@section('content')
@php
$url_action = isset($edit) ? route('item-mutations.update',$data->id) : route('item-mutations.store');
$qty_str= $type == "in" ? "qty_in" : "qty_out";
$qty = 0;
if(isset($edit)) {
    if($type == "in") {
        $qty = $data->qty_in;
    } else {
        $qty = $data->qty_out;
    }
}
@endphp
@component('components.card',[
    'title' => (isset($edit) ? 'Edit' : 'Tambah') . ' Data ' . ($type == "in" ? "Barang Masuk" : "Barang Keluar"),
    'button' => [
         [
            'label' => 'Kembali',
            'class' => 'btn bg-primary text-light mb-2',
            'link' => route('item-mutations.type',$type),
            'icon' => '<i class="uil uil-corner-up-left-alt me-1 fs-16"></i>'
        ],
    ]
 ])
 <form action="{{ $url_action }}" method="POST">
    @csrf
    @if(isset($edit))
        @method('PUT')
    @endif
    <input type="hidden" name="type" value="{{$type}}">

    <div class="mb-3">
        <label for="Gudang">Gudang</label>
        <select name="warehouse" id="warehouse" class="form-control select-2">
            <option value="">Pilih..</option>
            @forelse (warehouse() as $key => $item)
                <option value="{{ $key }}" {{ isset($edit) ? ($data->warehouse == $key ? 'selected' : '') : ''}}>{{ $item['label'] }}</option>
            @empty
            @endforelse
        </select>
    </div>
    <div id="form-mutation"></div>

    @include('includes.button')
 </form>
 @endcomponent

@endsection
@section('js')
    <script>
       function loadForm() {
            @if(isset($edit))
                var warehouse = '{{ $data->warehouse }}';
            @else
            var warehouse = $(this).val();
            @endif
            $.ajax({
                url: '{{ route('item-mutations.form') }}',
                data: {
                    warehouse: warehouse,
                    type: '{{ $type }}',
                    @if(isset($edit))
                        edit: true,
                        data: '{{$data->id}}'
                    @endif
                },
                success: function(data) {
                    $("#form-mutation").html(data)
                },
                error: function(data) {
                    console.log(data)
                }
            })
       }
       $(document).ready(() => {
            loadForm()
       })
       $("#warehouse").on('change', loadForm)
    </script>
@endsection
