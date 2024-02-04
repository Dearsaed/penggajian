<?php
include 'koneksi.php';
$idHapus = $_GET['id'];
$koneksi = new PDO("mysql:host=$host;dbname=$database", $user, $password);
$koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "Koneksi sukses.<br>";

// Nonaktifkan aturan integritas referensial sementara
$koneksi->exec("SET foreign_key_checks = 0;");

// Hapus data dari tabel utama (tabel dengan kunci utama)
$stmt = $koneksi->prepare("DELETE FROM karyawan WHERE id_karyawan = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$id = $idHapus; // Ganti dengan nilai ID yang ingin dihapus
$stmt->execute();
echo "Data berhasil dihapus dari karyawan.<br>";

// Hapus data dari tabel anak (tabel dengan foreign key)
$stmt = $koneksi->prepare("DELETE FROM absensi WHERE id_karyawan = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$id = $idHapus; // Ganti dengan nilai ID yang ingin dihapus dari absensi
$stmt->execute();
echo "Data berhasil dihapus dari absensi.<br>";

// Aktifkan kembali aturan integritas referensial
$koneksi->exec("SET foreign_key_checks = 1;");


header('Location: karyawan.php');
    
?>