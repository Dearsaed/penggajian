<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaji</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css" />
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <link href="https://cdn.datatables.net/v/dt/dt-1.13.8/datatables.min.css" rel="stylesheet">
    
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.8/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.js"></script>
</head>
<body>
    <nav>
        <a href="karyawan.php" class="btn btn-secondary">Karyawan</a>
        <a href="absensi.php" class="btn btn-secondary">Absensi</a>
    </nav>
    
    <form method='post' action='aksiGaji.php'>
        
        <label for="tanggal">Masukkan Tanggal :</label>
        <input type="date" name="tanggal" id="tanggal">
        <a id="tombolTanggal" class="btn btn-primary">Pilih</a>
        <br><br>
        
        <!-- <input type='submit' value='Export' name='Export'> -->
    </form> 
    <div class="isiTabel">

    
        <table border='1' style='border-collapse:collapse;' id="tabelUtama">
            <?php
                include "koneksi.php";
                $karyawan = mysqli_query($koneksi, "SELECT * FROM karyawan ");
                            
            ?>
            <thead>
                <tr>
                <th>ID</th>
                <th>Nama Karyawan</th>
                <!-- <th>Gaji</th> -->
                <?php 
                    $date = date('Y-m-d');
                    $date1 = str_replace('-', '/', $date);
                    $tomorrow = date('d-m-Y',strtotime($date1 . "+1 days"));
                    for ($i=0; $i < 7; $i++) {                     
                        $tomorrow = date('d-m-Y',strtotime($date1 . "+".$i." days"));
                        echo "<th>".$tomorrow."</th>";
                    }
                ?>
                <!-- <th>Tanggal</th> -->
                <th>Jumlah</th>
                <th>lembur</th>
                <th>Pot</th>
                <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php                         
                
                foreach($karyawan as $row){
                    $idKaryawan = $row['id_karyawan'];
                    $namaKaryawan = $row['nama_karyawan'];
                    $gaji = $row['gaji'];
                    
                    $totalTotal = 0;
                    $lembur = 0;
                    $pot = 0;

                    ?>
                    <tr>
                        <td><?php echo $idKaryawan; ?></td>
                        <td><?php echo $namaKaryawan; ?></td>
                        <!-- <td><?php //echo $gaji; ?></td> -->
                        <!-- <td><?php //echo $tanggal; ?></td> -->                   
                        <?php 

                            $gajiKaryawan = mysqli_query($koneksi, "SELECT absensi.id_karyawan, absensi.tanggal, absensi.presensi, absensi.lembur, absensi.pot, karyawan.nama_karyawan, karyawan.gaji 
                            FROM `absensi`
                            JOIN karyawan ON absensi.id_karyawan = karyawan.id_karyawan
                            WHERE `tanggal` BETWEEN '2024-02-04' AND '2024-02-10' ");     

                            $date = date('Y-m-d');
                            $date1 = str_replace('-', '/', $date);
                            $tomorrow = date('d-m-Y',strtotime($date1 . "+1 days"));                        

                            for ($i=0; $i < 7; $i++) {                     
                                $tomorrow = date('Y-m-d',strtotime($date1 . "+".$i." days"));
                                
                                $gajiKaryawan = mysqli_query($koneksi, "SELECT absensi.id_karyawan, absensi.tanggal, absensi.presensi, absensi.lembur, absensi.pot, karyawan.nama_karyawan, karyawan.gaji 
                                FROM `absensi`
                                JOIN karyawan ON absensi.id_karyawan = karyawan.id_karyawan
                                WHERE `tanggal` = '$tomorrow' AND nama_karyawan = '$namaKaryawan'");  
                                foreach($gajiKaryawan as $rowGaji){
                                    if ($rowGaji['presensi'] == 1) {
                                        echo "<td>".$rowGaji['gaji']."</td>";
                                    } else {
                                        echo "<td>0</td>";
                                    }                                
                                }
                            }
                        ?>
                        
                        <td><?php 
                        // $date = date('Y-m-d');
                        // $date1 = str_replace('-', '/', $date);
                        $tomorrow1 = date('Y-m-d',strtotime($date1 . "+6 days"));

                        $totalGaji = mysqli_query($koneksi, "SELECT SUM(karyawan.gaji) as total 
                        FROM `absensi`
                        JOIN karyawan ON absensi.id_karyawan = karyawan.id_karyawan
                        WHERE `nama_karyawan`='$namaKaryawan' 
                        AND `presensi` = '1' 
                        AND `tanggal` BETWEEN '$date' AND '$tomorrow1' ");

                        foreach($totalGaji as $i){
                            if ($i['total'] == null) {
                                echo 0;
                            } else {
                                echo $i['total'];
                                $totalTotal = $i['total'];
                            }
                                                
                        }   ?></td>
                        <td><?php $totalLembur = mysqli_query($koneksi, "SELECT SUM(lembur) as total 
                        FROM `absensi`
                        JOIN karyawan ON absensi.id_karyawan = karyawan.id_karyawan
                        WHERE `nama_karyawan`='$namaKaryawan'                      
                        AND `tanggal` BETWEEN '$date' AND '$tomorrow1' ");

                        foreach($totalLembur as $i){
                            if ($i['total'] == null OR $i['total'] == 0) {
                                echo 0;
                            } else {
                                echo $i['total'];
                                $lembur = $i['total'];
                            }
                                                
                        }
                        ?></td>
                        <td><?php 
                        $totalPot = mysqli_query($koneksi, "SELECT SUM(pot) as total 
                        FROM `absensi`
                        JOIN karyawan ON absensi.id_karyawan = karyawan.id_karyawan
                        WHERE `nama_karyawan`='$namaKaryawan' 
                        AND `presensi` = '$namaKaryawan' 
                        AND `tanggal` BETWEEN '$date' AND '$tomorrow1' ");

                        foreach($totalPot as $i){
                            if ($i['total'] == null OR $i['total'] == 0) {
                                echo 0;
                            } else {
                                echo $i['total'];
                                $pot = $i['total'];
                            }
                                                
                        }
                        ?></td>
                        <td><?php echo $totalTotal + $lembur - $pot; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
            
        </table>
    </div>
           

    <script>
        $(document).ready(function(){
                        
            $('#tabelUtama').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                 'copy', 'csv', 'excel', 'print'
                ]
            } );

            var now = new Date();  
            now.setDate(now.getDate() );  
            var month = (now.getMonth() + 1);               
            var day = now.getDate();
            if (month < 10) 
                month = "0" + month;
            if (day < 10) 
                day = "0" + day;
            
            var today = now.getFullYear() + '-' + month + '-' + day;        
            // alert(tanggalHariIni);
            $('#tanggal').val(today);
            $("#tombolTanggal").click(function() {
                var nilai = $("#tanggal").val();
                // alert(nilai);
                $.ajax({
                    method:"POST",
                    url:"aksiGaji.php",
                    data: {tanggal: nilai},
                    success:function(hasil){
                        $(".isiTabel").html(hasil);
                        $('#tabelUtama').DataTable( {
                            dom: 'Bfrtip',
                            buttons: [
                            'copy', 'csv', 'excel', 'print'
                            ]
                        } );
                    }
                });           
            });                        
        });
    </script>
</body>
</html>