<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karyawan</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>    

</head>
<body>
    <nav>
        <a href="absensi.php" class="btn btn-secondary">Absensi</a>
        <a href="gaji.php" class="btn btn-secondary">gaji</a>
    </nav>
    <br>
    <a href="tambahKaryawan.html" class="btn btn-primary">Tambah Karyawan</a>

    <h1>Tabel Karyawan</h1>
    
    <table border="1">
        <tr>
            <th>Id Karyawan</th>
            <th>Nama Karyawan</th>
            <th>Gaji</th>
            <th colspan="2">Aksi</th>
        </tr>
        <?php
            include 'koneksi.php';
            $karyawan = mysqli_query($koneksi, "SELECT * from karyawan");            
            foreach ($karyawan as $row){                            
                ?>
                    <tr>
                        <td><?php echo $row['id_karyawan'] ?></td>
                        <td><?php echo $row['nama_karyawan'] ?></td>
                        <td><?php echo $row['gaji'] ?></td>
                        <td><a href= "editKaryawan.php?id=<?php echo $row['id_karyawan']; ?>" class='btn btn-primary' id='tombolEdit'>Edit</a></td>
                        <td><a href= "hapusKaryawan.php?id=<?php echo $row['id_karyawan']; ?>" class='btn btn-danger' id='tombolHapus' >Hapus</a></td>
                    </tr>          
            <?php
            }
            ?>
    </table>
    <script>
        $(document).ready(function(){

           
        });
        
    </script>
</body>
</html>