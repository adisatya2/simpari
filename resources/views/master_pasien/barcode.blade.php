<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" sizes="50x50" href="{{ asset('dist/img/Logo Hermina.ico') }}">
    <title>Cetak Barcode</title>
</head>
<style>
    @page {
        size: 3cm 10cm landscape;
        margin: 5px 20px 5px 20px;
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

    .b-1 {
        border: 1px solid black;
    }

    .pt-1 {
        padding-top: 10px;
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

<body>
    {{-- <div class="text-center p-1" width="100%">
        <p style="padding: 0;margin:0;">{{ $pasien->nama_pasien }}</p>
        <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($pasien->mrn, 'C39') }}" alt="{{ $pasien->mrn }}"
            width="90%" height="40">
        <br>
        <p style="padding: 0;margin:0;">{{ $pasien->tanggal_lahir }}</p>
    </div> --}}
    <table width="100%">
        <tr>
            <td colspan="2">
                {{ $pasien->nama_pasien }} ({{ $pasien->jk }})
            </td>
        </tr>
        <tr>
            <td>
                {{ $pasien->mrn }}
            </td>
            <td class="text-right">
                {{ $pasien->nik }}
            </td>
        </tr>
        <tr>
            <td>{{ tanggal_indonesia($pasien->tanggal_lahir, false) }}</td>
            <td class="text-right">
                {{ hitung_umur($pasien->tanggal_lahir, true, true, false) }}
            </td>
        </tr>
        <tr>
            <td class="text-center" colspan="2">
                <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($pasien->mrn, 'C39E') }}"
                    alt="{{ $pasien->mrn }}" width="90%" height="40">
            </td>
        </tr>
    </table>
</body>

</html>
