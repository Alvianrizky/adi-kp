<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        table.center {
            margin-left: auto;
            margin-right: auto;
            width: 100%;
        }
        .table-css {
        font-family: sans-serif;
        color: #444;
        border-collapse: collapse;
        border: 1px solid #f2f5f7;
        }

        .table-css tr th{
            background: #35A9DB;
            color: #fff;
            font-weight: normal;
        }

        .table-css, th, td {
            /* padding: 8px 20px; */
            text-align: center;
        }

        .table-css tr:hover {
            background-color: #f5f5f5;
        }

        .table-css tr:nth-child(even) {
            background-color: #f2f2f2;
    }
    </style>
</head>
<body>
    <center>
        <h3 class="text-center">Laporan Pembayaran SPP TPA FIRDAUS</h3>
        <p>Alamat : Brontokusuman, Kec. Mergangsan, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55153</p>
    </center>
    <hr>
    <table class="center table-css" cellpadding="7">
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Jumlah</th>
        </tr>
        @foreach ($data as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->tanggal}}</td>
                <td>{{$item->keterangan}}</td>
                <td>{{$item->jumlah}}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4">TOTAL</td>
            <td>{{$data->sum('jumlah')}}</td>
        </tr>
    </table>
</body>
</html>

