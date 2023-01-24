<?php 
include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}

     $id = $_GET['id'];
 
     $sSQL=" delete from user 
              where id='$id'";
        
    
     if (mysqli_query($koneksi,  $sSQL)) {
            header("location:user.php");
            exit();
     }	
     else
           echo "Error: " . $sSQL . "<br>" . mysqli_error($conn);	  		  
    


?>
