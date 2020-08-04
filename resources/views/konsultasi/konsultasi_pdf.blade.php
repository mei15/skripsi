<html>

<!DOCTYPE html>
<html>

<head>
    <title>LAPORAN KONSULTASI</title>
    <link href="{!!asset('css/bootstrap.min.css')!!}" rel="stylesheet" type="text/css">
    <link href="{!!asset('css/dashboard.css')!!}" rel="stylesheet" type="text/css">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Mahasiswa</th>
                <th>Judul</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Nama Dosen Pembimbing</th>
            </tr>
        </thead>
        <tbody>
            @foreach($konsultasi as $konsultasi)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $konsultasi->mahasiswa->full_name }}</td>
                <td>{{ $konsultasi->judul }}</td>
                <td>{{ $konsultasi->tanggal->format('d-M-Y | H:i') }}</td>
                <td>{{ $konsultasi->keterangan }}</td>
                <td>{{ $konsultasi->dosen->full_name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>