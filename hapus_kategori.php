<?php
require "koneksi.php";

$id = intval($_POST['id']);

// Cek apakah kategori masih memiliki artikel
$stmt_cek = mysqli_prepare($conn, "SELECT COUNT(*) as total FROM artikel WHERE id_kategori = ?");
mysqli_stmt_bind_param($stmt_cek, "i", $id);
mysqli_stmt_execute($stmt_cek);
$cek = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt_cek));

if ($cek['total'] > 0) {
    echo json_encode([
        'status' => 'gagal',
        'pesan' => 'Kategori tidak dapat dihapus karena masih memiliki ' . $cek['total'] . ' artikel.'
    ]);
    exit;
}

$stmt = mysqli_prepare($conn, "DELETE FROM kategori_artikel WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode(['status' => 'sukses', 'pesan' => 'Kategori berhasil dihapus']);
} else {
    echo json_encode(['status' => 'gagal', 'pesan' => 'Kategori gagal dihapus']);
}
