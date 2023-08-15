@extends('layouts.app')
@section('content')

@component('components.card',[
    'title' => 'Laporan'
 ])
 <div class="mb-3">
    <label for="Tanggal">Tanggal</label>
    <input type="text" id="date-input" class="form-control range-datepicker" placeholder="Tanggal">
 </div>

 <div class="mb-3">
    <label for="Gudang">Gudang</label>
    <select id="warehouse" class="form-control select-2">
        <option value="">Pilih..</option>
        @foreach ($warehouse as $key => $item)
            <option value="{{ $key }}">{{ $item['label'] }}</option>
        @endforeach
    </select>
 </div>

 <table class="table table-bordered table-striped" id="report-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Gudang</th>
            <th>Barang</th>
            <th>Jumlah</th>
            <th>Customer</th>
            <th>Tanggal</th>
        </tr>
    </thead>
 </table>
 <div class="row mt-2" style="display: none" id="export-excel-btn">
    <div class="col-12 col-md-6">
        <button class="btn btn-outline-success col-12" onclick="exportReport('excel')">Export Excel</button>
    </div>
    <div class="col-12 col-md-6">
        <button class="btn btn-outline-danger col-12" onclick="exportReport('pdf')">Export Print / PDF</button>
    </div>
</div>
 @endcomponent
@endsection
@section('js')
<script>
    function exportReport(type) {
            var date = $('#date-input').val().split(' to ')
            var start_date = date[0]
            var end_date = date[1] || date[0]
            var warehouse = $('#warehouse').val()

            window.location.href = "{{ route('report.export') }}?action=" + type +
                "&start_date=" + start_date + "&end_date=" + end_date + "&warehouse=" + warehouse + "&type={{ $type }}"
        }
    $(function() {

        $("#date-input, #warehouse").on('change',function() {
            table.draw()
        })



        var table = $('#report-table').DataTable({
            responsive: $(window).width() < 768 ? true : false,
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('report',$type) }}',
                data: function(d) {
                    var date = $('#date-input').val().split(' to ');
                    d.start_date = date[0];
                    d.end_date = date[1] ?? date[0];
                    d.warehouse = $('#warehouse').val();
                },
                dataSrc: function(res) {
                    if (res?.data?.length > 0) {
                        $("#export-excel-btn").fadeIn()
                    } else {
                        $("#export-excel-btn").fadeOut()
                    }
                    return res.data
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'item.warehouse',
                    name: 'item.warehouse'
                },
                {
                    data: 'item.name',
                    name: 'item.name'
                },
                {
                    data: 'qty',
                    name: 'qty'
                },
                {
                    data: 'item.vendor_name',
                    name: 'item.vendor_name'
                },
                {
                    data: 'date_input',
                    name: 'date_input'
                }
            ]
        })
    })
</script>
@endsection
