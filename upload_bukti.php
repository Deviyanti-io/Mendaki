<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['pendaftaran'])) {
    echo "<script>alert('Data pendaftaran tidak ditemukan.'); window.location='pesan.html';</script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['bukti'])) {
    $file_name = $_FILES['bukti']['name'];
    $file_tmp = $_FILES['bukti']['tmp_name'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'pdf'];

    if (in_array($file_ext, $allowed)) {
        $new_name = uniqid('bukti_', true) . '.' . $file_ext;
        $upload_dir = 'uploads/';

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        move_uploaded_file($file_tmp, $upload_dir . $new_name);

        // Ambil data dari session
        $data = $_SESSION['pendaftaran'];
        $paket = $data['paket'];
        $jumlah_orang = $data['jumlah_orang'];
        $hargaPaket = [
            'rinjani' => 1200000,
            'bromo' => 350000,
            'merbabu' => 800000
        ];
        $harga_per_orang = $hargaPaket[$paket] ?? 0;

        // Simpan ke tabel pembayaran
        $stmt = $koneksi->prepare("INSERT INTO pembayaran (paket, jumlah_orang, harga_per_orang, bukti_pembayaran) VALUES (?, ?, ?, ?)");

        if (!$stmt) {
            die("Prepare failed: " . $koneksi->error);
        }

        $stmt->bind_param("sids", $paket, $jumlah_orang, $harga_per_orang, $new_name);

        if ($stmt->execute()) {
            echo "<script>alert('Bukti pembayaran berhasil diunggah.'); window.location='kontak.html';</script>";
        } else {
            echo "Gagal menyimpan bukti pembayaran: " . $stmt->error;
        }
    } else {
        echo "Format file tidak didukung. Hanya jpg, jpeg, png, dan pdf yang diizinkan.";
    }
} else {
    echo "Upload gagal.";
}
