<?php
require "koneksi.php";

$id = $_POST['id'];
$nama_depan = $_POST['nama_depan'];
$nama_belakang = $_POST['nama_belakang'];
$user_name = $_POST['user_name'];
$password = $_POST['password'] ?? '';

// Ambil data penulis yang ada saat ini untuk mendapatkan foto lama
$stmt = mysqli_prepare($conn, "SELECT foto FROM penulis WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$penulis = mysqli_fetch_assoc($result);

$nama_file = $penulis['foto'];

// Proses upload foto jika ada
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $tipe_file = $finfo->file($_FILES['foto']['tmp_name']);
    $tipe_diizinkan = ['image/jpeg', 'image/png', 'image/gif'];

    if (!in_array($tipe_file, $tipe_diizinkan)) {
        echo json_encode(['status' => 'gagal', 'pesan' => 'Tipe file tidak diizinkan. Hanya JPEG, PNG, dan GIF.']);
        exit;
    }

    if ($_FILES['foto']['size'] > 2 * 1024 * 1024) {
        echo json_encode(['status' => 'gagal', 'pesan' => 'Ukuran file tidak boleh lebih dari 2 MB']);
        exit;
    }

    $ekstensi = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $nama_file_baru = uniqid() . '.' . $ekstensi;
    $tujuan = 'uploads_penulis/' . $nama_file_baru;

    if (!is_dir('uploads_penulis')) {
        mkdir('uploads_penulis', 0777, true);
    }

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $tujuan)) {
        // Hapus foto lama jika bukan default.png dan file exists
        if ($nama_file !== 'default.png' && file_exists('uploads_penulis/' . $nama_file)) {
            unlink('uploads_penulis/' . $nama_file);
        }
        $nama_file = $nama_file_baru;
    } else {
        echo json_encode(['status' => 'gagal', 'pesan' => 'Foto gagal diunggah']);
        exit;
    }
}

// Update Database
if (!empty($password)) {
    $password_hashed = password_hash($password, PASSWORD_BCRYPT);
    $stmt = mysqli_prepare($conn, "UPDATE penulis SET nama_depan=?, nama_belakang=?, user_name=?, password=?, foto=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "sssssi", $nama_depan, $nama_belakang, $user_name, $password_hashed, $nama_file, $id);
} else {
    $stmt = mysqli_prepare($conn, "UPDATE penulis SET nama_depan=?, nama_belakang=?, user_name=?, foto=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "ssssi", $nama_depan, $nama_belakang, $user_name, $nama_file, $id);
}

if (mysqli_stmt_execute($stmt)) {
    echo json_encode(['status' => 'sukses', 'pesan' => 'Data berhasil diupdate']);
} else {
    echo json_encode(['status' => 'gagal', 'pesan' => 'Data gagal diupdate']);
}
?>