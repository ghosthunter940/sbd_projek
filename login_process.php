<?php
session_start(); // Memulai sesi
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ukt_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Simpan data ke dalam sesi
            $_SESSION['user'] = [
                'id' => $row['id'],
                'nama' => $row['nama'],
                'nim' => $row['nim'],
                'fakultas' => $row['fakultas'],
                'jurusan' => $row['jurusan'],
                'ukt' => $row['ukt'],
                'email' => $row['email'],
            ];
            header("Location: banding_ukt.php");
            exit();
        } else {
            echo "Password salah.";
        }
    } else {
        echo "Email tidak ditemukan.";
    }
}

$conn->close();
?>

