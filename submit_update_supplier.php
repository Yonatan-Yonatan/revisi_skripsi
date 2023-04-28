<?php
	require "conn.php";
	session_start();
  	
	$ID = $_POST['id_supplier'];
    $nama = $_POST['nama_supplier'];
    $alamat = $_POST['alamat'];
    $no_telp= $_POST['no_telp'];
  
  	$sSQL= "update supplier set nama_supplier='$nama', alamat='$alamat',no_telp='$no_telp'
             where id_supplier='$ID' ";
	
 	if (mysqli_query($koneksi,  $sSQL)) 
	{
		echo '
            <script>
                alert("Data Supplier BERHASIL Di Ubah");
                window.location.href="supplier.php";
            </script>
            ';
            exit();
        }else{
            echo '
            <script>
                alert("Data Supplier GAGAL Di Ubah");
                window.location.href="supplier.php";
            </script>
            ';
        }   
	mysqli_close($koneksi); 
?>