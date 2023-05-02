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
                        <h1 class="mt-4" style="padding-bottom:15px";>Data Barang Retur</h1>
                        <div class="card mb-4">
                            <div class="card-body">
                            <div class="table-responsive">    
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Nama Produk</th>
                                                <th>Quantity</th>
                                                <th>Supplier</th>
                                                <th>Keterangan</th> 
                                                <th>Status</th> 
                                                <th>PIC</th>  
                                                <?php if($_SESSION['level'] == "owner"){?>
                                                <th>Action</th>          
                                                <?php } ?>       
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $sSQL="";
                                                $sSQL="select * from retur_barang r, produk p, supplier s, user u where p.id_produk = r.id_produk and s.id_supplier = r.id_supplier and r.id = u.id order by r.id_retur DESC";
                                                $result=mysqli_query($koneksi, $sSQL);
                                                if (mysqli_num_rows($result) > 0) 
                                                {
                                                    while ($row=mysqli_fetch_assoc($result))
                                                    {
                                                        $id_retur = $row['id_retur'];
                                                        $tanggal = $row['tanggal'];
                                                        $id_produk = $row['id_produk'];
                                                        $nama_produk = $row['nama_produk'];
                                                        $id_supplier = $row['nama_supplier'];
                                                        $quantity = $row['quantity'];
                                                        $deskripsi = $row['deskripsi'];
                                                        $fullname = $row['fullname'];
                                                        $status = $row['status'];
                                            ?>		
                                                                
                                                <tr>
                                                    <td><?php echo date('d M Y', strtotime($tanggal));?></td>
                                                    <td><?php echo $nama_produk;?></td>
                                                    <td><?php echo $quantity;?></td>
                                                    <td><?php echo $id_supplier;?></td>
                                                    <td><?php echo $deskripsi;?></td>
                                                    <?php if ($status =="Diajukan" || $status =="Diambil"){?>
                                                    <td><?php echo"<a href='update_status_retur.php?id_retur=$id_retur' class='action'> $status</a>"?></td>
                                                    <?php } else {?>
                                                    <td><?php echo $status;?></td>
                                                    <?php }?>
                                                    <td><?php echo $fullname;?></td>
                                                    <?php if($_SESSION['level'] == "owner"){?>
                                                    <td><?php if ($status =="Diajukan" || $status =="Diambil"){ 
                                                    echo "<a href='update_retur.php?id_retur=$id_retur' class='action'>UPDATE</a> |";} echo "
                                                                    <a href='delete_retur.php?id_retur=$id_retur' class='action' onclick='return konfirmasi();'>DELETE</a>"; ?> </td>
                                                    <?php }  ?>
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
                    <a href="add_retur.php" class="act-btn">
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
