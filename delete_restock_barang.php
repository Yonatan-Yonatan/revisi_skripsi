<?php 
include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}

if(isset($_POST['submit'])){
       $id_masuk = $_POST['id_masuk'];
       $stok = $_POST['stok'];
       $id_produk = $_POST['id_produk'];

       $datastock = mysqli_query($koneksi, "select * from produk where id_produk='$id_produk'");
       $data = mysqli_fetch_array($datastock);
       $stokbarang = $data['qty'];

echo "id masuk : ", $id_masuk;
      echo "stok : ",$stok;
      echo "id produk : ",$id_produk;
      echo "stok : ",$stokbarang;

}

?>
