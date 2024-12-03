<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ukt_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $fakultas = $_POST['fakultas'];
    $jurusan = $_POST['jurusan'];
    $ukt = $_POST['ukt'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (nama, nim, fakultas, jurusan, ukt, email, password)
            VALUES ('$nama', '$nim', '$fakultas', '$jurusan', $ukt, '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registrasi berhasil. Silakan <a href='login.php'>login</a>.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
