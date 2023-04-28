<?php

include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}

if(isset($_POST['simpan'])){
    $nama = $_POST['nama_supplier'];
    $alamat = $_POST['alamat'];
    $no_telp= $_POST['no_telp'];

    $query = mysqli_query($koneksi, "INSERT INTO supplier (nama_supplier, alamat, no_telp) VALUES ('$nama', '$alamat', '$no_telp')");
    if ($query){
        // die();
        echo '
        <script>
            alert("Data Supplier BERHASIL Dimasukkan");
            window.location.href="supplier.php";
        </script>
    ';
    exit();
    }else{
        echo '
        <script>
            alert("Data Supplier GAGAL Dimasukkan");
            window.location.href="supplier.php";
        </script>
        ';
    }
}

?>
