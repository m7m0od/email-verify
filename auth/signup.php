<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
if (isset($_SESSION['username'])) {
    header("location:../index.php");
} else {

    $noNav = '';
    $pageTitle = "SignUp";
    include "../src/init.php";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
 
        //Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);
 
        try {
            //Enable verbose debug output
            $mail->SMTPDebug = 0;//SMTP::DEBUG_SERVER;
 
            //Send using SMTP
            $mail->isSMTP();
 
            //Set the SMTP server to send through
            $mail->Host = 'smtp.gmail.com';
 
            //Enable SMTP authentication
            $mail->SMTPAuth = true;
 
            //SMTP username
            $mail->Username = 'mg6783256@gmail.com';
 
            //SMTP password
            $mail->Password = 'your pass';
 
            //Enable TLS encryption;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
 
            //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            $mail->Port = 587;
 
            //Recipients
            $mail->setFrom('your_email@gmail.com', 'your_website_name');
 
            //Add a recipient
            $mail->addAddress($email, $name);
 
            //Set email format to HTML
            $mail->isHTML(true);
 
            $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
 
            $mail->Subject = 'Email verification';
            $mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';
 
            $mail->send();
            // echo 'Message has been sent';
 
            //$encrypted_password = password_hash($password, PASSWORD_DEFAULT);
            $encrypted_password = sha1($password);
            // connect with database
           
            // insert in users table
            $role = 2;
           
            $user = new dataConnection();
            $user->insert('users', 'name,password,email,role_id ,verify_code, email_verify_at', "'$name','$encrypted_password','$email','$role','$verification_code','NULL'");
        
            header("Location: mail.php?email=" . $email);
            exit();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
?>

    <div class="container forHeaders">
        <div class="login-box m-auto">
            <div class="login-logo">
                <a href="../index.php"><b>emailVerify</b></a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Sign in to start your session</p>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form" enctype="multipart/form-data">

                        <div class="form-group">

                            <div class="forRes">
                                <input type="text" name="name" requierd placeholder="type Full name of member" autocomplete="off" class="req form-control">
                                <i class="fa fa-asterisk"></i>
                                <div class="custom-alert alert alert-danger mt-1">
                                    <p>Full Name of member must be atleast 2 letters</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="forRes">
                                <input type="email" name="email" requierd placeholder="type name of category" autocomplete="off" class="req form-control">
                                <i class="fa fa-asterisk"></i>
                                <div class="custom-alert alert alert-danger mt-1">
                                    <p>email is required</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="forRes">
                                <input type="password" name="password" requierd placeholder="type strong password" autocomplete="new-password" class="passs inputForShow form-control">
                                <i class="show fa fa-eye"></i>
                                <div class="custom-alert alert alert-danger mt-1">
                                    <p>Password of member must be atleast 8 letters</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="forRes">
                                <input type="password" name="confirmPassword" requierd placeholder="type strong password" autocomplete="new-password" class="passs inputForShow form-control">
                                <i class="show fa fa-eye"></i>
                                <div class="custom-alert alert alert-danger mt-1">
                                    <p>confirm password</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <p class="mbbb">
                                    <a href="login.php" class="text-center">Already Have an Account ?</a>
                                </p>
                            </div>
                            <!-- /.col -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                            <!-- /.col -->
                        </div>

                    </form>
                </div>

                <!-- /.login-card-body -->
            </div>
        </div>
    </div>

<?php
}
include "../src/inc/templates/footer.php";
?>
