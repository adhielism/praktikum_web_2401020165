<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/latihan-php', function () {
    $nama = 'Adhie Mulia Sembiring';
    $nilai = [80, 85, 90, 78, 88];

    $hitungRataRata = function (array $data): float {
        $total = 0;
        foreach ($data as $angka) {
            $total += $angka;
        }
        return $total / count($data);
    };

    $rataRata = $hitungRataRata($nilai);
    if ($rataRata >= 75) {
        $status = 'Lulus';
    } else {
        $status = 'Perlu Perbaikan';
    }

    return view('latihan-php', compact('nama', 'nilai', 'rataRata', 'status'));
});

/* ============================================
   PERTEMUAN 3 (DISEMBUNYIKAN KARENA BENTROK DENGAN PERTEMUAN 6)
   ============================================
Route::get('/mahasiswa/create', function () {
    return view('mahasiswa-form');
})->name('mahasiswa.create');

Route::post('/mahasiswa/store', function (\Illuminate\Http\Request $request) {
    $request->merge([
        'nim'   => trim($request->input('nim', '')),
        'nama'  => trim(strip_tags($request->input('nama', ''))),
        'email' => trim($request->input('email', '')),
        'usia'  => trim($request->input('usia', '')),
    ]);

    $validated = $request->validate([
        'nim'   => ['required', 'regex:/^[0-9]{8,12}$/'],
        'nama'  => ['required', 'string', 'min:3', 'max:100'],
        'email' => ['required', 'email', 'max:100'],
        'usia'  => ['required', 'integer', 'min:15', 'max:100'],
    ], [
        'nim.required'   => 'NIM wajib diisi.',
        'nim.regex'      => 'NIM harus berupa 8–12 digit angka.',
        'nama.required'  => 'Nama wajib diisi.',
        'nama.min'       => 'Nama minimal 3 karakter.',
        'email.required' => 'Email wajib diisi.',
        'email.email'    => 'Format email tidak valid.',
        'usia.required'  => 'Usia wajib diisi.',
        'usia.integer'   => 'Usia harus berupa angka.',
        'usia.min'       => 'Usia minimal 15 tahun.',
        'usia.max'       => 'Usia maksimal 100 tahun.',
    ]);

    return view('mahasiswa-hasil', ['data' => $validated]);
})->name('mahasiswa.store');
============================================
*/

// ============================================
// PERTEMUAN 5 (DISEMBUNYIKAN SEMENTARA)
// ============================================
/*
Route::get('/mahasiswa', function () {
    try {
        $dsn = 'mysql:host=' . env('DB_HOST') . ';port=' . env('DB_PORT') . ';dbname=' . env('DB_DATABASE') . ';charset=utf8mb4';
        $pdo = new PDO($dsn, env('DB_USERNAME'), env('DB_PASSWORD'));
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare('
            SELECT m.nim, m.nama, m.email, m.usia, p.nama AS nama_prodi
            FROM mahasiswa m
            INNER JOIN program_studi p ON m.program_studi_id = p.id
            ORDER BY m.nim
        ');
        $stmt->execute();
        $mahasiswa = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return view('mahasiswa', [
            'mahasiswa' => $mahasiswa,
            'nim' => null,
            'error' => null,
        ]);
    } catch (\PDOException $e) {
        \Log::error('Koneksi PDO gagal: ' . $e->getMessage());
        return view('mahasiswa', [
            'mahasiswa' => [],
            'nim' => null,
            'error' => 'Terjadi kesalahan pada koneksi database.',
        ]);
    }
})->name('mahasiswa.index');

Route::get('/mahasiswa/{nim}', function ($nim) {
    try {
        $dsn = 'mysql:host=' . env('DB_HOST') . ';port=' . env('DB_PORT') . ';dbname=' . env('DB_DATABASE') . ';charset=utf8mb4';
        $pdo = new PDO($dsn, env('DB_USERNAME'), env('DB_PASSWORD'));
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare('
            SELECT m.nim, m.nama, m.email, m.usia, p.nama AS nama_prodi
            FROM mahasiswa m
            INNER JOIN program_studi p ON m.program_studi_id = p.id
            WHERE m.nim = :nim
        ');
        $stmt->execute([':nim' => $nim]);
        $mahasiswa = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return view('mahasiswa', [
            'mahasiswa' => $mahasiswa,
            'nim' => $nim,
            'error' => null,
        ]);
    } catch (\PDOException $e) {
        \Log::error('Koneksi PDO gagal: ' . $e->getMessage());
        return view('mahasiswa', [
            'mahasiswa' => [],
            'nim' => $nim,
            'error' => 'Terjadi kesalahan pada koneksi database.',
        ]);
    }
})->name('mahasiswa.show');
*/

// ============================================
// PERTEMUAN 6 (KODE BARU YANG AKTIF)
// ============================================
Route::get('/mahasiswa', function () {
    try {
        $pdo = DB::connection()->getPdo();

        $pernyataanMahasiswa = $pdo->prepare(
            'SELECT m.nim, m.nama, m.email, m.usia, p.nama AS nama_prodi
             FROM mahasiswa AS m
             JOIN program_studi AS p ON p.id = m.program_studi_id
             ORDER BY m.nim'
        );
        $pernyataanMahasiswa->execute();
        $daftarMahasiswa = $pernyataanMahasiswa->fetchAll(\PDO::FETCH_ASSOC);

        $pernyataanProdi = $pdo->prepare(
            'SELECT id, nama FROM program_studi ORDER BY nama'
        );
        $pernyataanProdi->execute();
        $daftarProgramStudi = $pernyataanProdi->fetchAll(\PDO::FETCH_ASSOC);

        return view('mahasiswa', compact('daftarMahasiswa', 'daftarProgramStudi'));
    } catch (\Throwable $error) {
        report($error);
        return response('Data tidak dapat dibaca. Periksa koneksi dan query.', 500);
    }
})->name('mahasiswa.index');

Route::post('/mahasiswa', function (Request $request) {
    $data = $request->validate([
        'nim' => ['required', 'string', 'max:20'],
        'nama' => ['required', 'string', 'max:100'],
        'email' => ['required', 'email', 'max:100'],
        'usia' => ['required', 'integer', 'min:15', 'max:100'],
        'program_studi_id' => ['required', 'integer'],
    ], [
        'nim.required' => 'NIM wajib diisi.',
        'nama.required' => 'Nama wajib diisi.',
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'usia.required' => 'Usia wajib diisi.',
        'usia.integer' => 'Usia harus berupa angka.',
        'program_studi_id.required' => 'Program studi wajib dipilih.',
    ]);

    try {
        $pdo = DB::connection()->getPdo();

        $cekDuplikat = $pdo->prepare(
            'SELECT COUNT(*) FROM mahasiswa WHERE nim = :nim OR email = :email'
        );
        $cekDuplikat->execute([
            'nim' => $data['nim'],
            'email' => $data['email'],
        ]);

        if ((int) $cekDuplikat->fetchColumn() > 0) {
            return back()->withInput()->with('gagal', 'NIM atau email sudah digunakan.');
        }

        $simpan = $pdo->prepare(
            'INSERT INTO mahasiswa (nim, nama, email, usia, program_studi_id) 
             VALUES (:nim, :nama, :email, :usia, :program_studi_id)'
        );
        $simpan->execute([
            'nim' => $data['nim'],
            'nama' => $data['nama'],
            'email' => $data['email'],
            'usia' => $data['usia'],
            'program_studi_id' => $data['program_studi_id'],
        ]);

        return redirect()->route('mahasiswa.index')->with('berhasil', 'Data mahasiswa berhasil ditambahkan.');
    } catch (\Throwable $error) {
        report($error);
        return back()->withInput()->with('gagal', 'Data gagal disimpan. Periksa koneksi dan data.');
    }
})->name('mahasiswa.store');