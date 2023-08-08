<?php
include "conn.php"; 
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function forgot($data)
{
    global $koneksi; 
    $email =htmlspecialchars($data["email"]);
    //$query= mysqli_query($conn,"SELECT iduser FROM login WHERE email='$email'");
    $result = mysqli_query($koneksi,"SELECT id FROM user WHERE email='$email' and status_akun ='0'");
    if($result)
    {
        // die(mysqli_error($conn));
        $row = mysqli_fetch_assoc($result);
        $id= $row["id"]; 
        if($id > 0)
        {
            //date exp
            $expFormat = mktime(date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y"));
            $expDate = date("Y-m-d H:i:s",$expFormat);

            //token
            $key = sha1(2418*2+(int)$email);
            $addKey = substr(sha1(uniqid(rand(),1)),3,10);
            $key = $key . $addKey;

            // Insert Temp Table
            $query = "INSERT INTO token
                            VALUES 
                            ('', '$id', '$key', '$expDate')
                        ";
            mysqli_query($koneksi, $query);
            $output='<p>Dear user,</p>';
            $output.='<p>Silahkan klik link dibawah untuk mengganti password</p>';
            $output.='<p>-------------------------------------------------------------</p>';
            // Buat halaman lupa password
            $output.='<p><a href="localhost/inventory_skripsi/reset_password.php?key='.$key.'&id='.$id.'&action=reset" target="_blank">
            https://localhost/inventory_skripsi/reset_password.php?key='.$key.'&id='.$id.'&action=reset</a></p>';
            // Buat halaman lupa password
            $output.='<p>-------------------------------------------------------------</p>';
            $output.='<p>Harap klik link segera. Token akan expired dalam 24 jam. </p>';
            $output.='<p>Jika Anda tidak meminta forget password, harap abaikan pesan ini. Namun, akun anda kemungkinan sudah disalahgunakan, harap ganti password anda segera.</p>';
            $output.='<p>Terima Kasih,</p>';
            $output.='<p>Wahana Service</p>';
            $body = $output; 
            $subject = "Forgot Password - Wahana Service";

            //Load Composer's autoloader
            require 'PHPMailer/src/Exception.php';
            require 'PHPMailer/src/PHPMailer.php';
            require 'PHPMailer/src/SMTP.php';

            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);
            try 
            {
                //$fromserver = "noreply@localhost.com"; 
                $mail->SMTPDebug = 0;
                $mail->Host = "smtp.mail.yahoo.com"; // Enter your host here
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->Username = "steffi_kris@yahoo.co.id"; // Enter your email here
                $mail->Password = "nrjhzfhwqrywfjti"; //Enter your password here
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port = 465;
                
                $mail->setFrom('steffi_kris@yahoo.co.id', 'LocalHost');
                $mail->addAddress($email);
                //$mail->Sender = $fromserver; // indicates ReturnPath header

                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body = $body;
                
                if(!$mail->send())
                {
                    echo "Mailer Error: " . $mail->ErrorInfo;
                    return false;
                }
                else
                {
                    echo "<script> 
                            alert('Tolong verify email anda yang kami telah kirim!');
                            document.location.href = 'login.php';
                            </script>";
                }
            } 
            catch (Exception $e) 
            {
                echo "<script> alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}')</script>";
                return false;
            }
        } else {
            $eror ="Maaf Email Tidak Ditemukan";
        }
    }
}

function change_password($data)
    {
        global $koneksi;

        $n_password = mysqli_real_escape_string($koneksi, $data["new_password"]);
        $r_password = mysqli_real_escape_string($koneksi, $data["confirm_password"]);

        if($data["email"]!="")
        {
            $id = htmlspecialchars($data["email"]);

            if($n_password == $r_password)
            {
                // enkripsi password
                $n_password = sha1($n_password);

                //$query insert data
                $query = "UPDATE user SET
                    password = '$n_password'
                    WHERE id = '$id'
                ";
                mysqli_query($koneksi, $query);
                mysqli_query($koneksi,"DELETE FROM token WHERE email='$id'");
                
                return mysqli_affected_rows($koneksi);
            }
            else
            {
                echo "<script> alert('Password Tidak Sama!')</script>";
                return false;
            }
        }
        else
        {
            $username = $_SESSION["username"];
            // ambil data dari tial elemen dalam form
            $password = mysqli_real_escape_string($koneksi, $data["password"]);
            //cek username sudah ada atau belum
            $result = mysqli_query($koneksi, "SELECT password FROM user WHERE username = '$username'");
            $row = mysqli_fetch_assoc($result);
            $o_password = $row["password"];

            if(password_verify($password, $o_password))
            {
                if(password_verify($password, $o_password))
                {
                    echo "<script> alert('Password Sudah Dipakai!')</script>";
                    return false;   
                }
                else
                {
                    if($password == $r_password)
                    {
                        // enkripsi password
                        // $password = sha1($password);

                        //$query insert data
                        $query = "UPDATE user SET
                            password = '$password'
                            WHERE username = '$username'
                        ";
                        mysqli_query($koneksi, $query);

                        
                        return mysqli_affected_rows($koneksi);
                    }
                    else
                    {
                        echo "<script> alert('Password Tidak Sama!')</script>";
                        return false;
                    }
                }
            }
            else
            {
                echo "<script> alert('Password Salah!')</script>";
                return false;
            }
        }
    }
?>