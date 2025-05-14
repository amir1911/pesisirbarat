<?php
session_start();

// Cek apakah form dikirim dengan metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Koneksi ke database
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "registrasi_db";

    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Ambil data dari form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Cari pengguna berdasarkan email
    $stmt = $conn->prepare("SELECT * FROM pengguna WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Cek apakah user ditemukan
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Simpan session
            $_SESSION['user'] = $user;
            header("Location: krui1.html"); // Redirect ke halaman utama
            exit();
        } else {
            echo "Kata sandi salah.";
        }
    } else {
        echo "Email tidak ditemukan.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Metode tidak diizinkan.";
}
?>
