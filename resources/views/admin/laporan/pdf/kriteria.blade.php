<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Surat</title>

    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 14px;
        }

        .container {
            width: 100%;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
            position: relative;
        }

        .logo-container {
            position: absolute;
            left: 0;
            top: 0;
            width: 80px;
            height: 120px;
        }

        .logo-container img {
            width: 100%;
            height: auto;
            max-height: 100px;
        }

        .header-content {
            margin-left: 100px;
        }

        .header h1 {
            font-size: 24px;
            font-weight: bold;
            margin: 1px 0;
            text-transform: uppercase;
        }

        .header h2 {
            font-size: 20px;
            font-weight: bold;
            margin: 1px 0;
            text-transform: uppercase;
        }

        .header p {
            font-size: 12px;
            margin: 3px 0;
        }

        .line {
            border-top: 2px solid black;
            margin: 10px 0 20px 0;
        }

        .judul {
            text-align: center;
            margin-bottom: 20px;
        }

        .judul h4 {
            margin: 0;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid black;
            padding: 6px;
            text-align: center;
        }

        table th {
            font-weight: bold;
            font-size: 12px;
        }

        .ttd {
            width: 300px;
            float: right;
            margin-top: 40px;
            text-align: left;
        }

        .ttd p {
            margin: 3px 0;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="header">

            <div class="logo-container">
                <img src="{{ base_path('public/logo/jagung.png') }}" width="110px">
            </div>
            <div class="header-content">
                <h1>PEMERINTAH KABUPATEN HULU SUNGAI UTARA</h1>
                <h2>DINAS KOMUNIKASI INFORMATIKA DAN SANDI</h2>
                <p>Jl. Jendral A. Yani No 12 Amuntai, Kabupaten Hulu Sungai Utara. Provinsi Kalimantan Selatan, 71414
                </p>
                <p>Telepon (0527) 61014</p>
            </div>

        </div>

        <div class="line"></div>

        <div class="judul">
            <h4>LAPORAN DATA KRITERIA</h4>
        </div>

        <table>
            <thead>
                <tr>
                    <th style="width: 30px;">No</th>
                    <th>Nama Kriteria</th>
                    <th>Tipe</th>
                    <th>Bobot (%)</th>
                </tr>
            </thead>

            <tbody>
                @forelse($kriterias ?? [] as $i => $kriteria)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $kriteria->nama }}</td>
                    <td>{{ strtoupper($kriteria->tipe) }}</td>
                    <td>{{ $kriteria->bobot }}%</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="ttd">
            <p>Amuntai, {{ now()->translatedFormat('d F Y') }}</p>
            <p>Kepala Bidang Kepegawaian</p>

            <br><br><br>

            <p><b>nama</b></p>
            <p>NIP.</p>
        </div>

    </div>

</body>

</html>