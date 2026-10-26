<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
</head>
<body>
    <h1>Data Mahasiswa</h1>

    @if (session('berhasil'))
        <p>{{ session('berhasil') }}</p>
    @endif
    @if (session('gagal'))
        <p>{{ session('gagal') }}</p>
    @endif

    <h2>Tambah Mahasiswa</h2>
    <form action="{{ route('mahasiswa.store') }}" method="POST">
        @csrf
        
        <p>
            NIM<br>
            <input type="text" name="nim" value="{{ old('nim') }}">
            @error('nim') <br><b>{{ $message }}</b> @enderror
        </p>
        
        <p>
            Nama<br>
            <input type="text" name="nama" value="{{ old('nama') }}">
            @error('nama') <br><b>{{ $message }}</b> @enderror
        </p>
        
        <p>
            Email<br>
            <input type="text" name="email" value="{{ old('email') }}">
            @error('email') <br><b>{{ $message }}</b> @enderror
        </p>
        
        <p>
            Usia<br>
            <input type="number" name="usia" value="{{ old('usia') }}">
            @error('usia') <br><b>{{ $message }}</b> @enderror
        </p>
        
        <p>
            Program Studi<br>
            <select name="program_studi_id">
                <option value="">-- Pilih Program Studi --</option>
                @foreach ($daftarProgramStudi as $prodi)
                    <option value="{{ $prodi['id'] }}" @selected(old('program_studi_id') == $prodi['id'])>
                        {{ $prodi['nama'] }}
                    </option>
                @endforeach
            </select>
            @error('program_studi_id') <br><b>{{ $message }}</b> @enderror
        </p>
        
        <p><button type="submit">Tambah Data</button></p>
    </form>

    <h2>Daftar Mahasiswa</h2>
    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>NIM</th><th>Nama</th><th>Email</th><th>Usia</th><th>Program Studi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($daftarMahasiswa as $mahasiswa)
                <tr>
                    <td>{{ $mahasiswa['nim'] }}</td>
                    <td>{{ $mahasiswa['nama'] }}</td>
                    <td>{{ $mahasiswa['email'] }}</td>
                    <td>{{ $mahasiswa['usia'] }}</td>
                    <td>{{ $mahasiswa['nama_prodi'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Data belum tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>