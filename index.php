<?php 
include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}
    else{
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
	function konfirmasi()
	{
	 	if (!confirm('Yakin hapus data ini ?'))
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
                        <h1 class="mt-4" style="padding-bottom:15px";>Stok Barang</h1>
                        <div class="card mb-4">
                            <div class="card-body">
                                <?php 
                                    $datastok = mysqli_query($koneksi, "select * from produk where qty < 1");
                                    while ($fetch=mysqli_fetch_array($datastok)){
                                        $nama_produk = $fetch['nama_produk'];
                                    
                                ?>
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        <strong>Perhatian!</strong> Stok <?=$nama_produk;?> Telah Habis
                                    </div>
                               
                               <?php
                                    }

                                    $datastok1 = mysqli_query($koneksi, "select * from produk where qty < 10 and qty > 0");
                                    while ($fetch=mysqli_fetch_array($datastok1)){
                                        $nama_produk = $fetch['nama_produk'];
                                        $qty = $fetch['qty'];
                                    
                                ?>
                                    <div class="alert alert-warning alert-dismissible">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        <strong>Perhatian!</strong> Stok <?=$nama_produk;?> Hanya Tersisa <?=$qty;?>. Harap Direstock!
                                    </div>
                                <?php
                                    }
                                ?>

                                <?php if($_SESSION['level'] == "owner" || $_SESSION['level'] == "admin"){?>
                                    <a href="add_barang.php"><button type="button" class="btn btn-outline-primary">Add Barang</button></a>
                                    <a href="print_laporan_stok.php" target="_BLANK"><button type="button" class="btn btn-outline-success">Print</button></a><br><br>
                                <?php } ?>
                                <div class="table-responsive">
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                                <th>Nama Produk</th>
                                                <th>Jenis Produk</th>   
                                                <th>Stok</th>  
                                                <th>Harga</th>        
                                                <th>Supplier</th>  
                                                <?php if($_SESSION['level'] == "owner"){?>
                                                <th>Action</th>          
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $sSQL="";
                                                $sSQL="select * from produk p, supplier s where p.id_supplier = s.id_supplier  order  by id_produk";
                                                $result=mysqli_query($koneksi, $sSQL);
                                                if (mysqli_num_rows($result) > 0) 
                                                {
                                                    while ($row=mysqli_fetch_assoc($result))
                                                    {
                                                        $id_produk = $row['id_produk'];
                                                        $nama_produk = $row['nama_produk'];
                                                        $jenis_produk = $row['jenis_barang'];
                                                        $qty= $row['qty'];
                                                        $harga= $row['harga'];
                                                        $nama_supplier=$row['nama_supplier'];
                                            ?>		
                                                                
                                                <tr>
                                                    <td><?php echo $nama_produk;?></td>
                                                    <td><?php echo $jenis_produk;?></td>
                                                    <td><?php echo $qty;?></td>
                                                    <td><?php echo FormatUang($harga);?></td>
                                                    <td><?php echo $nama_supplier;?></td>
                                                    <?php if($_SESSION['level'] == "owner"){?>
                                                    <td><?php echo "<a href='update_barang.php?id_produk=$id_produk' class='action'>UPDATE</a> | 
                                                                    <a href='delete_barang.php?id_produk=$id_produk' class='action' onclick='return konfirmasi();'>DELETE</a>"; ?> </td>
                                                    <?php } ?>
                                                </tr>

                                            <?php	   
                                                    }
                                                } 
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                           <div class="text-muted"><sup>&copy;</sup>2023 Wahana Service. All Rights Reserved</div>
                        </div>
                    </div>
                </footer>
            </div>
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
