<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
</head>
<body>
    <h1>Data Mahasiswa</h1>

    @if ($error)
        <p><strong>Error:</strong> {{ $error }}</p>
    @endif

    @if ($nim)
        <p>Hasil pencarian untuk NIM: <strong>{{ $nim }}</strong></p>
    @endif

    @if (count($mahasiswa) > 0)
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Usia</th>
                    <th>Program Studi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mahasiswa as $index => $mhs)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $mhs['nim'] }}</td>
                        <td>{{ $mhs['nama'] }}</td>
                        <td>{{ $mhs['email'] }}</td>
                        <td>{{ $mhs['usia'] }}</td>
                        <td>{{ $mhs['nama_prodi'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        @if (!$error)
            <p>Tidak ada data mahasiswa.</p>
        @endif
    @endif

    <p><a href="{{ route('mahasiswa.index') }}">Tampilkan Semua</a></p>
</body>
</html>