<?php
require "koneksi.php";

$id = intval($_POST['id']);

// Ambil nama file gambar untuk dihapus
$stmt = mysqli_prepare($conn, "SELECT gambar FROM artikel WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

// Hapus data dari database
$stmt_del = mysqli_prepare($conn, "DELETE FROM artikel WHERE id = ?");
mysqli_stmt_bind_param($stmt_del, "i", $id);

if (mysqli_stmt_execute($stmt_del)) {
    // Hapus file gambar dari server
    if ($row && $row['gambar'] && file_exists('uploads_artikel/' . $row['gambar'])) {
        unlink('uploads_artikel/' . $row['gambar']);
    }
    echo json_encode(['status' => 'sukses', 'pesan' => 'Artikel berhasil dihapus']);
} else {
    echo json_encode(['status' => 'gagal', 'pesan' => 'Artikel gagal dihapus']);
}
