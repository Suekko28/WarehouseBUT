<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="{{ asset('template/assets') }}/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />

    <title>Report Print</title>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            window.print();
        });
    </script>
</head>

<body>
    <table class="table table-striped table-bordered">
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
        <tbody>
            @forelse ($data as $key => $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->warehouse}}</td>
                    <td>{{$item->item->name}}</td>
                    <td>{{$item->qty}}</td>
                    <td>{{$item->item->vendor_name}}</td>
                    <td>{{$item->date_input_custom}}</td>
                </tr>
            @empty
            @endforelse
        </tbody>
    </table>
</body>
