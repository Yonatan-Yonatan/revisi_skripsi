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
    $jumlah_barang   = $_POST['jumlah_barang'];
    $total_harga   = $_POST['total_harga'];
    $deskripsi   = $_POST['deskripsi'];


    $cekstok = mysqli_query($koneksi, "select * from produk where id_produk= '$id_produk[0]'");
    $ambil_data_stok = mysqli_fetch_array($cekstok);

    $data_stok = $ambil_data_stok['qty'];

    if ($data_stok >= $jumlah_barang) {
        $kurang_stok = $data_stok - $jumlah_barang;

        $query = mysqli_query($koneksi, "INSERT INTO barang_keluar (id_produk, jumlah_barang, total_harga, deskripsi) VALUES ('$id_produk[0]', '$jumlah_barang', '$total_harga', '$deskripsi')");
        $update_stok = mysqli_query($koneksi, "update produk set qty='$kurang_stok' where id_produk='$id_produk[0]'");
        if ($query && $update_stok){
            header("location:barang_keluar.php");
            exit();
        }else{
            echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>';
        }
    } else {
        echo '
        <script>
            alert("Stock Saat Ini Tidak Mencukupi");
            window.location.href="add_barang_keluar.php";
        </script>
        ';
    }
}

?>
