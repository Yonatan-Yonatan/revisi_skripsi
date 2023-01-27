<?php

include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}

if(isset($_POST['simpan'])){
    $id_produk   = $_POST['id_produk'];
    $id_supplier   = $_POST['id_supplier'];
    $stok   = $_POST['stok'];


    $cekstok = mysqli_query($koneksi, "select * from produk where id_produk= '$id_produk'");
    $ambil_data_stok = mysqli_fetch_array($cekstok);

    $data_stok = $ambil_data_stok['qty'];
    $tambah_stok = $data_stok + $stok;


    $query = mysqli_query($koneksi, "INSERT INTO barang_masuk (id_produk, id_supplier, stok) VALUES ('$id_produk', '$id_supplier', '$stok')");
    $update_stok = mysqli_query($koneksi, "update produk set qty='$tambah_stok' where id_produk='$id_produk'");
    if ($query && $update_stok){
        header("location:restock_barang.php");
        exit();
    }else{
        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>';
    }
}

?>
