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
    $id_supplier = $_POST['id_supplier'];
    $quantity = $_POST['quantity'];
    $deskripsi   = $_POST['deskripsi'];
    $id = $_SESSION['id'];

    
    $cekstok = mysqli_query($koneksi, "select * from produk where id_produk= '$id_produk[0]'");
    $ambil_data_stok = mysqli_fetch_array($cekstok);

    $data_stok = $ambil_data_stok['qty'];

    if ($data_stok >= $quantity) {
        $kurang_stok = $data_stok - $quantity;

        $query = mysqli_query($koneksi, "INSERT INTO retur_barang (id_produk, id_supplier, quantity, deskripsi,id) VALUES ('$id_produk[0]', '$id_supplier', '$quantity', '$deskripsi','$id')");
        $update_stok = mysqli_query($koneksi, "update produk set qty='$kurang_stok' where id_produk='$id_produk[0]'");
        if ($query && $update_stok){
            header("location:retur.php");
            exit();
        }else{
            echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>';
        }
    } else {
        echo '
        <script>
            alert("Stock Saat Ini Tidak Mencukupi");
            window.location.href="add_retur.php";
        </script>
        ';
    }
}

?>
