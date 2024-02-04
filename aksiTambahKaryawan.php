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
    //Akhir Koneksi

    //Pertama ambil data kiriman dari form
    $namaKaryawan = @$_POST['namaKaryawan'];
    $gaji = @$_POST['gaji'];

    //Kemudian dapat langsung kita simpan dengan query INSERT
    $sql_simpan = mysqli_query ($conn, "INSERT into karyawan (nama_karyawan, gaji) VALUES ('$namaKaryawan', '$gaji')");
    if($sql_simpan) {
        echo "Data berhasil disimpan";
        header('Location: karyawan.php');
    } else {
        echo "Data gagal disimpan";
    }
?>