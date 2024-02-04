<?php
    //Ini untuk koneksi saja
    $dbhost= "localhost";
    $dbuser= "root";
    $dbpassword = "";
    $dbname= "penggajian";

    // Membuat koneksi
    $conn = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

    // Mengecek koneksi
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }
    
    include 'koneksi.php';
    $karyawan = mysqli_query($koneksi, "SELECT * from karyawan");
    $cekSimpan = false;
    foreach ($karyawan as $row){
        $idKaryawan = @$_POST['id'.$row['id_karyawan']];
        $tanggal = @$_POST['tanggal'];
        $presensi = @$_POST['presensi'.$row['id_karyawan']];
        $lembur = @$_POST['lembur'.$row['id_karyawan']];
        $pot = @$_POST['pot'.$row['id_karyawan']];
         
        $sql_simpan = mysqli_query ($conn, "INSERT into absensi (id_karyawan, tanggal, presensi, lembur, pot) VALUES ('$idKaryawan', '$tanggal', '$presensi', '$lembur', '$pot')");
        if($sql_simpan) {
            echo "Data berhasil disimpan";
            $cekSimpan = true;
        } else {
            echo "Data gagal disimpan";
        }
    }
    if ($cekSimpan) {
        header('Location: absensi.php');
    }

    
?>