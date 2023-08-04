<?php

include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}

if(isset($_POST['simpan'])){
    $no_faktur = $_POST['no_faktur'];
    $supplier = $_POST['supplier'];
    $tanggal = $_POST['tanggal'];
    $id = $_SESSION['id'];

    $query = mysqli_query($koneksi, "INSERT INTO transaksi_masuk (no_faktur, id_supplier, tanggal,id) VALUES ('$no_faktur', '$supplier', '$tanggal','$id')");
    if ($query){
        echo '
            <script>
                alert("Data Barang Masuk BERHASIL Dimasukkan");
                window.location.href="restock_barang.php";
            </script>
        ';
        exit();
        }else{
            echo '
            <script>
                alert("Data Barang Masuk GAGAL Dimasukkan");
                window.location.href="restock_barang.php";
            </script>
            ';
        }
    }

?>
