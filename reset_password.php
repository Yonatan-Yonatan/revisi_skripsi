<!DOCTYPE html>
<?php
include ("conn.php");
    require 'email.php';
	if (isset($_GET["key"]) && isset($_GET["id"]) && isset($_GET["action"]) && ($_GET["action"]=="reset") && !isset($_POST["action"]))
	{
		$key = $_GET["key"] ;
		$id = $_GET["id"];
		
		$curDate = date("Y-m-d H:i:s");
		$query = "SELECT * FROM token WHERE email='$id' AND token='$key'";
		$result = mysqli_query($koneksi, $query);
		$row = mysqli_num_rows($result);
		
		if (!mysqli_fetch_assoc($result))
		{
			// goto html;
		}
        else
        {
?>

            
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Inventory Wahana Service</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
</head>

<body>
    <div id="card">
        <div id="card-content">
            <div id="card-title">
                <h2>Reset Password</h2>
            </div>
                            
            <form method="post" class="form">
            <input type="hidden" class="form-control form-control-xl" name="email" value="<?=$id?>" readonly>
                <label for="username" style="padding-top: 15px">&nbsp;
                    New Password
                </label>
                <input id="new_password" class="form-content" type="password" name="new_password" autocomplete="on" required/>
                <div class="form-border"></div>
                <label for="Show Password" style="padding-top: 15px">
                    <input type="checkbox" onclick="showPassword()"/>Show Password</input>
                </label>
                <label for="password" style="padding-top: 30px">&nbsp;
                    Confirm Password
                </label>
                <input id="confirm_password" class="form-content" type="password" name="confirm_password" required/>
                <div class="form-border"></div>
                <label for="Show Password" style="padding-top: 15px">
                    <input type="checkbox" onclick="showPassword2()"/>Show Password</input>
                </label>
                
                <input id="submit-btn" type="submit" name="submit" value="SUBMIT">

                <!-- Change Password -->
                <?php
                    if(isset($_POST["submit"]))
                        {
                            // cek apakah data berhasil di ubah atau tidak
                            if(change_password($_POST) > 0)
                            {
                                echo "
                                    <script>
                                        alert('Password berhasil diubah!');
                                        document.location.href = 'login.php';
                                    </script>
                                ";
                            } else {
                                $error = true;
                            }
                        }
                ?>
           
            </form>
        </div>
    </div>
               
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

                <script>
        function showPassword() 
        {
            var x = document.getElementById("new_password");
              if (x.type === "password") 
            {
                x.type = "text";
              }
            else 
            {
                x.type = "password";
              }
        }

        function showPassword2() 
        {
            var x = document.getElementById("confirm_password");
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
        </script>

        
            </html>
<?php
        }
    }
?>
