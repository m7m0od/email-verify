<?php
session_start();
if (isset($_SESSION['username'])) {
    $pageTitle='Verifired';
    include "public/initilition.php";
    ?>

<div class="row forHeaders">
<div class="col-md-12">
        <div class="w-perc text-center m-auto">
            <h1>verified <ion-icon class="forCarMargin" name="checkmark-done-outline"></ion-icon></h1>
            <img src="public/layout/uploads/delivery.png" class="w-100">
        </div>
    </div>
</div>
<?php
} else {
    header("location:auth/login.php");
}
include "public/inc/templates/footer.php";
?>

