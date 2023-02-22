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
		header("location:index.php");
		exit();
 	}	
 	else
	{
       echo "Error: " . $sSQL . "<br>" . mysqli_error($koneksi);	  		  
	}	   
	mysqli_close($koneksi); 
?>