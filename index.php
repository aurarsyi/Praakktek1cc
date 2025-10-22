<?php
date_default_timezone_set('Asia/Jakarta');
$file = "mahasiswa.txt";

// Simpan data ke file
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = trim($_POST['nama']);
    $nim = trim($_POST['nim']);
    $prodi = trim($_POST['prodi']);

    if ($nama && $nim && $prodi) {
        $baris = "$nama | $nim | $prodi | " . date("d-m-Y H:i:s") . PHP_EOL;
        file_put_contents($file, $baris, FILE_APPEND);
        $pesan = ["type" => "success", "text" => "✅ Data berhasil disimpan!"];
    } else {
        $pesan = ["type" => "error", "text" => "❌ Semua field wajib diisi!"];
    }
}

$dataMahasiswa = file_exists($file) ? file($file, FILE_IGNORE_NEW_LINES) : [];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Input Data Mahasiswa</title>
  <style>
    * { box-sizing: border-box; }
    body {
      margin: 0;
      font-family: "Segoe UI", Arial, sans-serif;
      background: linear-gradient(120deg, #ff9966, #ff5e62);
      color: #fff;
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
      padding: 30px;
    }
    h1 {
      margin-bottom: 5px;
      text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
    }
    p {
      margin-bottom: 25px;
      font-size: 15px;
      opacity: 0.9;
    }
    form {
      background: rgba(255,255,255,0.15);
      padding: 25px 30px;
      border-radius: 15px;
      width: 320px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }
    label {
      font-weight: bold;
      display: block;
      margin-top: 10px;
    }
    input, select {
      width: 100%;
      padding: 8px;
      border: none;
      border-radius: 8px;
      margin-top: 5px;
    }
    button {
      width: 100%;
      background: #222;
      color: white;
      padding: 10px;
      margin-top: 15px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
      letter-spacing: 0.5px;
    }
    button:hover { background: #333; }
    .msg {
      margin: 15px 0;
      padding: 10px;
      border-radius: 8px;
      width: 320px;
      text-align: center;
    }
    .success { background: rgba(16,185,129,0.8); }
    .error { background: rgba(239,68,68,0.8); }
    table {
      width: 90%;
      max-width: 700px;
      margin-top: 30px;
      border-collapse: collapse;
      background: rgba(255,255,255,0.15);
      border-radius: 12px;
      overflow: hidden;
    }
    th, td {
      padding: 10px;
      border-bottom: 1px solid rgba(255,255,255,0.2);
      text-align: center;
    }
    th {
      background: rgba(255,255,255,0.25);
      font-weight: bold;
    }
    footer {
      margin-top: 40px;
      opacity: 0.8;
      font-size: 0.9em;
    }
  </style>
</head>
<body>
  <h1>📋 Form Input Data Mahasiswa</h1>
  <p>Gunakan form berikut untuk menambahkan data mahasiswa baru.</p>

  <?php if (!empty($pesan)): ?>
    <div class="msg <?= $pesan['type'] ?>"><?= $pesan['text'] ?></div>
  <?php endif; ?>

  <form method="POST">
    <label for="nama">Nama:</label>
    <input type="text" name="nama" id="nama" required>

    <label for="nim">NIM:</label>
    <input type="text" name="nim" id="nim" required>

    <label for="prodi">Program Studi:</label>
    <select name="prodi" id="prodi" required>
      <option value="">-- Pilih Program Studi --</option>
      <option>Informatika</option>
      <option>Sistem Informasi</option>
      <option>Teknik Komputer</option>
      <option>Manajemen</option>
    </select>

    <button type="submit">💾 Simpan Data</button>
  </form>

  <?php if (!empty($dataMahasiswa)): ?>
  <h2>📚 Data Mahasiswa Tersimpan</h2>
  <table>
    <tr>
      <th>Nama</th>
      <th>NIM</th>
      <th>Program Studi</th>
      <th>Waktu</th>
    </tr>
    <?php foreach ($dataMahasiswa as $baris): 
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
  <?php endif; ?>

  <footer>&copy; 2025 Praktikum Komputasi Awan - Oracle Cloud</footer>
</body>
</html>
