<?php
include '../config/connection.php';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;




require '../assets/vendor/phpmailer/phpmailer/src/Exception.php';
require '../assets/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../assets/vendor/phpmailer/phpmailer/src/SMTP.php';
require '../assets/vendor/autoload.php';

        //if user click login button
        if (isset($_POST['login'])) {
            $email =  $_POST['email'];
            $password = $_POST['password'];

            $check_email = "SELECT * FROM USERINFO WHERE email = '$email'";
            $res = sqlsrv_query($conn, $check_email);

            if (sqlsrv_has_rows($res)) {

                $fetch = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC);             
                
                $fetch_pass = $fetch['PASSWORD'];
               $encpass = md5($password);

                if ($encpass == $fetch_pass) {

                    $_SESSION['email'] = $email;
                    $status = $fetch['status'];

                    if ($status == 'verified') {

                        $verify_user = $fetch['privilege'];

                        if ($verify_user == "3") {
                            $_SESSION['name'] = $fetch['NAME'];
                            $_SESSION['email'] = $email;
                            $_SESSION['password'] = $password;
                           // header("location:../x_Adminstrator/index.php");
                            echo '<script>window.location.href = "../Adminstrator/index.php";</script>';
                        } else {
                            //to be rewrite
                            $info = "<p>Incorrect Previllage.!</p> <p>Please Sign in as Adminstrator</p>";
                            $_SESSION['info'] = $info;
                           //header('location:../index.php');
                           echo '<script>window.location.href = "../index.php";</script>';

                        }
                    } else {
                        $info = "<p>It's look like you haven't still verify your email - $email </p>";
                        $_SESSION['info'] = $info;
                       // header('location:../user-otp.php');
                        echo '<script>window.location.href = "../user-otp.php";</script>';

                    }
                } else {
                    //to be rewrite
                    $info = " <p>Incorrect email or password!.</p>";
                    $_SESSION['info'] = $info;
                   //header('location:../index.php');
                   echo '<script>window.location.href = "../index.php";</script>';

                }
            } else {
                $info = "<p>It's look like you're not yet Registered! Contact Your Manager</p>";
                $_SESSION['info'] = $info;
               // header('location:../index.php');
                echo '<script>window.location.href = "../index.php";</script>';

                //to be rewrite
            }
        }
 
            //forgot password
           //when user click continue button in forgot password form
           if (isset($_POST['check-email'])) {
            $email = $_POST['email'];
            $check_email = "SELECT * FROM USERINFO WHERE email = '$email'";
            $run_sql = sqlsrv_query($conn, $check_email);
        
            if (sqlsrv_has_rows($run_sql)) {
                $code = rand(111111, 999999);

                $insert_code = "UPDATE USERINFO SET code = $code WHERE email = '$email'";
                $run_query = sqlsrv_query($conn, $insert_code);
        
                if ($run_query) {

                        echo "<div style='display: none;'>";
                        //Create an instance; passing `true` enables exceptions




                        $mail = new PHPMailer(true);
        
                        try {
                            //Server settings
                            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                            $mail->isSMTP();                                            //Send using SMTP
                            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                            $mail->Username   = 'imagesystems511@gmail.com';                     //SMTP username
                            $mail->Password   = 'cwipiopdpqwjhatt';                               //SMTP password
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
                            //Recipients
                            $mail->setFrom('imagesystems511@gmail.com');
                            $mail->addAddress($email);
        
                            //Content
                            $mail->isHTML(true);                                  //Set email format to HTML
                            $mail->Subject = 'Password Reset Code';
                            $mail->Body = 'Your password reset code is : ' . $code;
        
                            $mail->send();                                   
                            //goto otp page
                            //  $_SESSION['info'] = $info;
                            $_SESSION['email'] = $email;
                            $_SESSION['password'] = $password;



                            $info = "<p> Enter The code That sent to your Email $email </p>";
                            $_SESSION['info'] = $info;

                        echo '<script>window.location.href = "../reset-code.php";</script>';
                            exit();
                        } catch (Exception $e) {
                            //to be re write
                $info = "<p> Failed while sending code! Sorry :)</p> <p>Try again after connecting to Internet </p>";
                $_SESSION['info'] = $info;
                //header('Location: ../forgot-password.php');
                echo '<script>window.location.href = "../forgot-password.php";</script>';

                        }
                    }
                    return $run_query;                            
                
                } else {
                $info = "<p>This email address does not exist!</p>";
                $_SESSION['info'] = $info;
                //header('Location: ../forgot-password.php');
                echo '<script>window.location.href = "../forgot-password.php";</script>';

            }    
        }


        //if user click check reset otp button
        if (isset($_POST['check-reset-otp'])) {
            $_SESSION['info'] = "";

            $otp_code = $_POST['otp'];

            //app class
            $query = "SELECT * FROM USERINFO WHERE code = $otp_code";
            $code_res = sqlsrv_query($conn, $query);


            if (sqlsrv_has_rows($code_res) > 0) {
                $fetch_data = sqlsrv_fetch_array($code_res);
                $email = $fetch_data['email'];
                $_SESSION['email'] = $email;
                $info = "Please create a new password that you don't use on any other site.";
                $_SESSION['info'] = $info;
                //header('location: ../new-password.php');
                echo '<script>window.location.href = "../new-password.php";</script>';

                exit();
            } else {
                   //to be re write
                   $info = "<p> You've entered incorrect code! </p>";
                   $_SESSION['info'] = $info;
                  // header('Location: ../reset-code.php');
                   echo '<script>window.location.href = "../reset-code.php";</script>';

            }
        }



        //if user click change password button
        if (isset($_POST['change-password'])) {

            $_SESSION['info'] = "";
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];

            if ($password !== $cpassword) {
                    //to be re write
                    $info = "<p> Confirm password Doesn't Match. </p> <p>Try again :) </p>";
                    $_SESSION['info'] = $info;
                   // header('Location: ../new-password.php');
                    echo '<script>window.location.href = "../new-password.php";</script>';

            } else {
                $code = 0;
                $email = $_SESSION['email']; //getting this email using session
                $encpass = md5($password);
                $update_pass = "UPDATE USERINFO SET code = $code, password = '$encpass' WHERE email = '$email'";
                $run_query = sqlsrv_query($conn, $update_pass);
                if ($run_query) {
                     $info = "<p> Your password changed. Now you can login with your new password. </p>";
                     $_SESSION['info'] = $info;
                    header('Location: ../index.php');
                    echo '<script>window.location.href = "../index.php";</script>';                   

                } else {
                      $info = "<p> Failed to change your password! </p>";
                      $_SESSION['info'] = $info;
                     header('Location: ../new-password.php');
                     echo '<script>window.location.href = "../new-password.php";</script>';                   
                    
                }
            }
        }
  
     











?>