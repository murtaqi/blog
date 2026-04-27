<?php
require "koneksi.php";

$id = intval($_GET['id']);
$stmt = mysqli_prepare($conn, "SELECT id, judul, gambar, id_penulis, id_kategori, isi FROM artikel WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    echo json_encode($row);
} else {
    echo json_encode(['status' => 'gagal', 'pesan' => 'Data tidak ditemukan']);
}
