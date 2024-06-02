<?php
include 'koneksi/koneksi.php';

// Tangkap data yang diunggah dari formulir
$namaBarang = $_POST['namaBarang'];
$deskripsiBarang = $_POST['deskripsiBarang'];
$hargaAwal = $_POST['hargaAwal'];

// Unggah foto barang
$targetDir = "uploads/"; // Folder tempat menyimpan foto
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}
$namaFoto = basename($_FILES["fotoBarang"]["name"]);
$targetPath = $targetDir . $namaFoto;

if (move_uploaded_file($_FILES["fotoBarang"]["tmp_name"], $targetPath)) {
    // Masukkan data ke dalam tabel database
    $sql = "INSERT INTO barang (nama_barang, deskripsi, harga_awal, foto) 
            VALUES ('$namaBarang', '$deskripsiBarang', '$hargaAwal', '$namaFoto')";
    if ($conn->query($sql) === TRUE) {
        $message = "Data barang lelang berhasil ditambahkan.";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $message = "Error: Gagal mengunggah file.";
}

// Redirect back to the form page with the message
header("Location: operator/dashboard.php?message=" . urlencode($message));
exit;
?>
