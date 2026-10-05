-- ============================================
-- Pertemuan 4: Data & Manipulasi
-- ============================================

USE praktikum_web_2401020165;

-- ============================================
-- 1. INSERT program_studi (3 data)
-- ============================================
INSERT INTO program_studi (kode, nama, fakultas) VALUES
('TI', 'Teknik Informatika', 'Fakultas Teknik dan Teknologi Kemaritiman'),
('SI', 'Sistem Informasi',   'Fakultas Teknik dan Teknologi Kemaritiman'),
('TK', 'Teknik Komputer',    'Fakultas Teknik dan Teknologi Kemaritiman');

SELECT * FROM program_studi;

-- ============================================
-- 2. INSERT mahasiswa (4 data tetap + 1 sementara)
-- ============================================
INSERT INTO mahasiswa (nim, nama, email, usia, program_studi_id) VALUES
('2401020165', 'Adhie Mulia Sembiring', 'adhie@example.com', 22, 1),
('2401020001', 'Budi Santoso',          'budi@example.com',  21, 1),
('2401020002', 'Citra Dewi Lestari',    'citra@example.com', 20, 2),
('2401020003', 'Dani Pratama',          'dani@example.com',  23, 3);

INSERT INTO mahasiswa (nim, nama, email, usia, program_studi_id) VALUES
('9999999999', 'Data Sementara',        'sementara@example.com', 25, 1);

SELECT * FROM mahasiswa;

-- ============================================
-- 3. UPDATE — Ubah usia Budi jadi 22
-- ============================================
UPDATE mahasiswa SET usia = 22 WHERE nim = '2401020001';

SELECT * FROM mahasiswa WHERE nim = '2401020001';

-- ============================================
-- 4. DELETE — Hapus data sementara
-- ============================================
DELETE FROM mahasiswa WHERE nim = '9999999999';

SELECT COUNT(*) AS total_mahasiswa FROM mahasiswa;

-- ============================================
-- 5. SELECT JOIN — Tampilkan 3 mahasiswa tersisa
-- ============================================
SELECT
  m.nim,
  m.nama,
  m.email,
  m.usia,
  p.kode AS kode_prodi,
  p.nama AS nama_prodi
FROM mahasiswa m
INNER JOIN program_studi p ON m.program_studi_id = p.id
ORDER BY m.nim;