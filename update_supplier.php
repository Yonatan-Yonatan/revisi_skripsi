<?php 
include "conn.php"; 
session_start();
   	if (empty($_SESSION['isLoggedin']))
    {
	    header("location: logout.php");
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
        
        $ID=$_GET['id_supplier'];
    
        $sSQL=" select * from supplier where id_supplier='$ID' limit 1";
        $result=mysqli_query($koneksi, $sSQL);
        if (mysqli_num_rows($result) > 0) 
        {
            while ($row=mysqli_fetch_assoc($result))
            {
                $nama = $row['nama_supplier'];
                $alamat = $row['alamat'];
                $no_telp= $row['no_telp'];
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
                    <h1 class="mt-4" style="padding-bottom:15px";>Edit Supplier</h1>
                    <form action="submit_update_supplier.php" class="form" method="post"> 
                    <label-form for="id_supplier">&nbsp;
                        ID Supplier
                    </label-form>
                    <input id="id_supplier" class="form-control" type="text" name="id_supplier" value="<?php echo $ID;?>" readonly/>
                    <label-form for="nama_supplier">&nbsp;
                        Nama Supplier
                    </label-form>
                    <input id="nama_supplier" class="form-control" type="text" name="nama_supplier" value="<?php echo $nama;?>" required/>
                    <label-form for="alamat">&nbsp;
                        Alamat
                    </label-form>
                    <input id="alamat" class="form-control" type="text" name="alamat" value="<?php echo $alamat;?>" required/>
                    <label-form for="no_telp">&nbsp;
                        Nomor Telepon
                    </label-form>
                    <input id="no_telp" class="form-control" type="number" name="no_telp" value="<?php echo $no_telp;?>" required/>   
                       
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <input type="submit" name="simpan" value="Simpan" class="btn btn-sm btn-primary" />&nbsp;
	                            <a href="supplier.php" class="btn btn-sm btn-danger">Batal </a>
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
            function showPassword()
            {
                var x = document.getElementById("password");
                if (x.type === "password") 
                {
                    x.type = "text";
                } 
                else 
                {
                    x.type = "password";
                }
            }
        </script>
    </body>
</html>
