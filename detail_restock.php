<?php 
include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}
    else{
    }

if($_SESSION['level'] == "kasir"){
    echo '
        <script>
            alert("Maaf anda tidak memiliki akses");
            javascript:window.history.go(-1);
        </script>
    ';
} 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Inventory Wahana Service</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <script>

    <?php 
        $id_tr_masuk=$_GET['id_tr_masuk'];
        
    ?>
	function konfirmasi()
	{
	 	if (!confirm('Yakin Ingin Batalin Input Data Ini ?'))
		{
			return false;
        }
		else
		{ 
			return true;		
		}
	}
    </script>
    <body class="sb-nav-fixed">
    <?php include "head.php"; ?>
        <div id="layoutSidenav">
        <?php include "menu.php"; ?>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                    <a href="restock_barang.php" class="btn btn-primary mt-3"><i class="fa-solid fa-arrow-left">Kembali</i></a>
                        <h1 class="mt-4" style="padding-bottom:15px";>Data Transaksi Masuk <?=$id_tr_masuk?></h1>
                        <div class="container-fluid px-4">
                        <br>   
                            <div class="table-responsive">
                                <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nama Barang</th>
                                                <th>Quantity</th>
                                                
                                                <?php if($_SESSION['level'] == "owner"){?>
                                                <th>Action</th>          
                                                <?php } else if ($_SESSION['level'] == "admin"){?>
                                                <th>Status</th>
                                                <?php } ?> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $sSQL="";
                                                $sSQL="select * from barang_masuk m, transaksi_masuk tm, produk p where m.id_tr_masuk = tm.id_tr_masuk and p.id_produk = m.id_produk and m.id_tr_masuk = '$id_tr_masuk'";
                                                $result=mysqli_query($koneksi, $sSQL);
                                                if (mysqli_num_rows($result) > 0) 
                                                {
                                                    while ($row=mysqli_fetch_assoc($result))
                                                    {
                                                        $produk = $row['nama_produk'];
                                                        $stok = $row['stok'];
                                                        $status_bmasuk = $row['status_bmasuk'];
                                                        $id_masuk = $row['id_masuk'];
                                                       
                                            ?>		
                                                                
                                                <tr>
                                                    <td><?php echo $produk;?></td>
                                                    <td><?php echo $stok;?></td>
                                                    <?php if($_SESSION['level'] == "owner"){
                                                        if ($status_bmasuk == 0){ ?>
                                                    <td><?php echo "<a href='cancel_bmasuk.php?id_masuk=$id_masuk' class='action' onclick='return konfirmasi();' >CANCEL</a>";?></td>
                                                       <?php }else{ ?>
                                                           <td> CANCELED </td>
                                                       <?php }} else if($_SESSION['level'] == "admin"){
                                                        if ($status_bmasuk == 0){ ?>
                                                    <td>VALID</td>
                                                       <?php }else{ ?>
                                                           <td> CANCELED </td>
                                                       <?php }} ?>
                                                </tr>
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    <?php echo "<a href='add_detail_restock.php?id_tr_masuk=$id_tr_masuk' class='act-btn'>
                        +
                    </a>"?>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                           <div class="text-muted"><sup>&copy;</sup>2023 Wahana Service. All Rights Reserved</div>
                        </div>
                    </div>
                </footer>
            </div>
     
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    
    
    
    </body>
</html>
