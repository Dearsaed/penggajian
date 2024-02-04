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
    // $idKaryawan = @$_POST['idKaryawan'];
    $tgl = @$_POST['tanggal'];
    // $presensi = @$_POST['namaKaryawan'];
    // $lembur = @$_POST['gaji'];
    // $pot = @$_POST['namaKaryawan'];

    include 'koneksi.php';
    $karyawan = mysqli_query($koneksi, "SELECT absensi.id_karyawan, absensi.tanggal, absensi.presensi, absensi.lembur, absensi.pot, karyawan.nama_karyawan 
    FROM `absensi`
    JOIN karyawan ON absensi.id_karyawan = karyawan.id_karyawan
    WHERE `tanggal` = '$tgl' ");

    $totalKaryawan = mysqli_query($koneksi, "SELECT * from karyawan");
    
    $cekSimpan = false;
    $no = 1;
    $arrKaryawan = array();
    $arrTotalKaryawan = array();
    $sql_update;
    foreach ($karyawan as $row){
        array_push($arrKaryawan, $row['id_karyawan']);
    }
    foreach ($totalKaryawan as $row){
        array_push($arrTotalKaryawan, $row['id_karyawan']);
    }
    // echo count($arrKaryawan);
    // echo count($arrTotalKaryawan);
    foreach ($totalKaryawan as $row){

        $idKaryawan = @$_POST['id'.$row['id_karyawan']];
        $tanggal = @$_POST['tanggal'];
        $presensi = @$_POST['presensi'.$row['id_karyawan']];
        $lembur = @$_POST['lembur'.$row['id_karyawan']];
        $pot = @$_POST['pot'.$row['id_karyawan']];
        

        // echo $idKaryawan.", ".$tanggal.", ".$presensi.", ".$lembur.", ".$pot."; ";
        // echo @$_POST['id'.$row['id_karyawan']].", ".@$_POST['tanggal'].", ".@$_POST['presensi'.$row['id_karyawan']].", ".@$_POST['lembur'.$row['id_karyawan']].", ".@$_POST['pot'.$row['id_karyawan']];
        if($no > count($arrKaryawan)){
            $sql_simpan = mysqli_query ($conn, "INSERT into absensi (id_karyawan, tanggal, presensi, lembur, pot) VALUES ('$idKaryawan', '$tanggal', '$presensi', '$lembur', '$pot')");
        } else {
            $sql_update = mysqli_query ($conn, "UPDATE absensi SET presensi='$presensi',lembur='$lembur',pot='$pot' WHERE id_karyawan='$idKaryawan' AND tanggal = '$tanggal' ");
            if($sql_update) {
                echo "Data berhasil disimpan";            
                $cekSimpan = true;
            } else {
                echo "Data gagal disimpan";
            }
        }
        $no++;
                                        
        
    }
    if ($cekSimpan) {
        header('Location: absensi.php');
    }

    // echo $idKaryawan.", ".$tanggal.", ".$presensi.", ".$lembur.", ".$pot;


    //Kemudian dapat langsung kita simpan dengan query INSERT
    // $sql_simpan = mysqli_query ($conn, "INSERT into absensi (id_karyawan, tanggal, presensi, lembur, pot) VALUES ('$namaKaryawan', '$gaji')");
    // if($sql_simpan) {
    //     echo "Data berhasil disimpan";
    //     header('Location: absensi.php');
    // } else {
    //     echo "Data gagal disimpan";
    // }
?>