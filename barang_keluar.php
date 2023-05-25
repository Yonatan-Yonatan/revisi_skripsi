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
                        <h1 class="mt-4" style="padding-bottom:15px";>Data Barang Keluar</h1>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Nama Produk</th>
                                                <th>Harga Produk</th>   
                                                <th>Quantity</th>
                                                <th>Total Harga</th>
                                                <th>Keterangan</th> 
                                                <th>PIC</th>   
                                                <?php if($_SESSION['level'] == "owner"){?>
                                                <th>Action</th>          
                                                <?php } else if($_SESSION['level'] == "user"){ echo "";} ?>       
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $sSQL="";
                                                $sSQL="select * from barang_keluar k, produk p, user u where k.id_produk = p.id_produk and k.id = u.id order by k.id_keluar DESC";
                                                $result=mysqli_query($koneksi, $sSQL);
                                                if (mysqli_num_rows($result) > 0) 
                                                {
                                                    while ($row=mysqli_fetch_assoc($result))
                                                    {
                                                        $id_keluar = $row['id_keluar'];
                                                        $tanggal = $row['tanggal'];
                                                        $id_produk = $row['id_produk'];
                                                        $nama_produk = $row['nama_produk'];
                                                        $harga = $row['harga'];
                                                        $jumlah= $row['jumlah_barang'];
                                                        $totalharga = $row['total_harga'];
                                                        $deskripsi = $row['deskripsi'];
                                                        $fullname = $row['fullname'];

                                                        $tanggalkeluar = $tanggal;
                                                        $tanggalsekarang = date('Y-m-d');
                                                       // Konversi selisih waktu ke dalam jumlah hari
                                                        $hari = round(abs(strtotime($tanggalsekarang) - strtotime($tanggalkeluar)) / (60 * 60 * 24));
                                            ?>		
                                                                
                                                <tr>
                                                    <td><?php echo date('d M Y', strtotime($tanggal));?></td>
                                                    <td><?php echo $nama_produk;?></td>
                                                    <td><?php echo FormatUang($harga);?></td>
                                                    <td><?php echo $jumlah;?></td>
                                                    <td><?php echo FormatUang($totalharga);?></td>
                                                    <td><?php echo $deskripsi;?></td>
                                                    <td><?php echo $fullname;?></td>
                                                    <?php if($_SESSION['level'] == "owner"){?>
                                                    <td><?php echo "<a href='update_barang_keluar.php?id_keluar=$id_keluar' class='action'>UPDATE</a>";
                                                                if ($hari < 1){
                                                                   echo " | <a href='delete_barang_keluar.php?id_keluar=$id_keluar' class='action' onclick='return konfirmasi();'>DELETE</a>"; }?> </td>
                                                    <?php } else if($_SESSION['level'] == "user"){ echo "";} ?>
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
                    <a href="add_barang_keluar.php" class="act-btn">
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
