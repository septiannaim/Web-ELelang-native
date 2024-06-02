<?php
session_start();
// Pastikan koneksi ke database telah dibuat sebelumnya
include '../koneksi/koneksi.php';

// Periksa apakah bid telah dikirim melalui formulir POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['bid'])) {
    // Tangkap nilai id_barang dari formulir
    $id_barang = $_POST['id_barang'];
    
    // Tangkap nilai penawaran dari formulir
    $penawaran = $_POST['bid'];

    // Lakukan validasi harga penawaran
    if (!empty($penawaran)) {
        // Lakukan penyisipan data ke tabel lelang
        $sql = "INSERT INTO lelang (id_barang, penawaran_tertinggi) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        
        // Bind parameter ke query
        $stmt->bind_param("id", $id_barang, $penawaran);

        // Eksekusi statement
        if ($stmt->execute()) {
            // Jika berhasil disimpan, redirect ke halaman sukses atau ke halaman lainnya
            $_SESSION['success_message'] = "Bid berhasil disimpan.";
            header("Location: dashboard.php");
            exit;
        } else {
            // Jika terjadi kesalahan saat penyimpanan data, tampilkan pesan error
            $_SESSION['error_message'] = "Bid gagal disimpan.";
            header("Location: dashboard.php");
            exit;
        }
    } else {
        // Jika bid kosong, tampilkan pesan kesalahan
        $_SESSION['error_message'] = "Bid tidak boleh kosong.";
        header("Location: dashboard.php");
        exit;
    }

   $conn->close();
}
?>
