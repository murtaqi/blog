<?php
require "koneksi.php";

// Jika parameter all=1, kembalikan semua data untuk dropdown
if (isset($_GET['all'])) {
    $stmt = mysqli_prepare($conn, "SELECT id, nama_kategori FROM kategori_artikel ORDER BY nama_kategori ASC");
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

// Jika parameter id, kembalikan satu data kategori
$id = intval($_GET['id']);
$stmt = mysqli_prepare($conn, "SELECT id, nama_kategori, keterangan FROM kategori_artikel WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    echo json_encode($row);
} else {
    echo json_encode(['status' => 'gagal', 'pesan' => 'Data tidak ditemukan']);
}
