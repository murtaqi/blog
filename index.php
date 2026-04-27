<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Blog (CMS)</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* ========== Reset & Base ========== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ========== Header / Navbar ========== */
        .top-navbar {
            background-color: #2c3e50;
            color: white;
            padding: 12px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 3px solid #3498db;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            z-index: 100;
        }

        .top-navbar .nav-icon {
            font-size: 28px;
            opacity: 0.85;
        }

        .top-navbar .nav-title {
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        .top-navbar .nav-subtitle {
            font-size: 12px;
            color: #95a5a6;
            margin-top: 1px;
        }

        /* ========== Layout ========== */
        .main-wrapper {
            display: flex;
            flex: 1;
            min-height: calc(100vh - 58px);
        }

        /* ========== Sidebar ========== */
        .sidebar {
            width: 230px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            padding: 20px 0;
            margin: 28px 0 28px 32px;
            flex-shrink: 0;
            height: fit-content;
        }

        .sidebar-header {
            padding: 0 20px 12px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            color: #95a5a6;
            letter-spacing: 1px;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            padding: 11px 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            color: #555;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }

        .sidebar-menu li:hover {
            background-color: #f0f7ff;
            color: #2980b9;
            border-left-color: #3498db;
        }

        .sidebar-menu li.active {
            background-color: #eaf2fb;
            color: #2980b9;
            font-weight: 600;
            border-left-color: #3498db;
        }

        .sidebar-menu li i {
            font-size: 16px;
            width: 20px;
            text-align: center;
        }

        /* ========== Konten Utama ========== */
        .content-area {
            flex: 1;
            padding: 28px 32px;
            background-color: #f0f2f5;
            overflow-y: auto;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .content-header h2 {
            font-size: 22px;
            font-weight: 700;
            color: #2c3e50;
        }

        /* ========== Tombol ========== */
        .btn-tambah {
            background-color: #27ae60;
            color: white;
            border: none;
            padding: 9px 18px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: background-color 0.2s;
        }

        .btn-tambah:hover {
            background-color: #219a52;
        }

        .btn-edit {
            background-color: #2196F3;
            color: white;
            border: none;
            padding: 5px 14px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-edit:hover {
            background-color: #1976D2;
        }

        .btn-hapus {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 5px 14px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-hapus:hover {
            background-color: #c0392b;
        }

        /* ========== Tabel ========== */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
        }

        .data-table thead th {
            background-color: #fafafa;
            color: #888;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 14px 16px;
            border-bottom: 2px solid #f0f0f0;
            text-align: left;
        }

        .data-table tbody td {
            padding: 12px 16px;
            border-bottom: 1px solid #f5f5f5;
            font-size: 14px;
            color: #333;
            vertical-align: middle;
        }

        .data-table tbody tr:hover {
            background-color: #fcfcfc;
        }

        .data-table tbody tr:last-child td {
            border-bottom: none;
        }

        .foto-penulis {
            width: 45px;
            height: 45px;
            object-fit: cover;
            border-radius: 6px;
            background-color: #eee;
        }

        .badge-username {
            background-color: #e3f2fd;
            color: #1565c0;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .password-mask {
            color: #bbb;
            font-size: 13px;
            letter-spacing: 1px;
        }

        .aksi-cell {
            display: flex;
            gap: 6px;
        }

        /* ========== Modal Overlay ========== */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.45);
            justify-content: center;
            align-items: center;
            z-index: 9999;
            animation: fadeIn 0.2s ease;
        }

        .modal-overlay.show {
            display: flex;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* ========== Modal Box Form ========== */
        .modal-box {
            background: white;
            border-radius: 12px;
            width: 480px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
            animation: slideUp 0.25s ease;
        }

        .modal-box .modal-header-custom {
            padding: 20px 24px 16px;
            border-bottom: 1px solid #f0f0f0;
        }

        .modal-box .modal-header-custom h3 {
            font-size: 18px;
            font-weight: 700;
            color: #2c3e50;
            margin: 0;
        }

        .modal-box .modal-body-custom {
            padding: 20px 24px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #555;
            margin-bottom: 6px;
        }

        .form-group input[type="text"],
        .form-group input[type="password"],
        .form-group input[type="file"],
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            font-family: inherit;
            transition: border-color 0.2s;
            box-sizing: border-box;
            margin: 0;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        .form-row {
            display: flex;
            gap: 12px;
        }

        .form-row .form-group {
            flex: 1;
        }

        .modal-footer-custom {
            padding: 16px 24px 20px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-batal {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 9px 20px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-batal:hover {
            background-color: #5a6268;
        }

        .btn-simpan {
            background-color: #27ae60;
            color: white;
            border: none;
            padding: 9px 20px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-simpan:hover {
            background-color: #219a52;
        }

        /* ========== Modal Konfirmasi Hapus ========== */
        .modal-confirm {
            background: white;
            border-radius: 12px;
            width: 380px;
            text-align: center;
            padding: 32px 28px 24px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
            animation: slideUp 0.25s ease;
        }

        .modal-confirm .icon-hapus {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background-color: #fdecea;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
        }

        .modal-confirm .icon-hapus i {
            font-size: 28px;
            color: #e74c3c;
        }

        .modal-confirm h4 {
            font-size: 18px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .modal-confirm p {
            font-size: 13px;
            color: #888;
            margin-bottom: 24px;
        }

        .modal-confirm .btn-group-confirm {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .btn-ya-hapus {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 9px 22px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-ya-hapus:hover {
            background-color: #c0392b;
        }

        /* ========== Welcome ========== */
        .welcome-box {
            text-align: center;
            padding: 80px 20px;
            color: #888;
        }

        .welcome-box i {
            font-size: 64px;
            color: #ddd;
            margin-bottom: 16px;
        }

        .welcome-box h2 {
            font-size: 24px;
            color: #555;
            margin-bottom: 8px;
        }

        .welcome-box p {
            font-size: 14px;
        }

        /* ========== Responsive ========== */
        @media (max-width: 768px) {
            .main-wrapper {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                margin: 0;
                border-radius: 0;
                box-shadow: none;
                border-right: none;
                border-bottom: 1px solid #e0e0e0;
                padding-top: 10px;
                padding-bottom: 10px;
            }
            .sidebar-menu li {
                padding: 10px 16px;
            }
            .content-area {
                padding: 20px 16px;
            }
            .modal-box {
                width: 95%;
            }
            .modal-confirm {
                width: 90%;
            }
        }
    </style>
</head>
<body>

    <!-- ========== HEADER ========== -->
    <div class="top-navbar">
        <i class="bi bi-grid-3x3-gap-fill nav-icon"></i>
        <div>
            <div class="nav-title">Sistem Manajemen Blog (CMS)</div>
            <div class="nav-subtitle">Blog Keren</div>
        </div>
    </div>

    <!-- ========== MAIN LAYOUT ========== -->
    <div class="main-wrapper">

        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-header">Menu Utama</div>
            <ul class="sidebar-menu" id="sidebarMenu">
                <li onclick="muatKonten('penulis')" data-menu="penulis">
                    <i class="bi bi-people-fill"></i> Kelola Penulis
                </li>
                <li onclick="muatKonten('artikel')" data-menu="artikel">
                    <i class="bi bi-file-earmark-text"></i> Kelola Artikel
                </li>
                <li onclick="muatKonten('kategori')" data-menu="kategori">
                    <i class="bi bi-bookmark-fill"></i> Kelola Kategori
                </li>
            </ul>
        </nav>

        <!-- Konten Utama -->
        <main class="content-area" id="area-konten">
            <div class="welcome-box">
                <i class="bi bi-layout-text-window-reverse"></i>
                <h2>Selamat Datang</h2>
                <p>Silakan pilih menu di samping untuk mengelola data blog Anda.</p>
            </div>
        </main>

    </div>

    <!-- ========== MODAL FORM (Tambah/Edit) ========== -->
    <div class="modal-overlay" id="modalForm">
        <div class="modal-box" id="isiModal">
            <!-- Diisi secara dinamis via JS -->
        </div>
    </div>

    <!-- ========== MODAL KONFIRMASI HAPUS ========== -->
    <div class="modal-overlay" id="modalHapus">
        <div class="modal-confirm">
            <div class="icon-hapus">
                <i class="bi bi-trash3"></i>
            </div>
            <h4>Hapus data ini?</h4>
            <p>Data yang dihapus tidak dapat dikembalikan.</p>
            <div class="btn-group-confirm">
                <button class="btn-batal" onclick="tutupModalHapus()">Batal</button>
                <button class="btn-ya-hapus" id="btnYaHapus">Ya, Hapus</button>
            </div>
        </div>
    </div>

    <!-- ========== JAVASCRIPT ========== -->
    <script>
        // ========== NAVIGASI & KONTEN ==========
        let menuAktif = '';

        function setActiveMenu(menu) {
            document.querySelectorAll('.sidebar-menu li').forEach(li => {
                li.classList.remove('active');
                if (li.getAttribute('data-menu') === menu) {
                    li.classList.add('active');
                }
            });
        }

        function muatKonten(menu) {
            menuAktif = menu;
            setActiveMenu(menu);
            const area = document.getElementById('area-konten');
            area.innerHTML = '<div style="text-align:center;padding:60px;color:#999"><i class="bi bi-arrow-repeat" style="font-size:32px;animation:spin 1s linear infinite"></i><p style="margin-top:12px">Memuat data...</p></div>';

            let targetFile = '';
            if (menu === 'penulis') targetFile = 'ambil_penulis.php';
            else if (menu === 'kategori') targetFile = 'ambil_kategori.php';
            else if (menu === 'artikel') targetFile = 'ambil_artikel.php';

            fetch(targetFile)
                .then(response => response.text())
                .then(data => {
                    area.innerHTML = data;
                })
                .catch(err => {
                    area.innerHTML = "<div style='text-align:center;padding:60px;color:#e74c3c'><i class='bi bi-exclamation-triangle' style='font-size:32px'></i><p style='margin-top:12px'>Gagal memuat data.</p></div>";
                });
        }

        // ========== MODAL FORM ==========
        function bukaModal() {
            document.getElementById('modalForm').classList.add('show');
        }

        function tutupModal() {
            document.getElementById('modalForm').classList.remove('show');
        }

        // ========== MODAL HAPUS ==========
        function tutupModalHapus() {
            document.getElementById('modalHapus').classList.remove('show');
        }

        // ==========================================
        //          PENULIS CRUD
        // ==========================================

        function formTambahPenulis() {
            const modal = document.getElementById('isiModal');
            modal.innerHTML = `
                <div class="modal-header-custom">
                    <h3>Tambah Penulis</h3>
                </div>
                <form id="formPenulis" enctype="multipart/form-data">
                    <div class="modal-body-custom">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Nama Depan</label>
                                <input type="text" name="nama_depan" required>
                            </div>
                            <div class="form-group">
                                <label>Nama Belakang</label>
                                <input type="text" name="nama_belakang" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="user_name" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label>Foto Profil</label>
                            <input type="file" name="foto" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer-custom">
                        <button type="button" class="btn-batal" onclick="tutupModal()">Batal</button>
                        <button type="submit" class="btn-simpan">Simpan Data</button>
                    </div>
                </form>
            `;
            bukaModal();

            document.getElementById('formPenulis').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                fetch('simpan_penulis.php', {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'sukses') {
                        tutupModal();
                        muatKonten('penulis');
                    } else {
                        alert(data.pesan || 'Gagal menyimpan data');
                    }
                })
                .catch(err => alert('Terjadi kesalahan'));
            });
        }

        function formEditPenulis(id) {
            fetch('ambil_satu_penulis.php?id=' + id)
                .then(res => res.json())
                .then(data => {
                    const modal = document.getElementById('isiModal');
                    modal.innerHTML = `
                        <div class="modal-header-custom">
                            <h3>Edit Penulis</h3>
                        </div>
                        <form id="formEditPenulis" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="${data.id}">
                            <div class="modal-body-custom">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label>Nama Depan</label>
                                        <input type="text" name="nama_depan" value="${data.nama_depan}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Belakang</label>
                                        <input type="text" name="nama_belakang" value="${data.nama_belakang}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="user_name" value="${data.user_name}" required>
                                </div>
                                <div class="form-group">
                                    <label>Password Baru (kosongkan jika tidak diganti)</label>
                                    <input type="password" name="password">
                                </div>
                                <div class="form-group">
                                    <label>Foto Profil (kosongkan jika tidak diganti)</label>
                                    <input type="file" name="foto" accept="image/*">
                                </div>
                            </div>
                            <div class="modal-footer-custom">
                                <button type="button" class="btn-batal" onclick="tutupModal()">Batal</button>
                                <button type="submit" class="btn-simpan">Simpan Perubahan</button>
                            </div>
                        </form>
                    `;
                    bukaModal();

                    document.getElementById('formEditPenulis').addEventListener('submit', function(e) {
                        e.preventDefault();
                        const formData = new FormData(this);
                        fetch('update_penulis.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(res => res.json())
                        .then(result => {
                            if (result.status === 'sukses') {
                                tutupModal();
                                muatKonten('penulis');
                            } else {
                                alert(result.pesan || 'Gagal mengupdate data');
                            }
                        })
                        .catch(err => alert('Terjadi kesalahan'));
                    });
                })
                .catch(err => alert('Gagal mengambil data penulis'));
        }

        // ==========================================
        //          KATEGORI CRUD
        // ==========================================

        function formTambahKategori() {
            const modal = document.getElementById('isiModal');
            modal.innerHTML = `
                <div class="modal-header-custom">
                    <h3>Tambah Kategori</h3>
                </div>
                <form id="formKategori">
                    <div class="modal-body-custom">
                        <div class="form-group">
                            <label>Nama Kategori</label>
                            <input type="text" name="nama_kategori" placeholder="Nama kategori..."required>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="keterangan" rows="3" placeholder="Deskripsi kategori..."required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer-custom">
                        <button type="button" class="btn-batal" onclick="tutupModal()">Batal</button>
                        <button type="submit" class="btn-simpan">Simpan Data</button>
                    </div>
                </form>
            `;
            bukaModal();

            document.getElementById('formKategori').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                fetch('simpan_kategori.php', {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'sukses') {
                        tutupModal();
                        muatKonten('kategori');
                    } else {
                        alert(data.pesan || 'Gagal menyimpan data');
                    }
                })
                .catch(err => alert('Terjadi kesalahan'));
            });
        }

        function formEditKategori(id) {
            fetch('ambil_satu_kategori.php?id=' + id)
                .then(res => res.json())
                .then(data => {
                    const modal = document.getElementById('isiModal');
                    modal.innerHTML = `
                        <div class="modal-header-custom">
                            <h3>Edit Kategori</h3>
                        </div>
                        <form id="formEditKategori">
                            <input type="hidden" name="id" value="${data.id}">
                            <div class="modal-body-custom">
                                <div class="form-group">
                                    <label>Nama Kategori</label>
                                    <input type="text" name="nama_kategori" value="${escapeHtml(data.nama_kategori)}" required>
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" rows="3" required>${escapeHtml(data.keterangan)}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer-custom">
                                <button type="button" class="btn-batal" onclick="tutupModal()">Batal</button>
                                <button type="submit" class="btn-simpan">Simpan Perubahan</button>
                            </div>
                        </form>
                    `;
                    bukaModal();

                    document.getElementById('formEditKategori').addEventListener('submit', function(e) {
                        e.preventDefault();
                        const formData = new FormData(this);
                        fetch('update_kategori.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(res => res.json())
                        .then(result => {
                            if (result.status === 'sukses') {
                                tutupModal();
                                muatKonten('kategori');
                            } else {
                                alert(result.pesan || 'Gagal mengupdate data');
                            }
                        })
                        .catch(err => alert('Terjadi kesalahan'));
                    });
                })
                .catch(err => alert('Gagal mengambil data kategori'));
        }


        // ==========================================
        //          ARTIKEL CRUD
        // ==========================================

        function formTambahArtikel() {
            const modal = document.getElementById('isiModal');
            modal.innerHTML = `
                <div class="modal-header-custom">
                    <h3>Tambah Artikel</h3>
                </div>
                <form id="formArtikel" enctype="multipart/form-data">
                    <div class="modal-body-custom">
                        <div class="form-group">
                            <label>Judul Artikel</label>
                            <input type="text" name="judul" placeholder="Judul artikel..." required>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Penulis</label>
                                <select name="id_penulis" id="selectPenulis" required>
                                    <option value="">Memuat...</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kategori</label>
                                <select name="id_kategori" id="selectKategori" required>
                                    <option value="">Memuat...</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Isi Artikel</label>
                            <textarea name="isi" rows="5" placeholder="Tulis isi artikel di sini..." required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" name="gambar" accept="image/*" required>
                        </div>
                    </div>
                    <div class="modal-footer-custom">
                        <button type="button" class="btn-batal" onclick="tutupModal()">Batal</button>
                        <button type="submit" class="btn-simpan">Simpan Data</button>
                    </div>
                </form>
            `;
            bukaModal();
            muatDropdown();

            document.getElementById('formArtikel').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                fetch('simpan_artikel.php', {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'sukses') {
                        tutupModal();
                        muatKonten('artikel');
                    } else {
                        alert(data.pesan || 'Gagal menyimpan data');
                    }
                })
                .catch(err => alert('Terjadi kesalahan'));
            });
        }

        function formEditArtikel(id) {
            fetch('ambil_satu_artikel.php?id=' + id)
                .then(res => res.json())
                .then(data => {
                    const modal = document.getElementById('isiModal');
                    modal.innerHTML = `
                        <div class="modal-header-custom">
                            <h3>Edit Artikel</h3>
                        </div>
                        <form id="formEditArtikel" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="${data.id}">
                            <div class="modal-body-custom">
                                <div class="form-group">
                                    <label>Judul Artikel</label>
                                    <input type="text" name="judul" value="${escapeHtml(data.judul)}" required>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label>Penulis</label>
                                        <select name="id_penulis" id="selectPenulis" required>
                                            <option value="">Memuat...</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <select name="id_kategori" id="selectKategori" required>
                                            <option value="">Memuat...</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                <label>Isi Artikel</label>
                                <textarea name="isi" rows="5" required>${escapeHtml(data.isi)}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Gambar Artikel (kosongkan jika tidak diganti)</label>
                                    <input type="file" name="gambar" accept="image/*">
                                </div>
                            </div>
                            <div class="modal-footer-custom">
                                <button type="button" class="btn-batal" onclick="tutupModal()">Batal</button>
                                <button type="submit" class="btn-simpan">Simpan Perubahan</button>
                            </div>
                        </form>
                    `;
                    bukaModal();
                    muatDropdown(data.id_penulis, data.id_kategori);

                    document.getElementById('formEditArtikel').addEventListener('submit', function(e) {
                        e.preventDefault();
                        const formData = new FormData(this);
                        fetch('update_artikel.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(res => res.json())
                        .then(result => {
                            if (result.status === 'sukses') {
                                tutupModal();
                                muatKonten('artikel');
                            } else {
                                alert(result.pesan || 'Gagal mengupdate data');
                            }
                        })
                        .catch(err => alert('Terjadi kesalahan'));
                    });
                })
                .catch(err => alert('Gagal mengambil data artikel'));
        }

        // Muat dropdown penulis & kategori via JSON endpoint
        function muatDropdown(selectedPenulis = null, selectedKategori = null) {
            // Muat penulis
            fetch('ambil_satu_penulis.php?all=1')
                .then(res => res.json())
                .then(data => {
                    const select = document.getElementById('selectPenulis');
                    select.innerHTML = '<option value="">-- Pilih Penulis --</option>';
                    data.forEach(item => {
                        const selected = (selectedPenulis && item.id == selectedPenulis) ? 'selected' : '';
                        select.innerHTML += `<option value="${item.id}" ${selected}>${escapeHtml(item.nama_depan + ' ' + item.nama_belakang)}</option>`;
                    });
                });

            // Muat kategori
            fetch('ambil_satu_kategori.php?all=1')
                .then(res => res.json())
                .then(data => {
                    const select = document.getElementById('selectKategori');
                    select.innerHTML = '<option value="">-- Pilih Kategori --</option>';
                    data.forEach(item => {
                        const selected = (selectedKategori && item.id == selectedKategori) ? 'selected' : '';
                        select.innerHTML += `<option value="${item.id}" ${selected}>${escapeHtml(item.nama_kategori)}</option>`;
                    });
                });
        }

        // ==========================================
        //          UTILITAS
        // ==========================================

        // Helper untuk escape HTML di template literal
        function escapeHtml(text) {
            if (!text) return '';
            const div = document.createElement('div');
            div.appendChild(document.createTextNode(text));
            return div.innerHTML;
        }

        // ==========================================
        //          HAPUS (SEMUA MODUL)
        // ==========================================

        function konfirmasiHapus(id, tipe) {
            document.getElementById('modalHapus').classList.add('show');
            document.getElementById('btnYaHapus').onclick = function() {
                let url = '';
                if (tipe === 'penulis') url = 'hapus_penulis.php';
                else if (tipe === 'kategori') url = 'hapus_kategori.php';
                else if (tipe === 'artikel') url = 'hapus_artikel.php';

                fetch(url, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'id=' + id
                })
                .then(res => res.json())
                .then(data => {
                    tutupModalHapus();
                    if (data.status === 'sukses') {
                        muatKonten(tipe);
                    } else {
                        alert(data.pesan || 'Gagal menghapus data');
                    }
                })
                .catch(err => {
                    tutupModalHapus();
                    alert('Terjadi kesalahan');
                });
            };
        }

        // Tutup modal jika klik di luar
        document.getElementById('modalForm').addEventListener('click', function(e) {
            if (e.target === this) tutupModal();
        });
        document.getElementById('modalHapus').addEventListener('click', function(e) {
            if (e.target === this) tutupModalHapus();
        });

        // Muat halaman penulis otomatis saat pertama kali
        window.onload = function() {
            muatKonten('penulis');
        };
    </script>

</body>
</html>