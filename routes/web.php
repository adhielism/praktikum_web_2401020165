<?php

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

// Form mahasiswa — GET (tampilkan form)
Route::get('/mahasiswa/create', function () {
    return view('mahasiswa-form');
})->name('mahasiswa.create');

// Form mahasiswa — POST (proses form)
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