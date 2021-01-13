<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Resi</title>
    <style type="text/css">
        .lead {
            font-family: "Verdana";
            font-weight: bold;
        }
        .value {
            font-family: "Verdana";
        }
        .value-big {
            font-family: "Verdana";
            font-weight: bold;
            font-size: large;
        }
        .td {
            align : "top";
        }
</style>
</head>

<body>
    <table border="1px" style="width: 100%">
        <tr>
            <td><h3><b><center>STRUK PEMBAYARAN SPP</center></b></h3></td>
        </tr>
		<tr>
			<td>
				<table cellpadding="7">
					<tr>
						<td><div class="lead">Telah Terima Dari</div></td>
						<td><div class="value"><b>:</b>&nbsp;&nbsp;{{$data->name}}</div></td>
					</tr>
					<tr>
						<td><div class="lead">Untuk Pembayaran</div></td>
						<td><div class="value"><b>:</b>&nbsp;&nbsp;{{$data->keterangan}}</div></td>
					</tr>
					<tr>
						<td><div class="lead">Tanggal</div></td>
						<td><div class="value"><b>:</b>&nbsp;&nbsp;{{$data->tanggal}}</div></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td><div class="lead">Jumlah Pembayaran</div></td>
						<td><div class="value"><b>:</b>&nbsp;&nbsp;{{$data->jumlah}}</div></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>

</html>
