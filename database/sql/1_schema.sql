-- ============================================
-- Pertemuan 4: Skema Basis Data
-- Database: praktikum_web_2401020165
-- ============================================

DROP DATABASE IF EXISTS praktikum_web_2401020165;
CREATE DATABASE praktikum_web_2401020165
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE praktikum_web_2401020165;

-- ============================================
-- Tabel: program_studi
-- ============================================
CREATE TABLE program_studi (
  id        INT AUTO_INCREMENT PRIMARY KEY,
  kode      VARCHAR(10)  NOT NULL UNIQUE,
  nama      VARCHAR(100) NOT NULL,
  fakultas  VARCHAR(100) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================
-- Tabel: mahasiswa
-- ============================================
CREATE TABLE mahasiswa (
  id                INT AUTO_INCREMENT PRIMARY KEY,
  nim               VARCHAR(12)  NOT NULL UNIQUE,
  nama              VARCHAR(100) NOT NULL,
  email             VARCHAR(100) NOT NULL UNIQUE,
  usia              INT          NOT NULL CHECK (usia >= 15 AND usia <= 100),
  program_studi_id  INT          NOT NULL,
  created_at        TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_mahasiswa_prodi
    FOREIGN KEY (program_studi_id) REFERENCES program_studi(id)
    ON DELETE RESTRICT
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ============================================
-- Cek struktur
-- ============================================
SHOW TABLES;
DESCRIBE program_studi;
DESCRIBE mahasiswa;