<?php
	require "conn.php";
	session_start();
  	
  	$id = $_POST['id'];
  	$username= $_POST['username'];
  	$fullname= $_POST['fullname'];
	$password = sha1($_POST['password']);
	$level= $_POST['level'];
  
  	$sSQL= "update user set username='$username', fullname='$fullname',password='$password',level='$level'
             where id='$id' ";
	
 	if (mysqli_query($koneksi,  $sSQL)) 
	{
		echo '
		<script>
			alert("Password BERHASIL Di Ubah");
			window.location.href="index.php";
		</script>
		';
		exit();
	}else{
		echo '
		<script>
			alert("Password GAGAL Di Ubah");
			window.location.href="index.php";
		</script>
		';
	}   
	mysqli_close($koneksi); 
?>