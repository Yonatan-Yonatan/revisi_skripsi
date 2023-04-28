<?php

include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}

if(isset($_POST['simpan'])){
    $id_keluar   = $_POST['id_keluar'];
    $id_produk   = $_POST['id_produk'];
    $jumlah_barang   = $_POST['jumlah_barang'];
    $stoklama   = $_POST['stoklama'];
    $total_harga   = $_POST['total_harga'];
    $deskripsi   = $_POST['deskripsi'];


    $cekstok = mysqli_query($koneksi, "select * from produk where id_produk= '$id_produk'");
    $ambil_data_stok = mysqli_fetch_array($cekstok);

    $data_stok = $ambil_data_stok['qty'];
    $tambah_stok = ($data_stok + $stoklama);
    $update_stok_lama = mysqli_query($koneksi, "update produk set qty='$tambah_stok' where id_produk='$id_produk'");
    $cekstok_lama = mysqli_query($koneksi, "select * from produk where id_produk= '$id_produk'");
    $ambil_data_stok_lama = mysqli_fetch_array($cekstok_lama);

    $data_stok_lama = $ambil_data_stok_lama['qty'];
    
    if ($data_stok_lama >= $jumlah_barang) {
        $kurang_stok = ($data_stok + $stoklama) - $jumlah_barang;

        $query = mysqli_query($koneksi, "update barang_keluar set id_produk='$id_produk', jumlah_barang='$jumlah_barang',total_harga='$total_harga',deskripsi='$deskripsi' where id_keluar='$id_keluar'");
        $update_stok = mysqli_query($koneksi, "update produk set qty='$kurang_stok' where id_produk='$id_produk'");
        if ($query && $update_stok){
            echo '
            <script>
                alert("Data Barang Keluar BERHASIL Di Ubah");
                window.location.href="barang_keluar.php";
            </script>
            ';
            exit();
        }else{
            echo '
            <script>
                alert("Data Barang Keluar GAGAL Di Ubah");
                window.location.href="barang_keluar.php";
            </script>
            ';
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
            window.location.href="barang_keluar.php";
        </script>
        ';
    }
}

?>
