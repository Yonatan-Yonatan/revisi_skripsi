<?php

include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}

if(isset($_POST['simpan'])){
   
    $nama_produk = $_POST['nama_produk'];
    $jenis_barang = $_POST['jenis_barang'];
    $harga= $_POST['harga'];
    $id_supplier   = $_POST['id_supplier'];

    $query = mysqli_query($koneksi, "INSERT INTO produk (nama_produk, jenis_barang, harga, id_supplier) VALUES ('$nama_produk', '$jenis_barang', '$harga','$id_supplier')");
    if ($query){
        header("location:index.php");
        exit();
    }else{
        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>';
    }
}

?>
