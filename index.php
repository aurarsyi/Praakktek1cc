<?php
date_default_timezone_set('Asia/Jakarta');
$file = "data_mahasiswa.txt";

// Simpan data
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = trim($_POST['nama']);
    $nim = trim($_POST['nim']);
    $prodi = trim($_POST['prodi']);

    if ($nama && $nim && $prodi) {
        $data = "$nama | $nim | $prodi | " . date("d-m-Y H:i:s") . PHP_EOL;
        file_put_contents($file, $data, FILE_APPEND);
        $pesan = ["tipe" => "sukses", "teks" => "✅ Data mahasiswa berhasil disimpan!"];
    } else {
        $pesan = ["tipe" => "gagal", "teks" => "⚠️ Semua field wajib diisi!"];
    }
}

$mahasiswa = file_exists($file) ? file($file, FILE_IGNORE_NEW_LINES) : [];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Input Data Mahasiswa</title>
<style>
    * {
        box-sizing: border-box;
    }
    body {
        margin: 0;
        font-family: "Poppins", Arial, sans-serif;
        background: linear-gradient(120deg, #1e3a8a, #0d9488);
        color: #f1f5f9;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
    header {
        text-align: center;
        padding: 20px;
        background: rgba(0,0,0,0.2);
        box-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }
    main {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 30px;
        padding: 40px 20px;
    }
    .form-section, .table-section {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        padding: 25px;
        backdrop-filter: blur(5px);
    }
    .form-section {
        flex: 1 1 280px;
        max-width: 320px;
        display: flex;
        flex-direction: column;
        align-items: stretch;
    }
    label {
        margin-top: 10px;
        font-weight: bold;
    }
    input, select {
        padding: 8px;
        border: none;
        border-radius: 8px;
        margin-top: 5px;
    }
    button {
        margin-top: 20px;
        background-color: #10b981;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s;
    }
    button:hover {
        background-color: #059669;
    }
    .pesan {
        margin-top: 10px;
        padding: 10px;
        border-radius: 8px;
        text-align: center;
        font-weight: bold;
    }
    .sukses {
        background: rgba(16,185,129,0.8);
    }
    .gagal {
        background: rgba(239,68,68,0.8);
    }
    .table-section {
        flex: 2 1 500px;
        overflow-x: auto;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 10px;
        border-bottom: 1px solid rgba(255,255,255,0.2);
        text-align: left;
    }
    th {
        background: rgba(255,255,255,0.2);
    }
    footer {
        text-align: center;
        padding: 15px;
        background: rgba(0,0,0,0.25);
        margin-top: auto;
    }
</style>
</head>
<body>

<header>
    <h1>📘 Aplikasi Input Data Mahasiswa</h1>
    <p>Mahasiswa diminta membuat aplikasi PHP sederhana seperti sistem input data mahasiswa atau buku tamu online.</p>
</header>

<main>
    <section class="form-section">
        <h2>📝 Form Input</h2>
        <?php if (!empty($pesan)): ?>
            <div class="pesan <?= $pesan['tipe'] ?>"><?= $pesan['teks'] ?></div>
        <?php endif; ?>

        <form method="POST">
            <label>Nama:</label>
            <input type="text" name="nama" required>

            <label>NIM:</label>
            <input type="text" name="nim" required>

            <label>Program Studi:</label>
            <select name="prodi" required>
                <option value="">-- Pilih Program Studi --</option>
                <option>Informatika</option>
                <option>Sistem Informasi</option>
                <option>Teknik Komputer</option>
                <option>Manajemen</option>
            </select>

            <button type="submit">💾 Simpan</button>
        </form>
    </section>

    <section class="table-section">
        <h2>📊 Data Mahasiswa</h2>
        <?php if (!empty($mahasiswa)): ?>
        <table>
            <tr>
                <th>Nama</th>
                <th>NIM</th>
                <th>Program Studi</th>
                <th>Waktu Input</th>
            </tr>
            <?php foreach ($mahasiswa as $baris): 
                list($nama, $nim, $prodi, $waktu) = explode(" | ", $baris);
            ?>
            <tr>
                <td><?= htmlspecialchars($nama) ?></td>
                <td><?= htmlspecialchars($nim) ?></td>
                <td><?= htmlspecialchars($prodi) ?></td>
                <td><?= htmlspecialchars($waktu) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php else: ?>
        <p>Belum ada data mahasiswa tersimpan.</p>
        <?php endif; ?>
    </section>
</main>

<footer>
    &copy; 2025 Praktikum Komputasi Awan | Dibuat oleh Mahasiswa
</footer>

</body>
</html>
