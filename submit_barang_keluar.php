<?php

include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}

if(isset($_POST['simpan'])){
    $deskripsi   = $_POST['deskripsi'];
    $id = $_SESSION['id'];

    $query = mysqli_query($koneksi, "INSERT INTO transaksi_keluar (ket,id) VALUES ('$deskripsi','$id')");
    
    if ($query){
        echo '
        <script>
            alert("Transaksi Keluar BERHASIL Dimasukkan");
            window.location.href="barang_keluar.php";
        </script>
        ';
    exit();
    }else{
        echo '
        <script>
            alert("Transaksi Keluar GAGAL Dimasukkan");
            window.location.href="barang_keluar.php";
        </script>
        ';
    }
}

?>
