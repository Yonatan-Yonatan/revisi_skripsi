<?php 
include "conn.php"; 

session_start();
if (empty($_SESSION['isLoggedin']))
{
}
else{
    header("location: index.php");
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
                <h2>Login</h2>
            </div>
            <p style="color : red; font-weight: bold; padding-top: 15px;">
                <?php if (isset($_GET['error'])) 
                    {echo "$_GET[error]";} 
                    else { echo "";} ?>
            </p>
            
            <form method="post" class="form" action="proseslogin.php">
                <label for="username" style="padding-top: 15px">&nbsp;
                    User Name
                </label>
                <input id="text" class="form-content" type="username" name="username" autocomplete="on" required/>
                <div class="form-border"></div>
                <label for="password" style="padding-top: 15px">&nbsp;
                    Password
                </label>
                <input id="password" class="form-content" type="password" name="password" required/>
                <div class="form-border"></div>
                <label for="Show Password" style="padding-top: 15px">
                    <input type="checkbox" onclick="showPassword()"/>Show Password
                </label>
                <input id="submit-btn" type="submit" name="submit" value="LOGIN">

            </form>
        </div>
    </div>

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
