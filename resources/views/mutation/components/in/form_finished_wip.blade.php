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
    <label for="Tanggal">Tanggal Masuk</label>
    <input type="date" name="date_input" class="form-control" value="{{ old('date_input',isset($edit) ? \Carbon\Carbon::parse($data->date_input)->format('Y-m-d') : date('Y-m-d')) }}" placeholder="Tanggal Masuk">
    @include('includes.error',['data' => 'date_input'])
</div>

<div class="mb-3">
    <label for="Tanggal">Tanggal Produksi</label>
    <input type="date" name="date_production" class="form-control" value="{{ old('date_production',isset($edit) ? \Carbon\Carbon::parse($data->date_production)->format('Y-m-d') : date('Y-m-d')) }}" placeholder="Tanggal Produksi">
    @include('includes.error',['data' => 'date_production'])
</div>

