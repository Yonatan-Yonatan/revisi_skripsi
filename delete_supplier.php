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
            echo '
            <script>
                alert("Data Supplier BERHASIL Di Hapus");
                window.location.href="supplier.php";
            </script>
            ';
            exit();
         }	
         else
         echo '
         <script>
             alert("Data Supplier GAGAL Di Hapus");
             window.location.href="supplier.php";
         </script>
         ';  		  
    		  
?>
