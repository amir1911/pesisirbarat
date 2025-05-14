-- Buat database
CREATE DATABASE IF NOT EXISTS registrasi_db1;
USE registrasi_db1;

-- Buat tabel pengguna
CREATE TABLE IF NOT EXISTS pengguna (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_lengkap VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telepon VARCHAR(20) NOT NULL,
    password VARCHAR(255) NOT NULL
);
