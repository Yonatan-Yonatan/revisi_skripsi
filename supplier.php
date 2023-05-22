<?php 
include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
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
	 	if (!confirm('Yakin hapus data ini ? Menghapus data ini JUGA AKAN MENGHAPUS DATA BARANG, BARANG MASUK DAN RETUR YANG BERASAL DARI SUPPLIER INI !!!'))
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
                        <h1 class="mt-4" style="padding-bottom:15px";>Supplier</h1>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>No. Telepon</th>
                                                <th>Action</th>         
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $sSQL="";
                                                $sSQL="select * from supplier order  by id_supplier";
                                                $result=mysqli_query($koneksi, $sSQL);
                                                if (mysqli_num_rows($result) > 0) 
                                                {
                                                    while ($row=mysqli_fetch_assoc($result))
                                                    {
                                                        $ID = $row['id_supplier'];
                                                        $nama = $row['nama_supplier'];
                                                        $alamat = $row['alamat'];
                                                        $no_telp= $row['no_telp'];
                                                        $link = "https://wa.me/" . str_replace(" ", "", $no_telp);
                                            ?>		
                                                                
                                                <tr>
                                                    <td><?php echo $nama;?></td>
                                                    <td><?php echo $alamat;?></td>
                                                    <td><?php echo"<a href='$link' target='_blank' class='action'> $no_telp</a>"?></td>
                                                    <td><?php echo "<a href='update_supplier.php?id_supplier=$ID' class='action'>UPDATE</a> | 
                                                                    <a href='delete_supplier.php?id_supplier=$ID' class='action' onclick='return konfirmasi();'>DELETE</a>"; ?> </td>
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
                    <a href="add_supplier.php" class="act-btn">
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
