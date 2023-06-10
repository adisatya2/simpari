<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="50x50" href="{{ asset('dist/img/Logo Hermina.ico') }}">
    <title>Cetak Label</title>
</head>
<style>
    @page {
        size: 3cm 10cm landscape;
        margin: 5px 10px 5px 10px;
        font-size: 0.7em;
    }

    .text-center {
        text-align: center;
        align-content: center;
    }

    .text-right {
        text-align: right;
        align-content: right;
    }

    .table {
        padding: 0;
        margin: 0;
    }

    .table tr {
        padding: 0;
        margin: 0;
    }

    .table tr td {
        padding: 0;
        margin: 0;
    }
</style>
@foreach ($data_gizi as $item)

<body>
    <table width="100%">
        <tr>
            <td colspan="2">
                {{ $item->data_pasien->nama_pasien }} ({{ $item->data_pasien->jk }})
            </td>
        </tr>
        <tr>
            <td>
                {{ $item->mrn }}
            </td>
            <td class="text-right">
                {{ $item->no_kamar }}
            </td>
        </tr>
        <tr>
            <td>{{ tanggal_indonesia($item->data_pasien->tanggal_lahir, false) }}</td>
            <td class="text-right">
                {{ hitung_umur($item->data_pasien->tanggal_lahir, true, true, false) }}
            </td>
        </tr>
    </table>

    <table style="font-style: bold;border-collapse: collapse;font-size:15px" width="100%">
        <tr>
            <td>
                Diet
            </td>
            <td style="text-align: center">
                :
            </td>
            <td width="85%">
                {{ $item->data_gizi ? $item->data_gizi->diet:''}}
            </td>
        </tr>
        <tr>
            <td>
                Ket
            </td>
            <td style="text-align: center">
                :
            </td>
            <td>
                {{ $item->data_gizi ? $item->data_gizi->keterangan:''}}
            </td>
        </tr>
    </table>
</body>
@endforeach


</html>