-- ============================================
-- Pertemuan 4: Uji Constraint (harus GAGAL)
-- ============================================

USE praktikum_web_2401020165;

-- ============================================
-- TEST 1: NIM Ganda (harus ditolak)
-- NIM 2401020165 sudah dipakai Adhie
-- ============================================
INSERT INTO mahasiswa (nim, nama, email, usia, program_studi_id)
VALUES ('2401020165', 'Coba Duplikat', 'duplikat@example.com', 20, 1);
-- Expected: ERROR 1062 — Duplicate entry '2401020165'

-- ============================================
-- TEST 2: program_studi_id tidak ada (harus ditolak)
-- ID 999 tidak ada di tabel program_studi
-- ============================================
INSERT INTO mahasiswa (nim, nama, email, usia, program_studi_id)
VALUES ('2401029999', 'Coba FK Invalid', 'fk@example.com', 20, 999);
-- Expected: ERROR 1452 — Foreign key constraint fails