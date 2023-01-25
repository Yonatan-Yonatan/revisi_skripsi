<?php

include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}

if(isset($_POST['simpan'])){
   
    $id_produk = $_POST['id_produk'];
    $nama_produk = $_POST['nama_produk'];
    $jenis_barang = $_POST['jenis_barang'];
    $qty= $_POST['qty'];
    $harga= $_POST['harga'];

    $query = mysqli_query($koneksi, "INSERT INTO produk (id_produk, nama_produk, jenis_barang, qty, harga) VALUES ('$id_produk', '$nama_produk', '$jenis_barang', '$qty','$harga')");
    if ($query){
        header("location:index.php");
        exit();
    }else{
        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>';
    }
}

?>
