<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Surat</title>

    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 12px;
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
            padding: 4px;
            text-align: center;
            font-size: 11px;
        }

        table th {
            font-weight: bold;
            font-size: 11px;
            background-color: #f0f0f0;
        }

        table td:first-child,
        table td:nth-child(2),
        table td:nth-child(3),
        table td:last-child {
            font-weight: bold;
        }

        .ttd {
            width: 300px;
            float: right;
            margin-top: 5px;
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
            <h4>LAPORAN HASIL RANKING PEGAWAI</h4>
            <p style="font-size: 12px; margin: 5px 0;">Metode TOPSIS (Technique for Order Preference by Similarity to
                Ideal Solution)</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th style="width: 30px;">No</th>
                    <th style="width: 40px;">Ranking</th>
                    <th style="width: 180px;">Nama Pegawai</th>
                    <th style="width: 120px;">NIP</th>
                    @foreach($kriterias as $kriteria)
                    <th style="width: 80px;">{{ $kriteria->nama }}</th>
                    @endforeach
                    <th style="width: 80px;">Nilai Preferensi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($rankings ?? [] as $i => $ranking)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td style="font-weight: bold; color: #000080;">{{ $ranking['rank'] }}</td>
                    <td style="text-align: left;">{{ $ranking['nama'] }}</td>
                    <td>{{ $ranking['nip'] }}</td>
                    @foreach($kriterias as $kriteria)
                    @php
                    $nilai = $decisionMatrix[$ranking['pegawai_id']][$kriteria->id] ?? 0;
                    @endphp
                    <td>{{ number_format($nilai, 2) }}</td>
                    @endforeach
                    <td style="font-weight: bold;">{{ number_format($ranking['preference'], 4) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="{{ 4 + count($kriterias) }}" style="text-align: center;">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <br>

        <table style="margin-bottom: 20px;">
            <thead>
                <tr>
                    <th colspan="2">Informasi Kriteria</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kriterias as $kriteria)
                <tr>
                    <td style="text-align: left; font-weight: bold;">{{ $kriteria->nama }}</td>
                    <td style="text-align: left;">Tipe: {{ strtoupper($kriteria->tipe) }} | Bobot: {{ $kriteria->bobot
                        }}%</td>
                </tr>
                @endforeach
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