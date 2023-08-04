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
                        <h1 class="mt-4" style="padding-bottom:15px";>Data Barang Masuk</h1>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                                <th>No Transaksi</th>
                                                <th>Tanggal</th>
                                                <th>Supplier</th>   
                                                <th>Total Barang</th> 
                                                <th>PIC</th> 
                                                <th>Action</th>          
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $sSQL = "SELECT tm.id_tr_masuk, tm.no_faktur, tm.tanggal, s.nama_supplier, u.fullname,
                                            SUM(IF(bm.stok IS NOT NULL, 1, 0)) AS not_null_subtotal,
                                            SUM(IF(bm.stok IS NULL, 1, 0)) AS null_subtotal
                                            FROM transaksi_masuk tm
                                            LEFT JOIN supplier s ON s.id_supplier = tm.id_supplier
                                            LEFT JOIN user u ON u.id = tm.id
                                            LEFT JOIN barang_masuk bm ON bm.id_tr_masuk = tm.id_tr_masuk
                                            GROUP BY tm.id_tr_masuk, tm.no_faktur, tm.tanggal, s.nama_supplier, u.fullname
                                            ORDER BY tm.id_tr_masuk DESC";

                                            $result = mysqli_query($koneksi, $sSQL);

                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $no_faktur = $row['no_faktur'];
                                                    $tanggal = $row['tanggal'];
                                                    $nama_supplier = $row['nama_supplier'];
                                                    $fullname = $row['fullname'];
                                                    $id_tr_masuk = $row['id_tr_masuk'];
                                                    $not_null_subtotal = $row['not_null_subtotal'];
                                                    $null_subtotal = $row['null_subtotal'];        
                                        ?>
                                                                
                                                <tr>
                                                    <td><?php echo $no_faktur;?></td>
                                                    <td><?php echo date('d M Y', strtotime($tanggal));?></td>
                                                    <td><?php echo $nama_supplier;?></td>
                                                    <td><?php echo $not_null_subtotal;?></td>
                                                    <td><?php echo $fullname;?></td>
                                                    <td><?php echo "<a href='detail_restock.php?id_tr_masuk=$id_tr_masuk' class='action'>DETAIL</a>
                                                     | <a href='update_restock_barang.php?id_tr_masuk=$id_tr_masuk' class='action' >UPDATE</a>";?> </td>
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
                    <a href="add_restock_barang.php" class="act-btn">
                        +
                    </a>
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
