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
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
</head>
    <body>
        <div>
            <div >
                <main>
                    
                                <div class="table-responsive">
                                    <table id="datatablesSimple">
                                    
                                       
                                            
                                            <?php 
                                                $sSQL="";
                                                $sSQL="select * from produk p, supplier s where p.id_supplier = s.id_supplier  order  by id_produk";
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
                                                        $nama_supplier=$row['nama_supplier'];
                                            ?>		
                                                                
                                                <tr>
                                                    <td><?php echo $nama_produk;?></td>
                                                    <td><?php echo $jenis_produk;?></td>
                                                    <td><?php echo $qty;?></td>
                                                    <td><?php echo FormatUang($harga);?></td>
                                                    <td><?php echo $nama_supplier;?></td>
                                                    <?php if($_SESSION['level'] == "owner"){?>
                                                    <td><?php echo "<a href='update_barang.php?id_produk=$id_produk' class='action'>UPDATE</a> | 
                                                                    <a href='delete_barang.php?id_produk=$id_produk' class='action' onclick='return konfirmasi();'>DELETE</a>"; ?> </td>
                                                    <?php } ?>
                                                </tr>

                                            <?php	   
                                                    }
                                                } 
                                            ?>
                                       
                                        </tbody>
                                    </table>
                                </div>
                          
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      setInterval(function() {
        $.ajax({
          url: "data.php",
          success: function(result) {
            $('#test').html(result);
          }
        });
      }, 2000); // refresh setiap 5 detik
    });
  </script>
</script>
    </body>
</html>
