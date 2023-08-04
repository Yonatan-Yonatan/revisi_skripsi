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
<body class="sb-nav-fixed">

<nav class="sb-topnav navbar navbar-expand">
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Brand-->
            <a href="index.php"><img src="images/logo-1.png" width="170"></a>
            <!-- Notification-->
            <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#myModal">
                    <i class="fa-sharp fa-solid fa-bell fa-lg" style="color: #080808;"></i>
                </button>
            </div> 
            <!-- Navbar-->
             <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i> <?php echo $_SESSION['fullname']; ?></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <?php if($_SESSION['level'] == "admin" || $_SESSION['level'] == "kasir"){?>
                        <li><a class="dropdown-item" href="update_password_user.php">Change Password</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <?php } ?>
                        <li><a class="dropdown-item"  onClick="Logout()">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Notifications</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
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

                    $datastok1 = mysqli_query($koneksi, "select * from produk where qty < min_qty and qty > 0");
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
                </div>
            </div>
        </div>
    </div>

        <script>
            function Logout() {
                let text;
                if (confirm("Apakah Anda Ingin Keluar?!") == true) {
                    alert('Anda telah berhasil keluar.'); window.location = 'logout.php';
                } else {
                    
                }
                document.getElementById("demo").innerHTML = text;
            }
        </script>

</body>
</html>