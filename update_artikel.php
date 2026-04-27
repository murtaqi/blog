<?php
require "koneksi.php";

$id = intval($_POST['id']);
$judul = $_POST['judul'];
$id_penulis = intval($_POST['id_penulis']);
$id_kategori = intval($_POST['id_kategori']);
$isi = $_POST['isi'];

// Ambil data lama
$stmt_old = mysqli_prepare($conn, "SELECT gambar FROM artikel WHERE id = ?");
mysqli_stmt_bind_param($stmt_old, "i", $id);
mysqli_stmt_execute($stmt_old);
$old = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt_old));

// Update hari_tanggal saat diedit
date_default_timezone_set('Asia/Jakarta');
$hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
$bulan = [
    1=>'Januari', 2=>'Februari', 3=>'Maret',
    4=>'April', 5=>'Mei', 6=>'Juni',
    7=>'Juli', 8=>'Agustus', 9=>'September',
    10=>'Oktober',11=>'November',12=>'Desember'
];
$sekarang = new DateTime();
$nama_hari = $hari[$sekarang->format('w')];
$tanggal = $sekarang->format('j');
$nama_bulan = $bulan[(int)$sekarang->format('n')];
$tahun = $sekarang->format('Y');
$jam = $sekarang->format('H:i');
$hari_tanggal = "$nama_hari, $tanggal $nama_bulan $tahun | $jam";

// Gambar: jika diupload maka ganti, jika tidak pakai yang lama
$nama_file = $old['gambar'];
if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
    // Validasi tipe file menggunakan finfo
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $tipe_file = $finfo->file($_FILES['gambar']['tmp_name']);
    $tipe_diizinkan = ['image/jpeg', 'image/png', 'image/gif'];

    if (!in_array($tipe_file, $tipe_diizinkan)) {
        echo json_encode(['status' => 'gagal', 'pesan' => 'Tipe file tidak diizinkan. Hanya JPEG, PNG, dan GIF.']);
        exit;
    }

    $ukuran_maks = 2 * 1024 * 1024;
    if ($_FILES['gambar']['size'] > $ukuran_maks) {
        echo json_encode(['status' => 'gagal', 'pesan' => 'Ukuran file tidak boleh lebih dari 2 MB']);
        exit;
    }

    $ekstensi = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
    $nama_file = uniqid() . '.' . $ekstensi;
    $tujuan = 'uploads_artikel/' . $nama_file;

    if (!move_uploaded_file($_FILES['gambar']['tmp_name'], $tujuan)) {
        echo json_encode(['status' => 'gagal', 'pesan' => 'Gambar gagal diunggah']);
        exit;
    }

    // Hapus gambar lama
    if ($old['gambar'] && file_exists('uploads_artikel/' . $old['gambar'])) {
        unlink('uploads_artikel/' . $old['gambar']);
    }
}

$stmt = mysqli_prepare($conn, "UPDATE artikel SET judul=?, gambar=?, id_penulis=?, id_kategori=?, hari_tanggal=?, isi=? WHERE id=?");
mysqli_stmt_bind_param($stmt, "ssiissi", $judul, $nama_file, $id_penulis, $id_kategori, $hari_tanggal, $isi, $id);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode(['status' => 'sukses', 'pesan' => 'Artikel berhasil diperbarui']);
} else {
    echo json_encode(['status' => 'gagal', 'pesan' => 'Artikel gagal diperbarui']);
}
