<?php
 include "conn.php"; 
 session_start();
        if (empty($_SESSION['isLoggedin']))
     {
         header("location: logout.php");
      }
 
 
 if (isset($_POST['upload'])) {
    $type         =explode(".",$_FILES['importdata']['name']);
    if(strtolower(end($type)) !='xlsx' && strtolower(end($type)) !='csv'){
        ?>
            <script language="JavaScript">
                alert('Oops! Harap Masukkan File dengan format .XLSX / .CSV Saja ...');
                javascript:window.history.go(-1);
            </script>
        <?php
    }
    else{
    require('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
  require('spreadsheet-reader-master/SpreadsheetReader.php');

  //upload data excel kedalam folder uploads
  $target_dir = "uploads/".basename($_FILES['importdata']['name']);
  
  move_uploaded_file($_FILES['importdata']['tmp_name'],$target_dir);

  $Reader = new SpreadsheetReader($target_dir);

  foreach ($Reader as $Key => $Row)
  {
   // import data excel mulai baris ke-2 (karena ada header pada baris 1)
   if ($Key < 1) continue;   
   $query = mysqli_query($koneksi, "INSERT INTO produk(id_produk, nama_produk, jenis_barang, harga) VALUES ('".$Row[0]."', '".$Row[1]."','".$Row[2]."','".$Row[4]."')");
  }
  unlink($_FILES['importdata']['name']);
  if ($query) {
    header("location:index.php");
        exit();
   }else{
    echo mysql_error();
   }
 }
}
 ?>