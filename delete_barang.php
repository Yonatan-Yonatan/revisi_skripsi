<?php 
include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}

     $id_produk = $_GET['id_produk'];
 
     $sSQL=" delete from produk
              where id_produk='$id_produk'";
        
    
     if (mysqli_query($koneksi,  $sSQL)) {
            echo '
        <script>
            alert("Data Barang BERHASIL Di Hapus");
            window.location.href="index.php";
        </script>
        ';
        exit();
     }	
     else
     echo '
     <script>
         alert("Data Barang GAGAL Di Hapus");
         window.location.href="index.php";
     </script>
     '; 		    		  
?>
