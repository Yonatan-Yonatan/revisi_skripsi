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

    <script>
	function konfirmasi()
	{
	 	if (!confirm('Yakin hapus data ini ? Menghapus data ini JUGA AKAN MENGHAPUS DATA BARANG MASUK, BARANG KELUAR DAN RETUR YANG DISUBMIT OLEH USER INI !!!'))
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
                        <h1 class="mt-4" style="padding-bottom:15px";>User</h1>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                                <th>User Name</th>
                                                <th>Full Name</th>
                                                <th>Level</th>
                                                <th>Status</th>
                                                <th>Action</th>         
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $sSQL="";
                                                $sSQL="select * from user order by (status_akun) ASC";
                                                $result=mysqli_query($koneksi, $sSQL);
                                                if (mysqli_num_rows($result) > 0) 
                                                {
                                                    while ($row=mysqli_fetch_assoc($result))
                                                    {
                                                        $ID = $row['id'];
                                                        $UserName = $row['username'];
                                                        $FullName = $row['fullname'];
                                                        $level= $row['level'];
                                                        $status= $row['status_akun'];
                                                        if ($status == "0") {
                                                            $status_akun = "ACTIVE";        
                                                        } else {
                                                            $status_akun = "INACTIVE";
                                                        }
                                            ?>		
                                                                
                                            <tr>
                                                <td><?php echo $UserName;?></td>
                                                <td><?php echo $FullName;?></td>
                                                <td><?php echo $level;?></td>
                                                <td><?php if ($UserName != "owner" && $FullName != "Owner"){
                                                             if ($status == "0"){ 
                                                                echo "<a href='#active$ID' data-bs-toggle='modal' class='action'>$status_akun";
                                                             }  else if ($status == "1"){ 
                                                                echo "<a href='#nonactive$ID' data-bs-toggle='modal' class='action'>$status_akun";
                                                             }
                                                            } else {
                                                                echo $status_akun;
                                                            }?>
                                                </td>
                                                <td><?php if ($status == "0"){ 
                                                            if ($UserName == "owner" && $FullName == "Owner"){ 
                                                                echo "<a href='update_password.php?id=$ID' class='action'>UPDATE PASSWORD</a>";
                                                            } else {
                                                                echo "<a href='update_user.php?id=$ID' class='action'>UPDATE</a> | ";
                                                                echo "<a href='update_password.php?id=$ID' class='action'>UPDATE PASSWORD</a>";
                                                            }
                                                            } ?> </td>
                                            </tr>
                                            <!-- The Modal Nonaktif Akin -->
                                            <div class="modal" id="active<?=$ID;?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Nonaktifkan Akun</h4>
                                                        </div>

                                                        <!-- Modal body -->
                                                
                                                        <div class="modal-body">
                                                            <form action="submit_status_akun.php" class="form" method="post"> 
                                                                Anda Yakin Ingin Menonaktifkan Akun <?=$FullName?> ?
                                                                <input id="id" class="form-control" type="hidden" name="id" value="<?php echo $ID;?>" readonly/>
                                                                <input id="status" class="form-control" type="hidden" name="status" value="1" readonly/>

                                                                <div class="form-group">
                                                                    <label class="col-sm-2 col-sm-2 control-label"></label>
                                                                    <div class="modal-footer">
                                                                        <input type="submit" name="simpan" value="Nonaktifkan" class="btn btn-sm btn-primary" />&nbsp;
                                                                        <a href="#" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Batal </a>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- The Modal Aktifkan Akun-->
                                            <div class="modal" id="nonactive<?=$ID;?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Aktifkan Akun</h4>
                                                        </div>

                                                        <!-- Modal body -->
                                                
                                                        <div class="modal-body">
                                                            <form action="submit_status_akun.php" class="form" method="post"> 
                                                                Anda Yakin Ingin Mengaktifkan Akun <?=$FullName?> ?
                                                                <input id="id" class="form-control" type="hidden" name="id" value="<?php echo $ID;?>" readonly/>
                                                                <input id="status" class="form-control" type="hidden" name="status" value="0" readonly/>

                                                                <div class="form-group">
                                                                    <label class="col-sm-2 col-sm-2 control-label"></label>
                                                                    <div class="modal-footer">
                                                                        <input type="submit" name="simpan" value="Aktifkan" class="btn btn-sm btn-primary" />&nbsp;
                                                                        <a href="#" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Batal </a>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                    <a href="add_user.php" class="act-btn">
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
