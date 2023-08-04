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
    $no_nota = $_POST['no_nota'];
    $jumlah_barang   = $_POST['jumlah_barang'];
    $total_harga   = $_POST['total_harga'];

    $cekstok = mysqli_query($koneksi, "select * from produk where id_produk= '$id_produk[0]'");
    $ambil_data_stok = mysqli_fetch_array($cekstok);

    $data_stok = $ambil_data_stok['qty'];

    $ceksubtotal = mysqli_query($koneksi, "select * from transaksi_keluar where no_nota= '$no_nota'");
    $ambil_data_subtotal = mysqli_fetch_array($ceksubtotal);

    $data_subtotal = $ambil_data_subtotal['subtotal'];

    $subtotalbaru = $data_subtotal + $total_harga;

    if ($data_stok >= $jumlah_barang) {
        $kurang_stok = $data_stok - $jumlah_barang;

        $query = mysqli_query($koneksi, "INSERT INTO barang_keluar (id_produk, jumlah_barang, total_harga, no_nota) VALUES ('$id_produk[0]', '$jumlah_barang', '$total_harga', '$no_nota')");
        $update_stok = mysqli_query($koneksi, "update produk set qty='$kurang_stok' where id_produk='$id_produk[0]'");
        $update_subtotal = mysqli_query($koneksi, "update transaksi_keluar set subtotal=' $subtotalbaru' where no_nota='$no_nota'");
        if ($query && $update_stok &&  $update_subtotal){
            echo '
            <script>
                alert("Data Barang Keluar BERHASIL Dimasukkan");
                history.go(-2);
            </script>
        ';
        exit();
        }else{
            echo '
            <script>
                alert("Data Barang Keluar GAGAL Dimasukkan");
                history.go(-2);
            </script>
            ';
        }
    } else {
        echo '
        <script>
            alert("Stock Saat Ini Tidak Mencukupi");
            history.go(-2);
        </script>
        ';
    }
}

?>
