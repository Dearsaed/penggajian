<?php 
include 'koneksi.php';
$tgl = @$_POST['tanggal'];
//mengambil data berdasarkan tanggal
$karyawan = mysqli_query($koneksi, "SELECT absensi.id_karyawan, absensi.tanggal, absensi.presensi, absensi.lembur, absensi.pot, karyawan.nama_karyawan 
FROM `absensi`
JOIN karyawan ON absensi.id_karyawan = karyawan.id_karyawan
WHERE `tanggal` = '$tgl' ");  

$totalKaryawan = mysqli_query($koneksi, "SELECT * from karyawan");


if (mysqli_num_rows($karyawan) < 1) {
    
    ?>

    <form action="aksiAbsensi.php" method="post" enctype="multipart/form-data" id="form1">        
        <label for="tanggal">Masukkan Tanggal :</label>
        <input type="date" name="tanggal" id="tanggal" value="<?php echo $_POST['tanggal']?>">
        <a id="tombolTanggal" class="btn btn-primary">Pilih</a>
        <br>
        <br>
    
        <div class="table-responsive" id="tableWidth">
            <table class="table table-bordered table-sm ">
                <thead>
                    <tr>
                        <th>Id Karyawan</th>
                        <th>Nama Karyawan</th>
                        <th colspan="2">Presensi</th>
                        <th>Lembur</th>
                        <th>Pot</th>
                    </tr>
                </thead>
                <tbody>
                    <?php                        
                        foreach ($totalKaryawan as $row){                
                            ?>
                            <tr>
                                <td><?php echo $row['id_karyawan']; ?><input type='text' name="id<?php echo $row['id_karyawan']?>" value="<?php echo $row['id_karyawan']; ?>" hidden></td>
                                <td><?php echo $row['nama_karyawan']; ?><input type='text' name='namaKaryawan' hidden></td>
                                <td><input type='radio' id='hadir<?php echo $row['id_karyawan']; ?>' name='presensi<?php echo $row['id_karyawan']; ?>' value='1'>
                                <label for='hadir<?php echo $row['id_karyawan']; ?>'>Hadir</label></td>
                                <td><input type='radio' id='tidakHadir<?php echo $row['id_karyawan']; ?>' name='presensi<?php echo $row['id_karyawan']; ?>' value='0' checked>
                                <label for='tidakHadir<?php echo $row['id_karyawan']; ?>'>Tidak Hadir</label></td>
                                
                                <td><input name='lembur<?php echo $row['id_karyawan']; ?>' type='number' value=0></td>
                                <td><input name='pot<?php echo $row['id_karyawan']; ?>' type='number' value=0></td>
                            </tr>

                                <?php         
                        }
                    ?>                    
                    <tr>
                        <td colspan="7" style="text-align: center; border:10px"><input name="simpan" type="submit" value="Simpan" class="tombol2 btn btn-success"></td>
                    </tr>
                </tbody>        
            </table>
        </div>
    </form>

    <?php
} else {
    ?>
    <form action="updateAbsensi.php" method="post" enctype="multipart/form-data" id="form1"> 
        <label for="tanggal">Masukkan Tanggal :</label>
                <input type="date" name="tanggal" id="tanggal" value="<?php echo $_POST['tanggal']?>">
                <a id="tombolTanggal" class="btn btn-primary">Pilih</a>
                <br>
                <br>
        <div class="table-responsive" id="tableWidth">  
            <table class="table table-bordered table-sm ">
                <thead>
                    <tr>
                        <th>Id Karyawan</th>
                        <th>Nama Karyawan</th>
                        <th colspan="2">Presensi</th>
                        <th>Lembur</th>
                        <th>Pot</th>
                    </tr>
                </thead>
                <tbody>
                    <?php                                                              
                        foreach ($karyawan as $row){                
                            ?>
                            <tr>
                                    <td><?php echo $row['id_karyawan']; ?><input type='text' name="id<?php echo $row['id_karyawan']?>" value="<?php echo $row['id_karyawan']; ?>" hidden></td>
                                    <td><?php echo $row['nama_karyawan']; ?><input type='text' name='namaKaryawan' hidden></td>
                                    <?php
                                        if ($row['presensi']) {
                                            ?>
                                    <td><input type='radio' id='hadir<?php echo $row['id_karyawan']; ?>' name='presensi<?php echo $row['id_karyawan']; ?>' value='1' checked>
                                    <label for='hadir<?php echo $row['id_karyawan']; ?>'>Hadir</label></td>
                                    <td><input type='radio' id='tidakHadir<?php echo $row['id_karyawan']; ?>' name='presensi<?php echo $row['id_karyawan']; ?>' value='0'>
                                    <label for='tidakHadir<?php echo $row['id_karyawan']; ?>'>Tidak Hadir</label></td>
                                        <?php } else { ?>
                                    <td><input type='radio' id='hadir<?php echo $row['id_karyawan']; ?>' name='presensi<?php echo $row['id_karyawan']; ?>' value='1'>
                                    <label for='hadir<?php echo $row['id_karyawan']; ?>'>Hadir</label></td>
                                    <td><input type='radio' id='tidakHadir<?php echo $row['id_karyawan']; ?>' name='presensi<?php echo $row['id_karyawan']; ?>' value='0' checked>
                                    <label for='tidakHadir<?php echo $row['id_karyawan']; ?>'>Tidak Hadir</label></td>
                                        <?php } ?>
                                        
                                                            
                                    
                                    <td><input name='lembur<?php echo $row['id_karyawan']; ?>' type='number' value="<?php echo $row['lembur']; ?>"></td>
                                    <td><input name='pot<?php echo $row['id_karyawan']; ?>' type='number' value="<?php echo $row['pot']; ?>"></td>
                                </tr>

                                <?php         
                        }
                    
                        if (mysqli_num_rows($karyawan) < mysqli_num_rows($totalKaryawan)) {
                            // echo "<script>alert('Tes')</script>";
                            $arrKaryawan = array();
                            $arrTotalKaryawan = array();

                            foreach ($karyawan as $row){
                                array_push($arrKaryawan, $row['id_karyawan']);
                            }

                            foreach ($totalKaryawan as $row){
                                array_push($arrTotalKaryawan, $row['id_karyawan']);
                            }

                            // $sisaArray=array_diff_key($arrTotalKaryawan,$arrKaryawan);

                            $no = 1;
                            foreach ($totalKaryawan as $row){
                                if($no > count($arrKaryawan)){
                                    // echo "<script>alert('Tes')</script>";
                                    // $no++;  

                                    ?>
                            <tr>
                                <td><?php echo $row['id_karyawan']; ?><input type='text' name="id<?php echo $row['id_karyawan']?>" value="<?php echo $row['id_karyawan']; ?>" hidden></td>
                                <td><?php echo $row['nama_karyawan']; ?><input type='text' name='namaKaryawan' hidden></td>
                                <td><input type='radio' id='hadir<?php echo $row['id_karyawan']; ?>' name='presensi<?php echo $row['id_karyawan']; ?>' value='1'>
                                <label for='hadir<?php echo $row['id_karyawan']; ?>'>Hadir</label></td>
                                <td><input type='radio' id='tidakHadir<?php echo $row['id_karyawan']; ?>' name='presensi<?php echo $row['id_karyawan']; ?>' value='0' checked>
                                <label for='tidakHadir<?php echo $row['id_karyawan']; ?>'>Tidak Hadir</label></td>
                                
                                <td><input name='lembur<?php echo $row['id_karyawan']; ?>' type='number' value=0></td>
                                <td><input name='pot<?php echo $row['id_karyawan']; ?>' type='number' value=0></td>
                            </tr>
                                <?php

                                }  
                                $no++; 
                            }                            
                        }                         
                    ?>
                        

                    <tr>
                        <td colspan="7" style="text-align: center; border:10px"><input name="simpan" type="submit" value="Simpan" class="tombol2 btn btn-success"></td>
                    </tr>
                </tbody>        
            </table>
        </div>
    </form>

    <?php 
}
    ?>

<script>
    $(document).ready(function() {        
        $("#tombolTanggal").click(function() {
            var nilai = $("#tanggal").val();
            // alert(nilai);
            $.ajax({
                    method:"POST",
                    url:"data.php",
                    data: {tanggal: nilai},
                    success:function(hasil){
                        $(".isiTabel").html(hasil);
                    }
                });           
        });        

    });
</script>