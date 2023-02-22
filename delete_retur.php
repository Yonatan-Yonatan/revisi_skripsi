<?php 
include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}

     $id_retur = $_GET['id_retur'];

     $select=" select * from retur_barang where id_retur='$id_retur' limit 1";
        $result=mysqli_query($koneksi, $select);
        if (mysqli_num_rows($result) > 0) 
        {
            while ($row=mysqli_fetch_assoc($result))
            {
                $id_produk = $row['id_produk'];
                $stok = $row['quantity'];
            }
        }	 
        $getdata = mysqli_query($koneksi, "select * from produk where id_produk='$id_produk'");
        $data = mysqli_fetch_array($getdata);
        $qty = $data['qty'];

        $selisih = $qty + $stok;
        $update = mysqli_query($koneksi,"update produk set qty='$selisih' where id_produk='$id_produk'");

     $sSQL= mysqli_query($koneksi, " delete from  retur_barang where id_retur='$id_retur'");
        
    
     if ($update &&  $sSQL) {
            header("location:retur.php");
            exit();
     }	
     else
           echo "Error: " . $sSQL . "<br>" . mysqli_error($conn);	  		  
    


?>
