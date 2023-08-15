@extends('layouts.app')
@section('content')
 @component('components.card',[
    'title' => 'List Data',
    'button' => [
        [
            'label' => 'Tambah Data',
            'class' => 'btn bg-primary text-light mb-2',
            'link' => route('users.create'),
            'icon' => '<i class="uil uil-plus-circle me-1 fs-16"></i>'
        ],
    ]
 ])
 <table class="table table-bordered table-striped" id="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @forelse ($data as $item)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->email}}</td>
            <td>{{ucwords($item->role)}}</td>
            <td>
                <a href="{{route('users.show',$item->id)}}" class="btn btn-sm btn-info"><i class="uil uil-eye"></i></a>
                <a href="{{route('users.edit',$item->id)}}" class="btn btn-sm btn-warning"><i class="uil uil-edit"></i></a>
                <a href="javascript:;" onclick="form_delete('{{route('users.destroy',$item->id)}}')" class="btn btn-sm btn-danger">
                    <i class="uil uil-trash"></i>
                </a>
            </td>
        </tr>
    @empty
    @endforelse

    </tbody>
 </table>
 @endcomponent
@endsection
