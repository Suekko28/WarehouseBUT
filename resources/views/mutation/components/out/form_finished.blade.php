<div class="mb-3">
    <label for="Barang">Barang</label>
    <select name="item_id" class="form-control select-2">
        <option value="">Pilih...</option>
        @forelse ($items as $item)
        <option value="{{$item->id}}" {{isset($edit) ? ($data->item_id === $item->id ? 'selected' : '') : '' }}>{{$item->name }}</option>
        @empty
        @endforelse
    </select>
    @include('includes.error',['data' => 'item_id'])
</div>

<div class="mb-3">
    <label for="No PO">No PO</label>
    <input type="text" name="po_number" class="form-control" value="{{ old('po_number',isset($edit) ? $data->po_number : '') }}" placeholder="Nomor PO">
    @include('includes.error',['data' => 'po_number'])
</div>

<div class="mb-3">
    <label for="No Surat Jalan">No Surat Jalan</label>
    <input type="text" name="letter_number" class="form-control" value="{{ old('letter_number',isset($edit) ? $data->letter_number : '') }}" placeholder="Nomor Surat jalan">
    @include('includes.error',['data' => 'letter_number'])
</div>

<div class="mb-3">
    <label for="Jumlah">Jumlah</label>
    <input type="number" name="{{$qty_str}}" class="form-control" value="{{ old($qty_str,isset($edit) ? $qty : '') }}" placeholder="Jumlah">
    @include('includes.error',['data' => $qty_str])
</div>

<div class="mb-3">
    <label for="Tanggal Pengiriman">Tanggal Pengiriman</label>
    <input type="date" name="date_delivery" class="form-control" value="{{ old('date_delivery',isset($edit) ? \Carbon\Carbon::parse($data->date_delivery)->format('Y-m-d') : date('Y-m-d')) }}" placeholder="Tanggal Pengiriman">
    @include('includes.error',['data' => 'date_delivery'])
</div>

<div class="mb-3">
    <label for="Keterangan">Keterangan</label>
    <textarea name="description" cols="30" rows="10" class="form-control" placeholder="Keterangan">{{ old('description',isset($edit) ? $data->description : '') }}</textarea>
    @include('includes.error',['data' => 'description'])
</div>

