<?php
require "koneksi.php";

$judul = $_POST['judul'];
$id_penulis = $_POST['id_penulis'];
$id_kategori = $_POST['id_kategori'];
$isi = $_POST['isi'];

// Validasi file gambar
$nama_file = '';

if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
    // Validasi tipe file menggunakan finfo
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $tipe_file = $finfo->file($_FILES['gambar']['tmp_name']);
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
    if ($_FILES['gambar']['size'] > $ukuran_maks) {
        echo json_encode([
            'status' => 'gagal',
            'pesan' => 'Ukuran file tidak boleh lebih dari 2 MB'
        ]);
        exit;
    }

    // Proses upload gambar
    $ekstensi = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
    $nama_file = uniqid() . '.' . $ekstensi;
    $tujuan = 'uploads_artikel/' . $nama_file;
    
    if (!is_dir('uploads_artikel')) {
        mkdir('uploads_artikel', 0777, true);
    }

    if (!move_uploaded_file($_FILES['gambar']['tmp_name'], $tujuan)) {
        echo json_encode([
            'status' => 'gagal',
            'pesan' => 'Gambar gagal diunggah'
        ]);
        exit;
    }
} else {
    echo json_encode([
        'status' => 'gagal',
        'pesan' => 'Gambar wajib diunggah'
    ]);
    exit;
}

// Simpan data ke database
$stmt = mysqli_prepare($conn, "INSERT INTO artikel (judul, id_penulis, id_kategori, isi, gambar) VALUES (?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "siiss", $judul, $id_penulis, $id_kategori, $isi, $nama_file);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode([
        'status' => 'sukses',
        'pesan' => 'Data berhasil disimpan'
    ]);
} else {
    if (file_exists('uploads_artikel/' . $nama_file)) {
        unlink('uploads_artikel/' . $nama_file);
    }
    echo json_encode([
        'status' => 'gagal',
        'pesan' => 'Data gagal disimpan'
    ]);
}
?>