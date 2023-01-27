<?php 
include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}

     $ID = $_GET['id_supplier'];
 
     $sSQL=" delete from supplier 
              where id_supplier='$ID'";
        
    
     if (mysqli_query($koneksi,  $sSQL)) {
            header("location:supplier.php");
            exit();
     }	
     else
           echo "Error: " . $sSQL . "<br>" . mysqli_error($conn);	  		  
    


?>
