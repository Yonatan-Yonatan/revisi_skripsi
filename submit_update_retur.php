<?php

include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}

if(isset($_POST['simpan'])){
    $id_retur   = $_POST['id_retur'];
    $id_produk   = $_POST['id_produk'];
    $id_supplier   = $_POST['id_supplier'];
    $stoklama   = $_POST['stoklama'];
    $quantity   = $_POST['quantity'];
    $deskripsi   = $_POST['deskripsi'];


    $cekstok = mysqli_query($koneksi, "select * from produk where id_produk= '$id_produk'");
    $ambil_data_stok = mysqli_fetch_array($cekstok);

    $data_stok = $ambil_data_stok['qty'];
    $tambah_stok = ($data_stok + $stoklama);
    $update_stok_lama = mysqli_query($koneksi, "update produk set qty='$tambah_stok' where id_produk='$id_produk'");
    $cekstok_lama = mysqli_query($koneksi, "select * from produk where id_produk= '$id_produk'");
    $ambil_data_stok_lama = mysqli_fetch_array($cekstok_lama);

    $data_stok_lama = $ambil_data_stok_lama['qty'];
    
    if ($data_stok_lama >= $quantity) {
        $kurang_stok = ($data_stok + $stoklama) - $quantity;

        $query = mysqli_query($koneksi, "update retur_barang set id_produk='$id_produk', id_supplier='$id_supplier',quantity='$quantity',deskripsi='$deskripsi' where id_retur='$id_retur'");
        $update_stok = mysqli_query($koneksi, "update produk set qty='$kurang_stok' where id_produk='$id_produk'");
        if ($query && $update_stok){
            header("location:retur.php");
            exit();
        }else{
            echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>';
        }
    } else {
        
        $cekstok_baru = mysqli_query($koneksi, "select * from produk where id_produk= '$id_produk'");
        $ambil_data_stok_baru = mysqli_fetch_array($cekstok_baru);

        $data_stok_baru = $ambil_data_stok_baru['qty'];
        $kurang_stok_lama = ($data_stok_baru - $stoklama);
        $update_stok_baru = mysqli_query($koneksi, "update produk set qty='$kurang_stok_lama' where id_produk='$id_produk'");
        echo '
        <script>
            alert("Stock Saat Ini Tidak Mencukupi");
            window.location.href="retur.php";
        </script>
        ';
    }
}

?>
