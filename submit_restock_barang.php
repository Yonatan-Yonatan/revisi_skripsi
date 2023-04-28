<?php

include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}

if(isset($_POST['simpan'])){
    $produk   = $_POST['id_produk'];
    $id_produk = explode(':', $produk);
    $id_supplier   = $_POST['id_supplier'];
    $stok   = $_POST['stok'];
    $id = $_SESSION['id'];


    $cekstok = mysqli_query($koneksi, "select * from produk where id_produk= '$id_produk[0]'");
    $ambil_data_stok = mysqli_fetch_array($cekstok);

    $data_stok = $ambil_data_stok['qty'];
    $tambah_stok = $data_stok + $stok;


    $query = mysqli_query($koneksi, "INSERT INTO barang_masuk (id_produk, id_supplier, stok,id) VALUES ('$id_produk[0]', '$id_supplier', '$stok','$id')");
    $update_stok = mysqli_query($koneksi, "update produk set qty='$tambah_stok' where id_produk='$id_produk[0]'");
    if ($query && $update_stok){
        echo '
            <script>
                alert("Data Barang Masuk BERHASIL Dimasukkan");
                window.location.href="restock_barang.php";
            </script>
        ';
        exit();
        }else{
            echo '
            <script>
                alert("Data Barang Masuk GAGAL Dimasukkan");
                window.location.href="restock_barang.php";
            </script>
            ';
        }
    }

?>
