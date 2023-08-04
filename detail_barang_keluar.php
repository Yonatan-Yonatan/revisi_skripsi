<?php 
include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}
    else{
    }
if($_SESSION['level'] == "admin"){
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
        $no_nota=$_GET['no_nota'];
        
        $sSQL=" select * from transaksi_keluar where no_nota = '$no_nota' limit 1";
        $result=mysqli_query($koneksi, $sSQL);
        if (mysqli_num_rows($result) > 0) 
        {
            while ($row=mysqli_fetch_assoc($result))
            {
                $status_print = $row['status_print'];
            }
        }	 
    ?>

	function konfirmasiPrint()
	{
	 	if (!confirm('Yakin Ingin Mencetak Nota ?'))
		{
			return false;
        }
		else
		{ 
			return true;		
		}
	}
    function konfirmasiCancel()
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
                    <a href="barang_keluar.php" class="btn btn-primary mt-3"><i class="fa-solid fa-arrow-left">Kembali</i></a>
                        <h1 class="mt-4" style="padding-bottom:15px";>Data Transaksi Keluar Nota <?=$no_nota?></h1>
                        <div class="card mb-4">
                            <div class="card-body">
                            <br>   
                            <div class="table-responsive">
                                <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Quantity</th>
                                                <th>Nama Produk</th>
                                                <th>Harga Produk</th>   
                                                <th>Total Harga</th> 
                                                <?php if ($status_print == 0){?>
                                                <th>Action</th>         
                                                <?php } else {?>
                                                <th>Status</th>
                                                <?php } ?>    
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $sSQL="";
                                                $sSQL="select * from barang_keluar k, produk p, transaksi_keluar tk where tk.no_nota = k.no_nota and k.id_produk = p.id_produk and k.no_nota = '$no_nota'";
                                                $result=mysqli_query($koneksi, $sSQL);
                                                if (mysqli_num_rows($result) > 0) 
                                                {
                                                    while ($row=mysqli_fetch_assoc($result))
                                                    {
                                                        $id_keluar = $row['id_keluar'];
                                                        $id_produk = $row['id_produk'];
                                                        $nama_produk = $row['nama_produk'];
                                                        $harga = $row['harga'];
                                                        $jumlah= $row['jumlah_barang'];
                                                        $totalharga = $row['total_harga'];
                                                        $status_bkeluar = $row['status_bkeluar'];
                                                     
                                            ?>		
                                                                
                                                <tr>
                                                    <td><?php echo $jumlah;?></td>
                                                    <td><?php echo $nama_produk;?></td>
                                                    <td><?php echo FormatUang($harga);?></td>
                                                    <td><?php echo FormatUang($totalharga);?></td>
                                                    <?php 
                                                    if ($status_print == 0){
                                                        if ($status_bkeluar == 0){ ?>
                                                            <td><?php echo "<a href='cancel_bkeluar.php?id_keluar=$id_keluar' class='action' onclick='return konfirmasiCancel();' >CANCEL</a>";?></td>
                                                        <?php }
                                                        else{ ?>
                                                           <td> CANCELED </td>
                                                        <?php } 
                                                    }else{ 
                                                        if ($status_bkeluar == 0){ ?>
                                                            <td>VALID</td>
                                                        <?php }
                                                        else{ ?>
                                                           <td> CANCELED </td>
                                                        <?php }} 
                                                        ?>
                                                    
                                                </tr>
                                                <?php	   
                                                    }
                                                    $subtotal = mysqli_query($koneksi, "select SUM(total_harga) AS subtotal from barang_keluar  where no_nota = '$no_nota' and status_bkeluar = '0';");
                                                    $row1 = mysqli_fetch_array($subtotal);

                                                    $sub_total_harga=$row1['subtotal'];
                                                    
                                                ?>	                         
                                                <tr>   
                                                    <td colspan="3" class="subtotal" style="text-align:center">Subtotal</td>
                                                    <td colspan="1"><?php echo FormatUang($sub_total_harga);?></td>
                                                    <td colspan="1"></td>
                                                
                                                </tr>
                                                <?php
                                                }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <form method="POST" action="print_nota_keluar.php" target="_BLANK">
                                                <div class="col-sm-4" style="padding-bottom:15px">
                                                    <input type="hidden" name="no_nota" class="filter-form-control" value="<?php echo $_GET['no_nota'];?>">
                                                    <input type="hidden" name="status_print" class="filter-form-control" value="1">
                                                </div>
                                                <input type="submit" name="print" value="PRINT" onclick='return konfirmasiPrint();' class="btn btn-sm btn-primary" />&nbsp
                                            </form>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                    <?php 
                    if ($status_print == 0){
                        echo "<a href='add_detail_keluar.php?no_nota=$no_nota' class='act-btn'>
                                +
                            </a>";
                    }
                    ?>
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
