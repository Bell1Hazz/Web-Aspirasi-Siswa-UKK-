<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Data Aspirasi</title>

    <style>
        body{
            font-family: 'Segoe UI', Arial, sans-serif;
            font-size: 14px;
            margin: 40px;
            color: #2c3e50;
        }

        .report-header{
            text-align: center;
            margin-bottom: 30px;
        }

        .report-header h2{
            margin: 0;
            font-size: 22px;
            font-weight: 600;
        }

        .report-sub{
            margin-top: 5px;
            font-size: 13px;
            color: #6c757d;
        }

        .table-wrapper{
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }

        table{
            width: 100%;
            border-collapse: collapse;
        }

        th{
            background: #f8f9fa;
            font-weight: 600;
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        td{
            padding: 10px;
            border-bottom: 1px solid #f1f1f1;
        }

        tr:nth-child(even){
            background: #fafafa;
        }

        .status-badge{
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }

        .status-diajukan{
            background: #e3f2fd;
            color: #1565c0;
        }

        .status-diproses{
            background: #fff3cd;
            color: #856404;
        }

        .status-selesai{
            background: #e6f4ea;
            color: #1e7e34;
        }

        .print-btn{
            background: #2563eb;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
        }

        .print-btn:hover{
            opacity: 0.9;
        }

        .top-actions{
            text-align: right;
            margin-bottom: 20px;
        }

        .footer-info{
            margin-top: 40px;
            font-size: 12px;
            color: #6c757d;
            text-align: right;
        }

        @media print{
            .no-print{
                display: none;
            }

            body{
                margin: 0;
            }
        }
    </style>
</head>
<body>

<div class="top-actions no-print">
    <button onclick="window.print()" class="print-btn">
        Cetak Sekarang
    </button>
</div>

<div class="report-header">
    <h2>Data Aspirasi</h2>
    <div class="report-sub">
        Dicetak pada {{ now()->format('d-m-Y H:i') }}
    </div>
</div>

<div class="table-wrapper">
    <table>
        <thead>
            <tr>
                <th width="5%">#</th>
                <th>Judul</th>
                <th>Siswa</th>
                <th>Kategori</th>
                <th width="15%">Tanggal</th>
                <th width="15%">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($aspirasis as $index => $aspirasi)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $aspirasi->judul }}</td>
                <td>{{ $aspirasi->user->nama }}</td>
                <td>{{ $aspirasi->kategori->nama_kategori }}</td>
                <td>{{ \Carbon\Carbon::parse($aspirasi->tanggal_pengajuan)->format('d-m-Y') }}</td>
                <td>
                    <span class="status-badge status-{{ strtolower($aspirasi->status) }}">
                        {{ $aspirasi->status }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="footer-info">
    Total Data: {{ $aspirasis->count() }} aspirasi
</div>

</body>
</html>