<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $data = [
        'nama_lengkap'      => $_POST['nama'],
        'email'             => $_POST['email'],
        'nomor_telepon'     => $_POST['telepon'],
        'paket'             => $_POST['paket'],
        'jumlah_orang'      => (int)$_POST['jumlah'],
        'tanggal_pendakian' => $_POST['tanggal'],
        'catatan'           => $_POST['catatan'] ?? ''
    ];

    // Simpan ke session untuk digunakan di pembayaran.php
    $_SESSION['pendaftaran'] = $data;

    // Masukkan data ke database
    $stmt = $koneksi->prepare("INSERT INTO pendaftaran (nama_lengkap, email, nomor_telepon, paket, jumlah_orang, tanggal_pendakian, catatan)
                               VALUES (?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Prepare failed: " . $koneksi->error);
    }

    $stmt->bind_param(
        "ssssiss",
        $data['nama_lengkap'],
        $data['email'],
        $data['nomor_telepon'],
        $data['paket'],
        $data['jumlah_orang'],
        $data['tanggal_pendakian'],
        $data['catatan']
    );

    if ($stmt->execute()) {
        // Redirect ke halaman pembayaran
        header("Location: pembayaran.php");
        exit();
    } else {
        echo "Gagal menyimpan ke database: " . $stmt->error;
    }
} else {
    echo "Akses tidak sah.";
}
