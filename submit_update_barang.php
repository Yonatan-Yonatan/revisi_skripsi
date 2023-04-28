<?php
	require "conn.php";
	session_start();
  	
	$id_produk = $_POST['id_produk'];
    $nama_produk = $_POST['nama_produk'];
    $jenis_produk = $_POST['jenis_barang'];
    $harga= $_POST['harga'];
	$id_supplier   = $_POST['id_supplier'];
  
  	$sSQL= "update produk set nama_produk='$nama_produk', jenis_barang='$jenis_produk',harga='$harga',id_supplier='$id_supplier'
             where id_produk='$id_produk' ";
	
 	if (mysqli_query($koneksi,  $sSQL)) 
	{
		echo '
        <script>
            alert("Data Barang BERHASIL Di Ubah");
            window.location.href="index.php";
        </script>
        ';
        exit();
    }else{
         echo '
        <script>
            alert("Data Barang GAGAL Dimasukkan");
            window.location.href="index.php";
        </script>
        ';
    }
	mysqli_close($koneksi); 
?>