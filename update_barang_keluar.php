<?php 
include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
 	}
if($_SESSION['level'] == "kasir" || $_SESSION['level'] == "admin"){
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

    <?php
        
        $id_keluar=$_GET['id_keluar'];

        $sSQL=" select * from barang_keluar k, produk p where k.id_keluar = '$id_keluar' and k.id_produk=p.id_produk limit 1";
        $result=mysqli_query($koneksi, $sSQL);
        if (mysqli_num_rows($result) > 0) 
        {
            while ($row=mysqli_fetch_assoc($result))
            {
                $nama_produk = $row['nama_produk'];
                $id_produk = $row['id_produk'];
                $harga = $row['harga'];
                $total_harga = $row['total_harga'];
                $jumlah_barang= $row['jumlah_barang'];
                $deskripsi= $row['deskripsi'];
            }
        }	 
    ?>  

    <body class="sb-nav-fixed">
    <?php include "head.php"; ?>
        <div id="layoutSidenav">
        <?php include "menu.php"; ?>
            </div>
            <div id="layoutSidenav_content">
                <div class="container-fluid px-4">
                    <h1 class="mt-4" style="padding-bottom:15px";>Edit Barang Keluar</h1>
                    <form action="submit_update_keluar.php" class="form" method="post"> 
                    <input id="id_keluar" class="form-control" type="hidden" name="id_keluar" value="<?php echo $id_keluar;?>" readonly/>
                    <input id="id_produk" class="form-control" type="hidden" name="id_produk" value="<?php echo $id_produk;?>" readonly/>
                    <label-form for="nama_produk">&nbsp;
                        Nama Produk
                    </label-form>
                    <input id="nama_produk" class="form-control" type="text" name="nama_produk" value="<?php echo $nama_produk;?>" readonly/>
                    <label-form for="harga">&nbsp;
                        Harga
                    </label-form>
                    <input id="harga" class="form-control" type="number" name="harga" value="<?php echo $harga;?>" readonly/>
                    <input id="stoklama" class="form-control" type="hidden" name="stoklama" value="<?php echo $jumlah_barang;?>" readonly required/>
                    <label-form for="quantity">&nbsp;
                        Quantity
                    </label-form>
                    <input onChange="Total_Harga()" id="jumlah_barang" class="form-control" type="number" min="1" name="jumlah_barang" value="<?php echo $jumlah_barang;?>" required/>
                    <label-form for="total harga">&nbsp;
                        Total Harga
                    </label-form>
                    <input id="total_harga" class="form-control" type="number" name="total_harga" value="<?php echo $total_harga;?>" readonly/>
                    <label-form for="ket">&nbsp;
                        Ket:
                    </label-form>
                    <input id="deskripsi" class="form-control" type="text" name="deskripsi" value="<?php echo $deskripsi;?>"/>

                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <input type="submit" name="simpan" value="Simpan" class="btn btn-sm btn-primary" />&nbsp;
	                            <a href="barang_keluar.php" class="btn btn-sm btn-danger">Batal </a>
                            </div>
                        </div>
                    </form>
                </div>
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

        <script>
            function Total_Harga(){
                var stok = document.getElementById("jumlah_barang");
                var hargabarang = document.getElementById("harga");
                var hargatotal = document.getElementById("total_harga");
                const hitungtotalharga = parseInt(stok.value) * parseInt(hargabarang.value);
                hargatotal.value=""+hitungtotalharga;
            }
        </script>
    </body>
</html>
