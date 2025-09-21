<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        .judullaporan .nama-laporan {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            display: block;
        }

        .judullaporan .periode-laporan {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            display: block;
        }

        .content {
            margin-top: 100px;
        }

        .barisKosong {
            display: block;
        }

        .no-border-bottom {
            border-bottom: 1px solid #eee;
        }

        .no-border-top {
            border-top: 1px solid #eee;
        }

        .add-border-top {
            border-top: 1px solid black;
        }

        .add-border-bottom {
            border-bottom: 1px solid black;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th class="" style="width: 10%; text-align: center;" rowspan="3"><img
                        src="{{ public_path('images/Kalbar-01.png') }}" alt="" style="width: 50px;"></th>
                <th style="width: 90%; font-size: 15px; text-align: left; padding-right: 50px;" colspan="7">BIRO
                    PEMERINTAHAN SETDA PROVINSI KALIMANTAN BARAT</th>
            </tr>
            <tr>
                <th style="font-size: 10px; text-align: left;" colspan="7">Jl. A. Yani No. 1, Kalimantan Barat</th>
            </tr>
            <tr>
                <th class="" style="font-size: 10px; text-align: left;" colspan="7">No Telepon. (0511) 353 353</th>
            </tr>
        </thead>
    </table>

    <div class="judullaporan">
        <div class="nama-laporan">LAPORAN PEMBENTUKAN KECAMATAN</div>
        <div class="periode-laporan">PERIODE {{ Str::upper(tglindonesia($tglawal)) }} S/D {{
            Str::upper(tglindonesia($tglakhir)) }}</div>
    </div>

    <div class="content">
        <table border="1" cellpadding="2" width="100%">
            <thead>
                <tr style="font-size: 10px; font-weight: bold;">
                    <th width="5%" style="text-align:center;">NO</th>
                    <th width="15%" style="text-align:center;">TANGGAL PENGAJUAN</th>
                    <th width="15%" style="text-align:center;">KABUPATEN INDUK</th>
                    <th width="35%" style="text-align:center;">KECAMATAN INDUK</th>
                    <th width="15%" style="text-align:center;">NAMA KECAMATAN BARU</th>
                    <th width="15%" style="text-align:center;">STATUS PENGAJUAN</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp

                @if (count($rsPembentukan) == 0)
                <tr style="font-size:10px;">
                    <td width="100%" style="text-align:center;" colspan="6">Data tidak
                        ditemukan...</td>
                </tr>
                @else

                @foreach ($rsPembentukan as $row)

                <tr style="font-size: 9px;">
                    <td width="5%" style="text-align:center;">{{ $no++ }}</td>
                    <td width="15%" style="text-align:center;">{{ tglindonesia($row->tglpengajuan) }}</td>
                    <td width="15%" style="text-align:center;">{{ $row->namakabupaten }}</td>
                    <td width="35%" style="text-align:left;">{{ $row->namakecamatan }}</td>
                    <td width="15%" style="text-align:center;">{{ $row->namakecamatanbaru }}</td>
                    <td width="15%" style="text-align:right;">{{ $row->namastatuspengajuannext }}</td>
                </tr>
                @endforeach


                @endif
            </tbody>
        </table>
    </div>
</body>

</html>