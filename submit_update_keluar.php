<?php

include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}

if(isset($_POST['simpan'])){
    $no_nota   = $_POST['no_nota'];
    $tanggal   = $_POST['tanggal'];
    $ket   = $_POST['ket'];
 
    $query = mysqli_query($koneksi, "update transaksi_keluar set tanggal='$tanggal', ket='$ket' where no_nota ='$no_nota'");
    if ($query){
        echo '
            <script>
                alert("Transaksi Keluar BERHASIL Di Ubah");
                window.location.href="barang_keluar.php";
            </script>
        ';
        exit();
    }else{
        echo '
            <script>
                alert("Transaksi Keluar GAGAL Di Ubah");
                window.location.href="barang_keluar.php";
            </script>
        ';
    }
}

?>
