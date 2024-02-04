<?php

    include 'koneksi.php';

    //Pertama ambil data kiriman dari form
    $namaKaryawan = @$_POST['namaKaryawan'];
    $idKaryawan = @$_POST['idKaryawan'];
    $gaji = @$_POST['gaji'];

    //Kemudian dapat langsung kita simpan dengan query INSERT
    $sql_simpan = mysqli_query ($koneksi, "UPDATE karyawan
    SET nama_karyawan = '$namaKaryawan', gaji = '$gaji'
    WHERE id_karyawan = $idKaryawan;");
    if($sql_simpan) {
        echo "Data berhasil disimpan";
        header('Location: karyawan.php');
    } else {
        echo "Data gagal disimpan";
    }
?>