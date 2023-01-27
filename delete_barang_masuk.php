<?php 
include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}

     $id_masuk = $_GET['id_masuk'];
 
     
     $sSQL=" delete from barang_masuk 
              where id_masuk='$id_masuk'";
        
    
     if (mysqli_query($koneksi,  $sSQL)) {
            header("location:barang_masuk.php");
            exit();
     }	
     else
           echo "Error: " . $sSQL . "<br>" . mysqli_error($conn);	  		  
    


?>
