<?php

include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}

if(isset($_POST['simpan'])){
    $id_tr_masuk  = $_POST['id_tr_masuk'];
    $no_faktur   = $_POST['no_faktur'];
    $id_supplier   = $_POST['supplier'];
    $tanggal   = $_POST['tanggal'];

    $query = mysqli_query($koneksi, "update transaksi_masuk set tanggal='$tanggal', id_supplier='$id_supplier',no_faktur='$no_faktur' where id_tr_masuk='$id_tr_masuk'");
    if ($query){
        echo '
            <script>
                alert("Data Barang Masuk BERHASIL Di Ubah");
                window.location.href="restock_barang.php";
            </script>
            ';
            exit();
        }else{
            echo '
            <script>
                alert("Data Barang Masuk GAGAL Di Ubah");
                window.location.href="restock_barang.php";
            </script>
            ';
        }
}

?>
