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
    <label for="Jumlah">Jumlah</label>
    <input type="number" name="{{$qty_str}}" class="form-control" value="{{ old($qty_str,isset($edit) ? $qty : '') }}" placeholder="Jumlah">
    @include('includes.error',['data' => $qty_str])
</div>

<div class="mb-3">
    <label for="PIC">PIC</label>
    <input type="text" name="pic" class="form-control" value="{{ old('pic',isset($edit) ? $data->pic : '') }}" placeholder="PIC">
    @include('includes.error',['data' => 'pic'])
</div>

<div class="mb-3">
    <label for="Tanggal Keluar">Tanggal Keluar</label>
    <input type="date" name="date_input" class="form-control" value="{{ old('date_input',isset($edit) ? \Carbon\Carbon::parse($data->date_input)->format('Y-m-d') : date('Y-m-d')) }}" placeholder="Tanggal Keluar">
    @include('includes.error',['data' => 'date_input'])
</div>

<div class="mb-3">
    <label for="Keterangan">Keterangan</label>
    <textarea name="description" cols="30" rows="10" class="form-control" placeholder="Keterangan">{{ old('description',isset($edit) ? $data->description : '') }}</textarea>
    @include('includes.error',['data' => 'description'])
</div>

