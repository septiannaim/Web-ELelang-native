<?php
include 'koneksi/koneksi.php';

if (isset($_POST['id']) && isset($_POST['namaBarang']) && isset($_POST['deskripsiBarang']) && isset($_POST['hargaAwal']) && isset($_POST['status'])) {
    $id = $_POST['id'];
    $namaBarang = $_POST['namaBarang'];
    $deskripsiBarang = $_POST['deskripsiBarang'];
    $hargaAwal = $_POST['hargaAwal'];
    $status = $_POST['status'];

    $sql = "UPDATE barang SET nama_barang='$namaBarang', deskripsi='$deskripsiBarang', harga_awal='$hargaAwal', status='$status' WHERE id_barang=$id";

    if ($conn->query($sql) === TRUE) {
        $message = "Data barang lelang berhasil diperbarui.";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $message = "Error: Missing required fields.";
}

header("Location: operator/barang_lelang.php?message=" . urlencode($message));
exit();
