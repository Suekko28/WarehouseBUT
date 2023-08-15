@extends('layouts.app')
@section('content')
@php
$url_action = isset($edit) ? route('items.update',$data->id) : route('items.store')
@endphp
@component('components.card',[
    'title' => (isset($edit) ? 'Edit' : 'Tambah') . ' Data',
    'button' => [
         [
            'label' => 'Kembali',
            'class' => 'btn bg-primary text-light mb-2',
            'link' => route('items.index'),
            'icon' => '<i class="uil uil-corner-up-left-alt me-1 fs-16"></i>'
        ],
    ]
 ])
 <form action="{{ $url_action }}" method="POST">
    @csrf
    @if(isset($edit))
        @method('PUT')
    @endif
    <div class="mb-3">
        <label for="Gudang">Gudang</label>
        <select name="warehouse" id="warehouse" class="form-control select-2">
            <option value="">Pilih...</option>
            @forelse (warehouse() as $key => $item)
                <option value="{{$key}}" {{isset($edit) ? ($data->warehouse === $key ? 'selected' : '') : '' }}>{{$item['label']}}</option>
            @empty
            @endforelse
        </select>
        @include('includes.error',['data' => 'warehouse'])
    </div>
    <div class="mb-3">
        <label for="Nama">Nama</label>
        <input type="text" name="name" class="form-control" value="{{old('name',isset($edit) ? $data->name : '')}}" placeholder="Nama">
        @include('includes.error',['data' => 'name'])
    </div>
    <div class="mb-3">
        <label for="Kode">Kode</label>
        <input type="text" name="code" class="form-control" value="{{old('code',isset($edit) ? $data->code : '')}}" placeholder="Kode">
        @include('includes.error',['data' => 'code'])
    </div>
    <div class="mb-3">
        <label for="Jenis">Jenis</label>
        <input type="text" name="type" class="form-control" value="{{old('type',isset($edit) ? $data->type : '')}}" placeholder="Jenis">
        @include('includes.error',['data' => 'type'])
    </div>

    <div class="mb-3">
        <label for="Satuan">Satuan</label>
        <input type="text" name="satuan" class="form-control" value="{{ old('satuan',isset($edit) ? $data->satuan : '') }}" placeholder="Satuan">
        @include('includes.error',['data' => 'satuan'])
    </div>

    <div class="mb-3" @if(isset($edit)) @else style="display: none" @endif id="vendor-field">
        <label for="" id="vendor"></label>
        <input type="text" name="vendor_name" id="vendor-input" class="form-control" value="{{old('type',isset($edit) ? $data->vendor_name : '')}}" placeholder="Jenis">
        @include('includes.error',['data' => 'type'])
    </div>

    @include('includes.button')
 </form>
 @endcomponent

@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $(".select-2").select2()
            @if(isset($edit))
            get_vendor('{{$data->warehouse}}')
            @endif
        })

        function get_vendor(data) {
            $.ajax({
                url: "{{route('items.ajax',['type' => 'get-vendor'])}}",
                data: {
                    warehouse: data
                },
                success: function(res) {
                    console.log(res)
                    $("#vendor").attr('for',res)
                    $("#vendor-input").attr('placeholder',res)
                    $("#vendor").text(res)
                },
                error: function(err) {
                    console.log(err)
                    $("#vendor-field").fadeOut()
                }
            })
        }
        $("#warehouse").on('change',function() {
           if($(this).val() != '') {
                $("#vendor-field").fadeIn()
                get_vendor($(this).val())
           }
        })
    </script>
@endsection
