<?php
session_start();
if (isset($_SESSION['username'])) {
    header("location:../index.php");
} else {
    $noNav = '';
    $pageTitle = "SignUp";
    include "../src/init.php";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $hashpass = sha1($pass);

        $ob = new dataConnection();

        $result = $ob->select("id,email_verify_at,name,password,role_id", 'users', "WHERE email = '$email'", "AND password = '$hashpass'", '');
    
        if (empty($result))
        {
            echo "Email not found.";
            exit();
        }elseif ($result['email_verify_at']== null)
        {
            echo "Please verify your email <a href='mail.php?email=" . $email . "'>from here</a>";
            exit();
        }
        
        $_SESSION['username'] = $result['name'];
        header("location:../verified.php");
        exit();
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
                                <input type="email" name="email" requierd placeholder="type name of category" autocomplete="off" class="req form-control">
                                <i class="fa fa-asterisk"></i>
                                <div class="custom-alert alert alert-danger mt-1">
                                    <p>email is required</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="forRes">
                                <input type="password" name="pass" requierd placeholder="type strong password" autocomplete="new-password" class="passs inputForShow form-control">
                                <i class="show fa fa-eye"></i>
                                <div class="custom-alert alert alert-danger mt-1">
                                    <p>Password of member must be atleast 8 letters</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <p class="mbbb">
                                    <a href="signup.php" class="text-center">Register a new membership</a>
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