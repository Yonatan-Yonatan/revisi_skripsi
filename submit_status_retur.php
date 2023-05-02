<?php

include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}

if(isset($_POST['simpan'])){
    $id_retur   = $_POST['id_retur'];
    $id_produk   = $_POST['id_produk'];
    $id_supplier   = $_POST['id_supplier'];
    $stoklama   = $_POST['stoklama'];
    $quantity   = $_POST['quantity'];
    $status = $_POST['status'];


    $cekstok = mysqli_query($koneksi, "select * from produk where id_produk= '$id_produk'");
    $ambil_data_stok = mysqli_fetch_array($cekstok);

    $data_stok = $ambil_data_stok['qty'];
    
        if ($status=="Diajukan" || $status=="Diambil"){
            $kurang_stok = ($data_stok + $stoklama) - $quantity;
            $query = mysqli_query($koneksi, "update retur_barang set id_produk='$id_produk', id_supplier='$id_supplier',quantity='$quantity', status='$status' where id_retur='$id_retur'");
            $update_stok = mysqli_query($koneksi, "update produk set qty='$kurang_stok' where id_produk='$id_produk'");
            if ($query && $update_stok){
                echo '
                <script>
                    alert("Status Retur BERHASIL Di Ubah");
                    window.location.href="retur.php";
                </script>
                ';
                exit();
            }else{
                echo '
                <script>
                    alert("Status Retur GAGAL Di Ubah");
                    window.location.href="retur.php";
                </script>
                ';
            }
        } 
        else if ($status=="Selesai"){
            $ubah_stok = ($data_stok + $stoklama) - $quantity;
            $ubah_stok2 = $ubah_stok + $quantity;
            $query = mysqli_query($koneksi, "update retur_barang set id_produk='$id_produk', id_supplier='$id_supplier',quantity='$quantity', status='$status' where id_retur='$id_retur'");
            $update_stok = mysqli_query($koneksi, "update produk set qty='$ubah_stok2' where id_produk='$id_produk'");
            
            if ($query && $update_stok){
                echo '
                <script>
                    alert("Status Retur Barang BERHASIL Di Ubah");
                    window.location.href="retur.php";
                </script>
                ';
                exit();
            }else{
                echo '
                <script>
                    alert("Status Retur Barang GAGAL Di Ubah");
                    window.location.href="retur.php";
                </script>
                ';
            }
        }
    }
?>
