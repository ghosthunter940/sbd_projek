<?php
session_start();
include 'db.php';

// Jika pengguna belum login, arahkan ke halaman login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Ambil data pengguna dari sesi
$user = $_SESSION['user'];
$user_id = $user['id'];

// Proses pengajuan banding
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $alasan = $_POST['alasan'];
    $dokumen_pendukung = $_FILES['dokumen']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($dokumen_pendukung);

    // Simpan file yang diunggah
    if (move_uploaded_file($_FILES['dokumen']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO banding_ukt (user_id, alasan, dokumen_pendukung) 
                VALUES ('$user_id', '$alasan', '$dokumen_pendukung')";
        if ($conn->query($sql) === TRUE) {
            $success_message = "Pengajuan banding berhasil diajukan!";
        } else {
            $error_message = "Gagal mengajukan banding: " . $conn->error;
        }
    } else {
        $error_message = "Gagal mengunggah dokumen.";
    }
}

// Ambil data banding pengguna
$sql = "SELECT * FROM banding_ukt WHERE user_id = '$user_id'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banding UKT</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        textarea, input[type="file"], input[type="submit"] {
            display: block;
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Banding UKT</h1>
        <p><strong>Nama:</strong> <?php echo $user['nama']; ?></p>
        <p><strong>NIM:</strong> <?php echo $user['nim']; ?></p>
        <p><strong>Fakultas:</strong> <?php echo $user['fakultas']; ?></p>
        <p><strong>Jurusan:</strong> <?php echo $user['jurusan']; ?></p>
        <p><strong>UKT:</strong> <?php echo $user['ukt']; ?></p>

        <?php if (isset($success_message)) echo "<p class='success'>$success_message</p>"; ?>
        <?php if (isset($error_message)) echo "<p class='error'>$error_message</p>"; ?>

        <h2>Ajukan Banding</h2>
        <form method="POST" enctype="multipart/form-data">
            <textarea name="alasan" placeholder="Alasan pengajuan banding" required></textarea>
            <input type="file" name="dokumen" required>
            <input type="submit" value="Ajukan Banding">
        </form>

        <h2>Riwayat Banding UKT</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Alasan</th>
                    <th>Dokumen</th>
                    <th>Status</th>
                    <th>Tanggal Pengajuan</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['alasan']; ?></td>
                            <td>
                                <a href="uploads/<?php echo $row['dokumen_pendukung']; ?>" target="_blank">
                                    <?php echo $row['dokumen_pendukung']; ?>
                                </a>
                            </td>
                            <td><?php echo $row['status']; ?></td>
                            <td><?php echo $row['tanggal_pengajuan']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Belum ada pengajuan banding.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php $conn->close(); ?>
