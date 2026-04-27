<?php
require "koneksi.php";

$nama_kategori = $_POST['nama_kategori'];
$keterangan = $_POST['keterangan'];

$stmt = mysqli_prepare($conn, "INSERT INTO kategori_artikel (nama_kategori, keterangan) VALUES (?, ?)");
mysqli_stmt_bind_param($stmt, "ss", $nama_kategori, $keterangan);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode(['status' => 'sukses', 'pesan' => 'Kategori berhasil ditambahkan']);
} else {
    echo json_encode(['status' => 'gagal', 'pesan' => 'Kategori gagal ditambahkan']);
}
