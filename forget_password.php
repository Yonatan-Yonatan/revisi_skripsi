
<!-- Fungsi Forgotpassoword -->
<?php
    require 'email.php';
    session_start();
    if (empty($_SESSION['isLoggedin']))
    {
    }
    else{
         header("location: index.php");
    }

    if(isset($_POST["submit"]))
    {
        // cek apakah data berhasil di kirim atau tidak
        if(forgot($_POST) > 0)
        {
            // die(mysqli_error($conn));
            echo "
                <script>
                    alert('Tolong verify email anda yang kami telah kirim!');
                    document.location.href = 'login.php';
                </script>
            ";
        } else{
            $eror ="Maaf Email Tidak Ditemukan";
        }
    }
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
                <h2>Forget Password</h2>
            </div>
            <p style="color : red; font-weight: bold; padding-top: 15px;">
                <?php if (isset($eror)) 
                    {echo "$eror";} ?>
            </p>
            <p style="color : green; font-weight: bold; padding-top: 15px;">
                <?php if (isset($sukses)) 
                    {echo "$sukses";} ?>
            </p>
            
            <form method="post" class="form" action="">
                <label for="username" style="padding-top: 15px">&nbsp;
                    Email
                </label>
                <input id="email" class="form-content" type="email" name="email" required/>
                <div class="form-border"></div>
                <label for="Show Password" style="padding-top: 15px">
                <a>Have Account? <a href="login.php" class="form-content">Login Now</a></a>
                </label>
                <input id="submit-btn" type="submit" name="submit">
            </form>
        </div>
    </div>
</body>
</html>
