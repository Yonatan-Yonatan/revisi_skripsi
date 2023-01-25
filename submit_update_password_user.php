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
		header('location:index.php');
		exit();
 	}	
 	else
	{
       echo "Error: " . $sSQL . "<br>" . mysqli_error($koneksi);	  		  
	}	   
	mysqli_close($koneksi); 
?>