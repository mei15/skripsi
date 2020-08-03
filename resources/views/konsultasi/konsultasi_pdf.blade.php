<html>

<head>
    <title>Laporan Konsultasi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
        </tbody>
    </table>

</body>

</html>