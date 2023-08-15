<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Report Excel</title>
</head>

<body>
    <table style="border:1px solid #000" border="1">
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
