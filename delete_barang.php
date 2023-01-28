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
            header("location:index.php");
            exit();
     }	
     else
           echo "Error: " . $sSQL . "<br>" . mysqli_error($conn);	  		  
    


?>
