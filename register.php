<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "registrasi_db";

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $password = $_POST['password'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    // Validasi password
    if ($password !== $konfirmasi_password) {
        die("Password dan konfirmasi tidak cocok.");
    }

    // Enkripsi password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Simpan ke database
    $stmt = $conn->prepare("INSERT INTO pengguna (nama_lengkap, email, telepon, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nama_lengkap, $email, $telepon, $hashed_password);

    if ($stmt->execute()) {
        // Redirect ke index.html
        header("Location: krui1.html");
        exit(); // Penting untuk menghentikan eksekusi script
    } else {
        echo "Gagal menyimpan data: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
