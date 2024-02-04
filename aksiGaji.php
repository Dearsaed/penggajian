<table border='1' style='border-collapse:collapse;' id="tabelUtama">
    <?php
        include "koneksi.php";
        $tgl = $_POST['tanggal'];
        $date1 = str_replace('-', '/', $tgl);
        $dateSelesai = date('Y-m-d',strtotime($date1 . "+6 days"));  

        // echo "<script>alert('$tgl dan $dateSelesai')</script>";
        $karyawan = mysqli_query($koneksi, "SELECT * FROM karyawan ");
                    
    ?>
    <thead>
        <tr>
        <th>ID</th>
        <th>Nama Karyawan</th>
        <?php 
            // $date = date('Y-m-d');
            $date1 = str_replace('-', '/', $tgl);
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
                <?php 

                    $gajiKaryawan = mysqli_query($koneksi, "SELECT absensi.id_karyawan, absensi.tanggal, absensi.presensi, absensi.lembur, absensi.pot, karyawan.nama_karyawan, karyawan.gaji 
                    FROM `absensi`
                    JOIN karyawan ON absensi.id_karyawan = karyawan.id_karyawan
                    WHERE `tanggal` BETWEEN '$tgl' AND '$dateSelesai' ");     

                    // $date = date('Y-m-d');
                    $date1 = str_replace('-', '/', $tgl);
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
                $totalGaji = mysqli_query($koneksi, "SELECT SUM(karyawan.gaji) as total 
                FROM `absensi`
                JOIN karyawan ON absensi.id_karyawan = karyawan.id_karyawan
                WHERE `nama_karyawan`='$namaKaryawan' 
                AND `presensi` = '1' 
                AND `tanggal` BETWEEN '$tgl' AND '$dateSelesai' ");

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
                AND `tanggal` BETWEEN '$tgl' AND '$dateSelesai' ");

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
                AND `presensi` = '1' 
                AND `tanggal` BETWEEN '$tgl' AND '$dateSelesai' ");

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