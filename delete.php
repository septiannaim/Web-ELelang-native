<?php
include 'koneksi/koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM barang WHERE id_barang=$id";

    if ($conn->query($sql) === TRUE) {
        $message = "Data barang lelang berhasil dihapus.";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $message = "Error: Missing required fields.";
}

header("Location: operator/barang_lelang.php?message=" . urlencode($message));
exit();
?>
