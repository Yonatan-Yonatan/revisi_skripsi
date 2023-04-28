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
            echo '
            <script>
                alert("Data User BERHASIL Di Hapus");
                window.location.href="user.php";
            </script>
            ';
            exit();
         }	
         else
         echo '
         <script>
             alert("Data User GAGAL Di Hapus");
             window.location.href="user.php";
         </script>
         ';  		  
?>
