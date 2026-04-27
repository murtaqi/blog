<?php
require "koneksi.php";

$stmt = mysqli_prepare($conn, "SELECT id, nama_kategori, keterangan FROM kategori_artikel");
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<div class="content-header">
    <h2>Data Kategori Artikel</h2>
    <button class="btn-tambah" onclick="formTambahKategori()">
        <i class="bi bi-plus-lg"></i> Tambah Kategori
    </button>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th>Nama Kategori</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><span class="badge-username"><?= htmlspecialchars($row['nama_kategori']) ?></span></td>
                <td><?= htmlspecialchars($row['keterangan']) ?></td>
                <td>
                    <div class="aksi-cell">
                        <button class="btn-edit" onclick="formEditKategori(<?= $row['id'] ?>)">Edit</button>
                        <button class="btn-hapus" onclick="konfirmasiHapus(<?= $row['id'] ?>, 'kategori')">Hapus</button>
                    </div>
                </td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="3" style="text-align: center; color: #999; padding: 40px;">Belum ada data kategori.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
