<?php
session_start();
if (isset($_SESSION['username'])) {
    header("location:../index.php");
} else {
    $noNav = '';
    $pageTitle = "verify";
    include "../src/init.php";
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $email = $_POST["email"];
        $verification_code = $_POST["verification_code"];
 
        // connect with database
        $ob = new dataConnection();
        $obb = new validator();
        $obb->check('verification_code', $verification_code, ['req', 'num']);

        if ($obb->checkerrors())
        {
            $result = $ob->select("name,verify_code", 'users', "WHERE email = '$email'", "", '');

            if($result['verify_code'] == $verification_code)
            {
                echo "<p>You can login now.</p>";
                $ob->update('users','email_verify_at = now()','email',"'$email'");
                header("location:../verified.php");
                exit();
            }else{
                echo "<p> enter your code correct.</p>";
                exit();
            }

        }else{
            $bigErrors = $obb->geterrors();
            foreach($bigErrors as $err)
            {
                echo "<div class='forHeaders'></div><div class='m-auto w-25 alert alert-danger'>".$err."</div></div>";
               
            }
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
                    <p class="login-box-msg">Enter your code to veriy email</p>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form" enctype="multipart/form-data">
                    <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">

                        <div class="form-group">
                            <div class="forRes">
                                <input type="text" name="verification_code" placeholder="Enter verification code" requierd class="form-control">
                                
                            </div>
                        </div>

                        <div class="row">
                            <!-- /.col -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Verify Email</button>
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