@if($type == "in")
{{-- in --}}
@if(in_array($warehouse,['finished','wip']))
<table class="table table-bordered table-striped table-json">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Barang</th>
            <th>Nama Customer</th>
            <th>Tanggal Produksi/QC</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @forelse ($data as $item)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item->item->name}}</td>
            <td>{{$item->item->vendor_name}}</td>
            <td>{{$item->date_production->translatedFormat('l, d F Y')}}</td>
            <td>{{$type == "in" ? $item->qty_in : $item->qty_out}}</td>
            <td>{{ucwords($item->item->satuan)}}</td>
            <td>
                <a href="{{route('item-mutations.type.show',[
                    'itemMutation' => $item->id,
                    'type' => $type
                ])}}" class="btn btn-sm btn-info"><i class="uil uil-eye"></i></a>
                <a href="{{route('item-mutations.type.edit',[
                    'itemMutation' => $item->id,
                    'type' => $type
                ])}}" class="btn btn-sm btn-warning"><i class="uil uil-edit"></i></a>
                <a href="javascript:;" onclick="form_delete('{{route('item-mutations.destroy',$item->id)}}')" class="btn btn-sm btn-danger">
                    <i class="uil uil-trash"></i>
                </a>
            </td>
        </tr>
    @empty
    @endforelse
    </tbody>
 </table>
 @endif

@if(in_array($warehouse,['child','raw']))
<table class="table table-bordered table-striped table-json">
    <thead>
        <tr>
            <th>#</th>
            <th>No Surat Jalan</th>
            <th>No PO</th>
            <th>Nama Barang</th>
            <th>Supplier</th>
            <th>Tanggal Masuk</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @forelse ($data as $item)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item->po_number}}</td>
            <td>{{$item->letter_number}}</td>
            <td>{{$item->item->name}}</td>
            <td>{{$item->item->vendor_name}}</td>
            <td>{{$item->date_input->translatedFormat('l, d F Y')}}</td>
            <td>{{$type == "in" ? $item->qty_in : $item->qty_out}}</td>
            <td>{{ucwords($item->item->satuan)}}</td>
            <td>
                <a href="{{route('item-mutations.type.show',[
                    'itemMutation' => $item->id,
                    'type' => $type
                ])}}" class="btn btn-sm btn-info"><i class="uil uil-eye"></i></a>
                <a href="{{route('item-mutations.type.edit',[
                    'itemMutation' => $item->id,
                    'type' => $type
                ])}}" class="btn btn-sm btn-warning"><i class="uil uil-edit"></i></a>
                <a href="javascript:;" onclick="form_delete('{{route('item-mutations.destroy',$item->id)}}')" class="btn btn-sm btn-danger">
                    <i class="uil uil-trash"></i>
                </a>
            </td>
        </tr>
    @empty
    @endforelse
    </tbody>
 </table>
 @endif

@else
@if($warehouse == "finished")
<table class="table table-bordered table-striped table-json">
    <thead>
        <tr>
            <th>#</th>
            <th>No Surat Jalan</th>
            <th>No PO</th>
            <th>Nama Barang</th>
            <th>Supplier</th>
            <th>Tanggal Pengiriman</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @forelse ($data as $item)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item->po_number}}</td>
            <td>{{$item->letter_number}}</td>
            <td>{{$item->item->name}}</td>
            <td>{{$item->item->vendor_name}}</td>
            <td>{{$item->date_delivery->translatedFormat('l, d F Y')}}</td>
            <td>{{$item['qty_'.$type]}}</td>
            <td>{{ucwords($item->item->satuan)}}</td>
            <td>
                <a href="{{route('item-mutations.type.show',[
                    'itemMutation' => $item->id,
                    'type' => $type
                ])}}" class="btn btn-sm btn-info"><i class="uil uil-eye"></i></a>
                <a href="{{route('item-mutations.type.edit',[
                    'itemMutation' => $item->id,
                    'type' => $type
                ])}}" class="btn btn-sm btn-warning"><i class="uil uil-edit"></i></a>
                <a href="javascript:;" onclick="form_delete('{{route('item-mutations.destroy',$item->id)}}')" class="btn btn-sm btn-danger">
                    <i class="uil uil-trash"></i>
                </a>
            </td>
        </tr>
    @empty
    @endforelse
    </tbody>
 </table>
@elseif($warehouse == "wip")
<table class="table table-bordered table-striped table-json">
    <thead>
        <tr>
            <th>#</th>
            <th>Tanggal Produksi</th>
            <th>Mesin</th>
            <th>Nama Customer</th>
            <th>Nama Barang</th>
            <th>OK</th>
            <th>Reject</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @forelse ($data as $item)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item->date_production->translatedFormat('l, d F Y')}}</td>
            <td>{{$item->machine}}</td>
            <td>{{$item->item->vendor_name}}</td>
            <td>{{$item->item->name}}</td>
            <td>{{$item->ok}}</td>
            <td>{{$item->reject}}</td>
            <td>{{$item->ok + $item->reject}}</td>
            <td>{{ucwords($item->item->satuan)}}</td>
            <td>
                <a href="{{route('item-mutations.type.show',[
                    'itemMutation' => $item->id,
                    'type' => $type
                ])}}" class="btn btn-sm btn-info"><i class="uil uil-eye"></i></a>
                <a href="{{route('item-mutations.type.edit',[
                    'itemMutation' => $item->id,
                    'type' => $type
                ])}}" class="btn btn-sm btn-warning"><i class="uil uil-edit"></i></a>
                <a href="javascript:;" onclick="form_delete('{{route('item-mutations.destroy',$item->id)}}')" class="btn btn-sm btn-danger">
                    <i class="uil uil-trash"></i>
                </a>
            </td>
        </tr>
    @empty
    @endforelse
    </tbody>
 </table>
 @elseif(in_array($warehouse,['child','raw']))
 <table class="table table-bordered table-striped table-json">
    <thead>
        <tr>
            <th>#</th>
            <th>Tanggal Keluar</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>PIC</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @forelse ($data as $item)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item->date_input->translatedFormat('l, d F Y')}}</td>
            <td>{{$item->item->name}}</td>
            <td>{{$item['qty_'.$type]}}</td>
            <td>{{ucwords($item->item->satuan)}}</td>
            <td>{{$item->pic}}</td>
            <td>{{$item->description}}</td>
            <td>
                <a href="{{route('item-mutations.type.show',[
                    'itemMutation' => $item->id,
                    'type' => $type
                ])}}" class="btn btn-sm btn-info"><i class="uil uil-eye"></i></a>
                <a href="{{route('item-mutations.type.edit',[
                    'itemMutation' => $item->id,
                    'type' => $type
                ])}}" class="btn btn-sm btn-warning"><i class="uil uil-edit"></i></a>
                <a href="javascript:;" onclick="form_delete('{{route('item-mutations.destroy',$item->id)}}')" class="btn btn-sm btn-danger">
                    <i class="uil uil-trash"></i>
                </a>
            </td>
        </tr>
    @empty
    @endforelse
    </tbody>
 </table>
 @endif
@endif
