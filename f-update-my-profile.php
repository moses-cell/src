<?php 
    require_once "library/global.php";
    require_once "library/session.php";
    require_once "library/page/b_global_parameter.php";
    require_once "library/page/b_f-hr-staff-profile.php";


    $roles = "HR - Update Staff Profile";
    $pages_name = "HR - Staff Profile";
    $title = "Staff Profile Form";
    $sub_menu = "HRIT";
    $nav_index = "1";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "pages/modalhead.php" ?> 
        <script src="assets/js/page/jf-hr-staff-profile.js"></script>
    </head>
    <body class="nav-fixed bg-light">
        <!-- Top app bar navigation menu-->
        <main id="main-modal" class="main-modal" >
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title mb-4 spaces"><?php echo $title; ?></div>
                                    <?php 
                                        include 'sub/hr-staff/sub-staff-profile-form.php'; 
                                    ?>
                                <div id="loading-overlay">
                                    <div class="loading-icon"></div>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </section>    
        </main>
        <?php include "pages/html_footer.php" ?>      
    </body>
</html>
