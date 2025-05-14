<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "registrasi_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT * FROM pengguna";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pengguna</title>

    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        .container {
            background: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h2 {
            color: #0d6efd;
            margin-bottom: 25px;
            font-weight: 600;
        }
        .table thead {
            background-color: #0d6efd;
            color: #ffffff;
        }
        .table td, .table th {
            vertical-align: middle;
        }
    </style>
</head>
<body class="py-5">
    <div class="container">
        <h2 class="text-center">Daftar Pengguna Terdaftar</h2>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Telepon</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row["id"]}</td>
                                    <td>{$row["nama_lengkap"]}</td>
                                    <td>{$row["email"]}</td>
                                    <td>{$row["telepon"]}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' class='text-center text-muted'>Belum ada pengguna terdaftar.</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
