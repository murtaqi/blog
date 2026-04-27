<?php
require "koneksi.php";

$stmt = mysqli_prepare($conn, "SELECT id, nama_depan, nama_belakang, user_name, password, foto FROM penulis");
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<div class="content-header">
    <h2>Data Penulis</h2>
    <button class="btn-tambah" onclick="formTambahPenulis()">
        <i class="bi bi-plus-lg"></i> Tambah Penulis
    </button>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th>Foto</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Password</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td>
                    <img src="uploads_penulis/<?= htmlspecialchars($row['foto']) ?>" alt="Foto" class="foto-penulis" onerror="this.src='https://via.placeholder.com/45x45?text=IMG'">
                </td>
                <td><?= htmlspecialchars($row['nama_depan'] . ' ' . $row['nama_belakang']) ?></td>
                <td><span class="badge-username"><?= htmlspecialchars($row['user_name']) ?></span></td>
                <td><span class="password-mask"><?= substr($row['password'], 0, 15) ?>...</span></td>
                <td>
                    <div class="aksi-cell">
                        <button class="btn-edit" onclick="formEditPenulis(<?= $row['id'] ?>)">Edit</button>
                        <button class="btn-hapus" onclick="konfirmasiHapus(<?= $row['id'] ?>, 'penulis')">Hapus</button>
                    </div>
                </td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" style="text-align: center; color: #999; padding: 40px;">Belum ada data penulis.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>