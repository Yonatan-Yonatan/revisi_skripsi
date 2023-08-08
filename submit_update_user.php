<?php
	require "conn.php";
	session_start();
  	
  	$id = $_POST['id'];
  	$username= $_POST['username'];
  	$fullname= $_POST['fullname'];
	$level= $_POST['level'];
    $email= $_POST['email'];

  
  	$sSQL= "update user set username='$username', fullname='$fullname',email='$email' ,level='$level'
             where id='$id' ";
	
 	if (mysqli_query($koneksi,  $sSQL)) 
	{
		echo '
            <script>
                alert("Data User BERHASIL Di Ubah");
                window.location.href="user.php";
            </script>
            ';
            exit();
        }else{
            echo '
            <script>
                alert("Data User GAGAL Di Ubah");
                window.location.href="user.php";
            </script>
            ';
        }      
	mysqli_close($koneksi); 
?>