<table class="table table-bordered table-striped table-json">
    <thead>
        <tr>
            <th>#</th>
            <th>Gudang</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Jenis</th>
            <th>{{$vendor_name}}</th>
            <th>Satuan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @forelse ($data as $item)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item->warehouse}}</td>
            <td>{{$item->code}}</td>
            <td>{{$item->name}}</td>
            <td>{{ucwords($item->type)}}</td>
            <td>{{$item->vendor_name}}</td>
            <td>{{$item->satuan}}</td>
            <td>
                <a href="{{route('items.show',$item->id)}}" class="btn btn-sm btn-info"><i class="uil uil-eye"></i></a>
                <a href="{{route('items.edit',$item->id)}}" class="btn btn-sm btn-warning"><i class="uil uil-edit"></i></a>
                <a href="javascript:;" onclick="form_delete('{{route('items.destroy',$item->id)}}')" class="btn btn-sm btn-danger">
                    <i class="uil uil-trash"></i>
                </a>
            </td>
        </tr>
    @empty
    @endforelse

    </tbody>
 </table>
