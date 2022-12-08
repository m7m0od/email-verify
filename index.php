<?php
$pageTitle='Home';
include "public/initilition.php";
/*$ob = new dataConnection();
$members=$ob->threeJoin('members.*,categories.Name AS CATNAME,categories.Description AS description,subjects.Name AS SUBNAME,groups.Name AS GRONAME,groups.Date,groups.ID AS GROID','members','categories','categories.ID = members.Cat_ID','subjects','subjects.ID = members.Sub_ID','groups','groups.ID = members.gro_ID','','','ORDER BY gro_ID ASC');
*/?>

    <div class="row forHeaders">
    <div class="col-md-6">
            <div class="text-center m-auto">
                <img src="public/layout/uploads/email.jpg" class="w-100">
            </div>
        </div>
        <div class="offset-md-1 mt-4 col-md-5 d-flex justify-content-center">
            <div class="m-auto">
                <p class="lead fs-4 fw-bold">Email verification is a service that identifies possible spam traps and other email address discrepancies before they're flagged by Internet Service Providers (ISPs): </p>
                <div class="text-center">
                    <a href="verified.php" class="btn btn-info">verify your email</a>
                </div>
            </div>
        </div>
        
    </div>


<?php
include "public/inc/templates/footer.php";
?>