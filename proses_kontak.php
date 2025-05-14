<?php
// Konfigurasi koneksi ke database
$host     = "localhost";
$username = "root"; // Ganti jika bukan root
$password = "";     // Ganti sesuai password MySQL kamu
$database = "db_kontak"; // Ganti dengan nama database kamu

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$nama   = $_POST['nama'];
$email  = $_POST['email'];
$subjek = $_POST['subjek'];
$pesan  = $_POST['pesan'];

// Simpan ke database
$sql = "INSERT INTO kontak (nama, email, subjek, pesan) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $nama, $email, $subjek, $pesan);

if ($stmt->execute()) {
    echo "Pesan berhasil dikirim!";
} else {
    echo "Terjadi kesalahan: " . $stmt->error;
}

// Tutup koneksi
$stmt->close();
$conn->close();
?>
