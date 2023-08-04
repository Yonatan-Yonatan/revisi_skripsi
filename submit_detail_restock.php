<?php

include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}

if(isset($_POST['simpan'])){
    $id_produk   = $_POST['id_produk'];
    $stok = $_POST['stok'];
    $id_tr_masuk = $_POST['id_tr_masuk'];


    $cekstok = mysqli_query($koneksi, "select * from produk where id_produk= '$id_produk'");
    $ambil_data_stok = mysqli_fetch_array($cekstok);

    $data_stok = $ambil_data_stok['qty'];
    $tambah_stok = $data_stok + $stok;


    $query = mysqli_query($koneksi, "INSERT INTO barang_masuk (id_produk, stok, id_tr_masuk) VALUES ('$id_produk', '$stok','$id_tr_masuk')");
    $update_stok = mysqli_query($koneksi, "update produk set qty='$tambah_stok' where id_produk='$id_produk'");
    if ($query && $update_stok){
        echo '
            <script>
                alert("Data Barang Masuk BERHASIL Dimasukkan");
                history.go(-2);
            </script>
        ';
        exit();
        }else{
            echo '
            <script>
                alert("Data Barang Masuk GAGAL Dimasukkan");
                history.go(-2);
            </script>
            ';
        }
    }

?>
