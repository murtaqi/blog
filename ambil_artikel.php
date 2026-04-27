<?php
require "koneksi.php";

$stmt = mysqli_prepare($conn, "SELECT a.id, a.judul, a.gambar, a.hari_tanggal, 
    CONCAT(p.nama_depan, ' ', p.nama_belakang) AS nama_penulis, 
    k.nama_kategori 
    FROM artikel a 
    LEFT JOIN penulis p ON a.id_penulis = p.id 
    LEFT JOIN kategori_artikel k ON a.id_kategori = k.id 
    ORDER BY a.id DESC");
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<div class="content-header">
    <h2>Data Artikel</h2>
    <button class="btn-tambah" onclick="formTambahArtikel()">
        <i class="bi bi-plus-lg"></i> Tambah Artikel
    </button>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th>Gambar</th>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Penulis</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td>
                    <img src="uploads_artikel/<?= htmlspecialchars($row['gambar']) ?>" alt="Gambar" class="foto-penulis" onerror="this.src='https://via.placeholder.com/45x45?text=IMG'">
                </td>
                <td><?= htmlspecialchars($row['judul']) ?></td>
                <td><span class="badge-username"><?= htmlspecialchars($row['nama_kategori']) ?></span></td>
                <td><?= htmlspecialchars($row['nama_penulis']) ?></td>
                <td style="font-size:12px; color:#777;"><?= htmlspecialchars($row['hari_tanggal']) ?></td>
                <td>
                    <div class="aksi-cell">
                        <button class="btn-edit" onclick="formEditArtikel(<?= $row['id'] ?>)">Edit</button>
                        <button class="btn-hapus" onclick="konfirmasiHapus(<?= $row['id'] ?>, 'artikel')">Hapus</button>
                    </div>
                </td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align: center; color: #999; padding: 40px;">Belum ada data artikel.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
