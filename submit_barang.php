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
    $min_stok  = $_POST['min_stok'];

    $query = mysqli_query($koneksi, "INSERT INTO produk (nama_produk, jenis_barang, harga, min_qty) VALUES ('$nama_produk', '$jenis_barang', '$harga','$min_stok')");
    if ($query){
        echo '
        <script>
            alert("Data Barang BERHASIL Dimasukkan");
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
}

?>
