<?php
    include "koneksi.php";
    $filename = 'gajiKaryawan_'.time().'.csv';
    
    // POST values
    // $from_date = $_POST['from_date'];
    // $to_date = $_POST['to_date'];
    
    // Select query
    $query = "SELECT * FROM karyawan ORDER BY id asc";
    
    // if(isset($_POST['from_date']) && isset($_POST['to_date'])){
    //     $query = "SELECT * FROM csv_karyawan where tanggal_bergabung between '".$from_date."' and '".$to_date."' ORDER BY id asc";
    // }
    
    $result = mysqli_query($koneksi,$query);
    $karyawan_arr = array();
    
    // file creation
    $file = fopen($filename,"w");
    
    // Header row - Remove this code if you don't want a header row in the export file.
    $karyawan_arr = array("ID","Nama","Gaji"); 
    
    while($row = mysqli_fetch_assoc($result)){
        $id = $row['id'];
        $nama = $row['nama'];
        $gaji = $row['gaji'];        
    // Write to file 
    $karyawan_arr = array($id,$nama,$gaji);
    fputcsv($file,$karyawan_arr); 
    }
    
    fclose($file);
    
    // download
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$filename");
    header("Content-Type: application/csv; ");
    
    readfile($filename);
    
    // deleting file
    unlink($filename);
    exit();
?>
