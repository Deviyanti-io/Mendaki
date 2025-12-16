<?php
session_start();

// Cek jika data pendaftaran belum ada
if (!isset($_SESSION['pendaftaran'])) {
    echo "<script>alert('Data pendaftaran tidak ditemukan.'); window.location='pesan.html';</script>";
    exit();
}

$data = $_SESSION['pendaftaran'];

$paket = $data['paket'];
$jumlah = (int) $data['jumlah_orang'];
$nama = htmlspecialchars($data['nama_lengkap']);
$email = htmlspecialchars($data['email']);
$telepon = htmlspecialchars($data['nomor_telepon']);
$tanggal = htmlspecialchars($data['tanggal_pendakian']);
$catatan = htmlspecialchars($data['catatan']);

$hargaPaket = [
  "rinjani" => 1200000,
  "bromo" => 350000,
  "merbabu" => 800000
];

$namaPaket = [
  "rinjani" => "Ekspedisi Rinjani",
  "bromo" => "Sunrise Bromo",
  "merbabu" => "Jelajah Merbabu"
];

$hargaPerOrang = $hargaPaket[$paket] ?? 0;
$total = $hargaPerOrang * $jumlah;
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pembayaran - Summit Adventures</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f2f2f2;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 600px;
      margin: 8rem auto 2rem;
      background: white;
      padding: 2rem;
      border-radius: 20px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      color: #2c5530;
      margin-bottom: 2rem;
    }

    .row {
      display: flex;
      justify-content: space-between;
      margin: 1rem 0;
      font-size: 1.1rem;
    }

    .label {
      font-weight: bold;
      color: #333;
    }

    .value {
      color: #555;
    }

    .total {
      font-size: 1.4rem;
      color: #2c5530;
      font-weight: bold;
      text-align: right;
      margin-top: 2rem;
      border-top: 1px solid #ddd;
      padding-top: 1rem;
    }

    .payment-method {
      margin-top: 2rem;
    }

    .payment-method h3 {
      color: #2c5530;
      margin-bottom: 1rem;
    }

    .payment-method ul {
      padding-left: 1.2rem;
      color: #444;
    }

    form {
      margin-top: 2rem;
    }

    input[type="file"] {
      width: 100%;
      padding: 10px;
      border-radius: 10px;
      border: 2px solid #ddd;
    }

    button {
      margin-top: 1rem;
      padding: 12px;
      width: 100%;
      background: #2c5530;
      color: white;
      border: none;
      font-weight: bold;
      border-radius: 50px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    button:hover {
      background: #3a7040;
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>Rincian Pembayaran</h2>

    <div class="row"><div class="label">Nama:</div><div class="value"><?= $nama ?></div></div>
    <div class="row"><div class="label">Email:</div><div class="value"><?= $email ?></div></div>
    <div class="row"><div class="label">Telepon:</div><div class="value"><?= $telepon ?></div></div>
    <div class="row"><div class="label">Tanggal Pendakian:</div><div class="value"><?= $tanggal ?></div></div>
    <div class="row"><div class="label">Paket:</div><div class="value"><?= $namaPaket[$paket] ?? '-' ?></div></div>
    <div class="row"><div class="label">Jumlah Orang:</div><div class="value"><?= $jumlah ?></div></div>
    <div class="row"><div class="label">Harga per Orang:</div><div class="value">Rp <?= number_format($hargaPerOrang, 0, ',', '.') ?></div></div>
    <div class="row"><div class="label">Catatan:</div><div class="value"><?= $catatan ?: '-' ?></div></div>

    <div class="total">Total: Rp <?= number_format($total, 0, ',', '.') ?></div>

    <div class="payment-method">
      <h3>Cara Pembayaran:</h3>
      <ul>
        <li>Transfer ke Rekening BCA 123456789 a.n. Summit Adventures</li>
        <li>Kirim bukti transfer di bawah ini</li>
      </ul>
    </div>

    <form action="upload_bukti.php" method="POST" enctype="multipart/form-data">
      <label for="bukti">Upload Bukti Pembayaran</label>
      <input type="file" id="bukti" name="bukti" accept="image/*,.pdf" required />
      <button type="submit">Kirim Bukti</button>
    </form>
  </div>

</body>
</html>
