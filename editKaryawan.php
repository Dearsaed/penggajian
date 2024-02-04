<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Karyawan</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>  
</head>
<body>
    
<a href="karyawan.php" class="btn btn-primary">Kembali ke halaman Karyawan</a>
<?php
    include 'koneksi.php';

    $idKaryawan = $_GET['id'];
    $karyawan = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE id_karyawan = '$idKaryawan'");
    foreach($karyawan as $row){

    
?>
    <form action="aksiEditKaryawan.php" method="post" enctype="multipart/form-data" id="form1">
        <table width="auto" cellpadding="10" cellspacing="0" border="0">            
            <tr>
                <td>Nama Lengkap</td>
                <td>:</td>
                <td><input name="namaKaryawan" type="text" required value='<?php echo $row['nama_karyawan'] ?>'><input name="idKaryawan" type="number" value='<?php echo $row['id_karyawan'] ?>' hidden></td>
            </tr>
            <tr>
                <td>Gaji</td>
                <td>:</td>
                <td><input type="number" name="gaji" required value='<?php echo $row['gaji'] ?>'></td>
            </tr>
            <tr>
                <div class="center">

                    <td colspan="3" style="text-align: center;"><input name="simpan" type="submit" value="Simpan" class="tombol2 btn btn-success"></td>
                </div>            
            </tr>
        </table>
    </form>
    <?php
    }
    ?>
</body>
</html>