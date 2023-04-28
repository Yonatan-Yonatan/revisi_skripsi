<?php

include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}

if(isset($_POST['simpan'])){
    $id_masuk   = $_POST['id_masuk'];
    $id_produk   = $_POST['id_produk'];
    $id_supplier   = $_POST['id_supplier'];
    $stoklama   = $_POST['stoklama'];
    $stok   = $_POST['stok'];
    $id = $_SESSION['id'];


    $cekstok = mysqli_query($koneksi, "select * from produk where id_produk= '$id_produk'");
    $ambil_data_stok = mysqli_fetch_array($cekstok);

    $data_stok = $ambil_data_stok['qty'];
    $tambah_stok = ($data_stok-$stoklama) + $stok;


    $query = mysqli_query($koneksi, "update barang_masuk set id_produk='$id_produk', id_supplier='$id_supplier',stok='$stok' where id_masuk='$id_masuk'");
    $update_stok = mysqli_query($koneksi, "update produk set qty='$tambah_stok' where id_produk='$id_produk'");
    if ($query && $update_stok){
        echo '
            <script>
                alert("Data Barang Masuk BERHASIL Di Ubah");
                window.location.href="restock_barang.php";
            </script>
            ';
            exit();
        }else{
            echo '
            <script>
                alert("Data Barang Masuk GAGAL Di Ubah");
                window.location.href="restock_barang.php";
            </script>
            ';
        }
}

?>
