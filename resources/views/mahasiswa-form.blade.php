<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Mahasiswa</title>
</head>
<body>
    <h1>Form Data Mahasiswa</h1>

    <form action="{{ route('mahasiswa.store') }}" method="POST">
        @csrf

        <p>
            <label>NIM (8–12 digit):</label><br>
            <input type="text" name="nim" value="{{ old('nim') }}">
            @error('nim')
                <br><span style="color:red">{{ $message }}</span>
            @enderror
        </p>

        <p>
            <label>Nama:</label><br>
            <input type="text" name="nama" value="{{ old('nama') }}">
            @error('nama')
                <br><span style="color:red">{{ $message }}</span>
            @enderror
        </p>

        <p>
            <label>Email:</label><br>
            <input type="text" name="email" value="{{ old('email') }}">
            @error('email')
                <br><span style="color:red">{{ $message }}</span>
            @enderror
        </p>

        <p>
            <label>Usia:</label><br>
            <input type="text" name="usia" value="{{ old('usia') }}">
            @error('usia')
                <br><span style="color:red">{{ $message }}</span>
            @enderror
        </p>

        <p>
            <button type="submit">Simpan</button>
        </p>
    </form>
</body>
</html>