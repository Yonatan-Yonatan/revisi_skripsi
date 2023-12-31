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
	 	if (!confirm('Yakin hapus data ini ? Menghapus data ini JUGA AKAN MENGHAPUS DATA BARANG MASUK, BARANG KELUAR DAN RETUR DARI PRODUK INI !!!'))
		{
			return false;
        }
		else
		{ 
			return true;		
		}
	}
    </script>
    <?php 
    function FormatUang($harga){
            $hasil = "Rp " . number_format($harga,2,',','.');
            return $hasil;}
    ?>

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
                                <div class="table-responsive">
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                                <th>Nama Produk</th>
                                                <th>Jenis Produk</th> 
                                                <?php if($_SESSION['level'] != "kasir"){?>  
                                                <th>Stok</th>  
                                                <?php } ?> 
                                                <?php if($_SESSION['level'] != "admin"){?>
                                                <th>Harga</th>  
                                                <?php } ?>
                                                <?php if($_SESSION['level'] == "owner"){?>      
                                                <th>Min Stok</th>  
                                                <th>Action</th>          
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $sSQL="";
                                                $sSQL="select * from produk order  by id_produk";
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
                                                        $min_stok=$row['min_qty'];
                                                     
                                            ?>		
                                                                
                                                <tr>
                                                    <td><?php echo $nama_produk;?></td>
                                                    <td><?php echo $jenis_produk;?></td>
                                                    <?php if($_SESSION['level'] != "kasir"){?>
                                                    <td><?php echo $qty;?></td>
                                                    <?php } ?>
                                                    <?php if($_SESSION['level'] != "admin"){?>
                                                    <td><?php echo FormatUang($harga);?></td>
                                                    <?php } ?>
                                                    <?php if($_SESSION['level'] == "owner"){?>
                                                    <td><?php echo $min_stok;?></td>
                                                    <td><?php echo "<a href='update_barang.php?id_produk=$id_produk' class='action'>UPDATE</a>"; ?> </td>
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
                    <?php if($_SESSION['level'] == "owner" || $_SESSION['level'] == "admin"){?>
                        <a href="add_barang.php" class="act-btn">
                            +
                        </a>
                    <?php } ?>

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