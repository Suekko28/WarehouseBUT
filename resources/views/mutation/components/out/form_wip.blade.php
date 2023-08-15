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
    <label for="Mesin">Mesin</label>
    <input type="text" name="machine" class="form-control" value="{{ old('machine',isset($edit) ? $data->machine : '') }}" placeholder="Mesin">
    @include('includes.error',['data' => 'machine'])
</div>

<div class="mb-3">
    <label for="OK">OK</label>
    <input type="number" name="ok" class="form-control" value="{{ old('ok',isset($edit) ? $data->ok : 0) }}" placeholder="OK">
    @include('includes.error',['data' => 'ok'])
</div>

<div class="mb-3">
    <label for="Reject">Reject</label>
    <input type="number" name="reject" class="form-control" value="{{ old('reject',isset($edit) ? $data->reject : 0) }}" placeholder="Reject">
    @include('includes.error',['data' => 'reject'])
</div>

<div class="mb-3">
    <label for="Jumlah">Jumlah</label>
    <input type="number" name="qty_out" id="qty" class="form-control" value="{{ old('qty_out',isset($edit) ? $data->qty_out : 0) }}" placeholder="Jumlah" readonly>
    @include('includes.error',['data' => 'qty_out'])
</div>

<div class="mb-3">
    <label for="Tanggal Produksi">Tanggal Produksi</label>
    <input type="date" name="date_production" class="form-control" value="{{ old('date_production',isset($edit) ? \Carbon\Carbon::parse($data->date_production)->format('Y-m-d') : date('Y-m-d')) }}" placeholder="Tanggal Produksi">
    @include('includes.error',['data' => 'date_production'])
</div>

<div class="mb-3">
    <label for="Keterangan">Keterangan</label>
    <textarea name="description" cols="30" rows="10" class="form-control" placeholder="Keterangan">{{ old('description',isset($edit) ? $data->description : '') }}</textarea>
    @include('includes.error',['data' => 'description'])
</div>

<script>
    function getQty() {
        var ok = $("input[name='ok']").val();
        var reject = $("input[name='reject']").val();
        var qty = parseInt(ok) + parseInt(reject);
        $("input[name='qty_out']").val(qty);
    }
    $("input[name='ok'],input[name='reject']").on("change", getQty);
    $("input[name='ok'],input[name='reject']").on("keyup", getQty);

</script>

