<?php
require "koneksi.php";

$nama_depan = $_POST['nama_depan'];
$nama_belakang = $_POST['nama_belakang'];
$user_name = $_POST['user_name'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

// Validasi file foto
$nama_file = 'default.png';

if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
    // Validasi tipe file menggunakan finfo
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $tipe_file = $finfo->file($_FILES['foto']['tmp_name']);
    $tipe_diizinkan = ['image/jpeg', 'image/png', 'image/gif'];

    if (!in_array($tipe_file, $tipe_diizinkan)) {
        echo json_encode([
            'status' => 'gagal',
            'pesan' => 'Tipe file tidak diizinkan. Hanya JPEG, PNG, dan GIF.'
        ]);
        exit;
    }

    // Validasi ukuran file (maks 2 MB)
    $ukuran_maks = 2 * 1024 * 1024;
    if ($_FILES['foto']['size'] > $ukuran_maks) {
        echo json_encode([
            'status' => 'gagal',
            'pesan' => 'Ukuran file tidak boleh lebih dari 2 MB'
        ]);
        exit;
    }

    // Proses upload foto
    $ekstensi = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $nama_file = uniqid() . '.' . $ekstensi;
    $tujuan = 'uploads_penulis/' . $nama_file;

    if (!move_uploaded_file($_FILES['foto']['tmp_name'], $tujuan)) {
        echo json_encode([
            'status' => 'gagal',
            'pesan' => 'Foto gagal diunggah'
        ]);
        exit;
    }
}

// Simpan data ke database
$stmt = mysqli_prepare($conn, "INSERT INTO penulis (nama_depan, nama_belakang, user_name, password, foto) VALUES (?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "sssss", $nama_depan, $nama_belakang, $user_name, $password, $nama_file);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode([
        'status' => 'sukses',
        'pesan' => 'Data berhasil disimpan'
    ]);
} else {
    // Hapus file foto jika penyimpanan data gagal
    if ($nama_file !== 'default.png' && file_exists('uploads_penulis/' . $nama_file)) {
        unlink('uploads_penulis/' . $nama_file);
    }
    echo json_encode([
        'status' => 'gagal',
        'pesan' => 'Data gagal disimpan'
    ]);
}