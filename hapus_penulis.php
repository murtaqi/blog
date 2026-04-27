<?php
require "koneksi.php";

$id = intval($_POST['id']);

// Cek apakah penulis masih memiliki artikel
$stmt_cek = mysqli_prepare($conn, "SELECT COUNT(*) as total FROM artikel WHERE id_penulis = ?");
mysqli_stmt_bind_param($stmt_cek, "i", $id);
mysqli_stmt_execute($stmt_cek);
$cek = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt_cek));

if ($cek['total'] > 0) {
    echo json_encode([
        'status' => 'gagal',
        'pesan' => 'Penulis tidak dapat dihapus karena masih memiliki ' . $cek['total'] . ' artikel.'
    ]);
    exit;
}

// Ambil nama file foto untuk dihapus
$stmt = mysqli_prepare($conn, "SELECT foto FROM penulis WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

// Hapus data dari database
$stmt_del = mysqli_prepare($conn, "DELETE FROM penulis WHERE id = ?");
mysqli_stmt_bind_param($stmt_del, "i", $id);

if (mysqli_stmt_execute($stmt_del)) {
    // Hapus file foto jika bukan default
    if ($row && $row['foto'] !== 'default.png' && file_exists('uploads_penulis/' . $row['foto'])) {
        unlink('uploads_penulis/' . $row['foto']);
    }
    echo json_encode(['status' => 'sukses', 'pesan' => 'Data berhasil dihapus']);
} else {
    echo json_encode(['status' => 'gagal', 'pesan' => 'Data gagal dihapus']);
}
