<?php
// Test View - Lihat semua data tanpa filter
$host = "localhost";
$db_name = "dbbukutamudigital";
$username = "root";
$password = "";
$table_name = "kunjungans";

$conn = new mysqli($host, $username, $password, $db_name);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT * FROM $table_name ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Test View Data</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background: #4CAF50; color: white; }
        tr:hover { background: #f5f5f5; }
    </style>
</head>
<body>
    <h1>📋 Test View - Semua Data Kunjungan</h1>
    <p>Total data: <?php echo $result->num_rows; ?></p>
    
    <?php if ($result->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Kode Tamu</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Kontak</th>
                <th>Instansi</th>
                <th>Keperluan</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['kode_tamu']; ?></td>
                <td><?php echo $row['tanggal']; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['kontak']; ?></td>
                <td><?php echo $row['instansi']; ?></td>
                <td><?php echo substr($row['keperluan'], 0, 50); ?></td>
                <td><?php echo $row['created_at']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p>Tidak ada data.</p>
    <?php endif; ?>
    
    <?php $conn->close(); ?>
</body>
</html>
```

**Akses file ini:**
```
http://127.0.0.1:8000/test-view-data.php