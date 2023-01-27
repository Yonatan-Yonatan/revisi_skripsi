<?php

include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}

if(isset($_POST['simpan'])){
    $ID = $_POST['id_supplier'];
    $nama = $_POST['nama_supplier'];
    $alamat = $_POST['alamat'];
    $no_telp= $_POST['no_telp'];

    $query = mysqli_query($koneksi, "INSERT INTO supplier (nama_supplier, alamat, no_telp) VALUES ('$nama', '$alamat', '$no_telp')");
    if ($query){
        header("location:supplier.php");
        exit();
    }else{
        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>';
    }
}

?>
