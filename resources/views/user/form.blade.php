@extends('layouts.app')
@section('content')
@php
$url_action = isset($edit) ? route('users.update',$data->id) : route('users.store')
@endphp
@component('components.card',[
    'title' => (isset($edit) ? 'Edit' : 'Tambah') . ' Data',
    'button' => [
         [
            'label' => 'Kembali',
            'class' => 'btn bg-primary text-light mb-2',
            'link' => route('users.index'),
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
        <label for="Nama">Nama</label>
        <input type="text" name="name" class="form-control" value="{{old('name',isset($edit) ? $data->name : '')}}" placeholder="Nama">
        @include('includes.error',['data' => 'name'])
    </div>
    <div class="mb-3">
        <label for="Email">Email</label>
        <input type="email" name="email" class="form-control" value="{{old('email',isset($edit) ? $data->email : '')}}" placeholder="Email">
        @include('includes.error',['data' => 'email'])
    </div>
    @if(isset($edit))
    <div class="form-check mb-1">
        <input type="checkbox" class="form-check-input" id="customCheck1">
        <label class="form-check-label" for="customCheck1">Ganti Password</label>
    </div>
    @endif
    <div class="mb-3" @if(isset($edit)) id="form-password" style="display: none" @endif>
       <div class="row">
            <div class="col-12 col-md-6">
                <label for="Password">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
                @include('includes.error',['data' => 'password'])
            </div>
            <div class="col-12 col-md-6">
                <label for="Konfirmasi Password">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password">
                @include('includes.error',['data' => 'password_confirmation'])
            </div>
       </div>
    </div>
    <div class="mb-3">
        <label for="Role">Role</label>
        <select name="role" class="form-control">
            <option value="">Pilih..</option>
            @forelse ($role as $item)
                <option value="{{$item}}" {{ isset($edit) ? ($item === $data->role ? 'selected' : '') : ''}}>{{ucwords($item)}}</option>
            @empty
            @endforelse
        </select>
        @include('includes.error',['data' => 'role'])
    </div>
    @include('includes.button')
 </form>
 @endcomponent

@endsection
@section('js')
    <script>
        $("#customCheck1").on('change',function() {
            if($(this).is(':checked')) {
                $("#form-password").fadeIn()
            } else {
                $("#form-password").fadeOut()
            }
        })
    </script>
@endsection
