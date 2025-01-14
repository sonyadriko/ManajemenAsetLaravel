<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link href="{{ asset('assets/css/invoice.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="text-section">
                <h2>REGIONAL 4</h2>
                <p>Alamat: ex PTPN X Jl. Jembatan Merah No. 3-11</p>
                <p>ex PTPN XI Jalan Merak No. 1</p>
                <p>Kecamatan Krembangan, Kota Surabaya, 60175</p>
                <p>Telp: ex PTPN X (031) 3523143, ex PTPN XI (031) 3524596</p>
                <p>Email: skrh_reg4@ptpn1.co.id</p>
            </div>
            <div class="logo-section">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo Perusahaan" class="logo">
            </div>
        </div>
        <div class="content">
            <div class="text-section-2">
                <p>Kepada :</p>
                <p><strong>{{ $data['nama_mitra'] }}</strong></p>
                <p>{{ $data['alamat_mitra'] }}</p>
                <p><u>{{ $data['kelurahan'] }}</u></p>
                <p><strong><u>{{ $data['kecamatan'] }}</u></strong></p>
            </div>
            <div class="invoice-section">
                <p>{{ $data['no_invoice'] }}</p>
            </div>
        </div>


        <h2 style="text-align: center;">I N V O I C E</h2>

        <p style="margin: 20px 0 0 0;"><strong>{{ $data['no_kontrak'] }}</strong></p>
        <div class="table-container">
            <table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;">
                <thead style="background-color: #40E0D0; color: black;">
                    <tr>
                        <th style="padding: 2px; border: 1px solid black; text-align:center;">No</th>
                        <th colspan="2" style="padding: 2px; border: 1px solid black;">Description</th>
                        <th style="padding: 2px; border: 1px solid black; white-space: nowrap;">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 5px; border: 1px solid black; text-align:center;">1</td>
                        <td colspan="2" style="padding: 8px; border: 1px solid black; white-space: normal;">
                            Pembayaran sewa aset - {{ $data['nama_aset'] }}
                        </td>
                        <td style="padding: 5px; border: 1px solid black; text-align:center; white-space: nowrap;">
                            <span style="float: left;">Rp</span>
                            <span style="float: right;">{{ number_format($data['nilai'], 0, ',', '.') }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="border: 1px solid black; font-weight: bold; text-align: center;">PPN (11%)</td>
                        <td style="border: 1px solid black;">
                            <span style="float: left;">Rp</span>
                            <span style="float: right;">{{ number_format($data['ppn'], 0, ',', '.') }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="border: 1px solid black; font-weight: bold; text-align: center;">Total</td>
                        <td style="border: 1px solid black;">
                            <span style="float: left;">Rp</span>
                            <span style="float: right;">{{ number_format($data['total'], 0, ',', '.') }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="border: 1px solid black; font-weight: bold; text-align: center;">Kewajiban Pemotongan
                            PPh</td>
                        <td style="border: 1px solid black;">
                            <span style="float: left;">Rp</span>
                            <span style="float: right;">{{ number_format($data['pph'], 0, ',', '.') }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="border: 1px solid black; font-weight: bold; text-align: center;">Jumlah Dibayarkan
                        </td>
                        <td style="border: 1px solid black;">
                            <span style="float: left;">Rp</span>
                            <span
                                style="float: right;">{{ number_format($data['jumlah_dibayarkan'], 0, ',', '.') }}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p style="margin:0; padding:0; margin-top:20px;">Terbilang:</p>
        <p style="text-align: center;"><strong># {{ ucwords($data['terbilang']) }} Rupiah #</strong></p>

        <p style="margin: 0; padding: 0;">Pembayaran dapat dilakukan dengan transfer kepada:</p>
        <table style="border: none; width: 100%; line-height: 1; margin-left: 25px;">
            <tr>
                <td style="width: 15%;">Nama Bank</td>
                <td> : </td>
                <td>Bank Mandiri Cab. Jembatan Merah - Surabaya</td>
            </tr>
            <tr>
                <td>No. Rekening</td>
                <td> : </td>
                <td><strong>140 0004 490 430 (a.n Perkebunan Nusantara)</strong></td>
            </tr>
        </table>
        <p style="margin: 0; margin-top:15px; padding: 0;">Bukti pemotongan PPh 4 (2) harap diterbitkan dan
            dikirimkan
            segera kepada PT Perkebunan Nusantara I Regional 4 dengan penerima penghasilan sebagai berikut:</p>
        <table style="border: none; width: 100%; line-height: 1; margin-left: 25px;">
            <tr>
                <td style="width: 15%; vertical-align: top;">Nama</td>
                <td style="width: 2%; vertical-align: top;">:</td>
                <td style="vertical-align: top;">PT. Perkebunan Nusantara I</td>
            </tr>
            <tr>
                <td style="vertical-align: top;">NPWP</td>
                <td style="vertical-align: top;">:</td>
                <td style="vertical-align: top;">01.061-130.951.000 / 0010 0000 3205 1000</td>
            </tr>
            <tr>
                <td style="vertical-align: top;">Alamat</td>
                <td style="vertical-align: top;">:</td>
                <td>Gedung Agro Plaza, Jl. H.R. Rasuna Said Kav X2, 1, Kuningan Timur,
                    Setiabudi, Kota Adm. Jakarta Selatan, DKI Jakarta, 12950</td>
            </tr>
        </table>

        <div class="footer" style="text-align: right; margin-right: 20px; margin-top: 20px; line-height:1.5;">
            <div style="display: inline-block; text-align: center; margin-bottom: 80px; padding: 0;">
                <p style="margin: 0; padding: 0;">Surabaya, {{ $data['tanggal'] }}</p>
                <p style="margin: 0; padding: 0;">Menyetujui</p>
                <br>
                <br>
                <p style="font-size: 9px;">materai</p>
                <br>
                <p style="margin: 0; padding: 0;"><strong><u>{{ $data['ttd'] }}</u></strong></p>
                <p style="margin: 0; padding: 0;">{{ $data['jabatan'] }}</p>
            </div>
            <div style="display: inline-block; text-align: center; padding: 0;">

            </div>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
