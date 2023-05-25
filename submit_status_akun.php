<?php
	require "conn.php";
	session_start();
  	
  	$id = $_POST['id'];
    $status = $_POST['status']; 
  
  	$sSQL= "update user set status_akun='$status'
             where id='$id' ";
	
 	if (mysqli_query($koneksi,  $sSQL)) 
	{
		echo '
            <script>
                alert("Status Akun BERHASIL Di Ubah");
                window.location.href="user.php";
            </script>
            ';
            exit();
        }else{
            echo '
            <script>
                alert("Status Akun GAGAL Di Ubah");
                window.location.href="user.php";
            </script>
            ';
        }      
	mysqli_close($koneksi); 
?>