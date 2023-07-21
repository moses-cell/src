<?php 
    require_once dirname(__FILE__)."/library/global.php";
    require_once dirname(__FILE__)."/library/session.php";
    require_once dirname(__FILE__)."/library/page/b_l-staff-profile.php";

    $roles = 'HR Admin';
    $authorize = check_user_access($roles);
    $pages_name = "HR - Employee Profile";
    $title = "Prasarana Employee List";
    $sub_menu = "HRIT";
    $nav_index = "0";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "pages/html_header.php" ?>
        <link href="assets/css/datatable.css" rel="stylesheet" />
        <script src="assets/vendor/datatables/datatable.min.js"></script>
        <script src="assets/js/jmodal-popup.js"></script>
        <script src="assets/js/page/jl-staff-profile.js"></script>

    </head>
    <body class="nav-fixed bg-light">
         <!-- Top app bar navigation menu-->
        <?php include "pages/top_nav.php" ?>
        <?php include "pages/left_menu.php" ?>

        <main id="main" class="main">
            <div class="pagetitle">
                <h1><?php echo $pages_name; ?></h1></h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item">HR Section</li>
                        <li class="breadcrumb-item active">Staff Profile</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <?php
                                    if ($authorize) 
                                        include 'sub/hr-staff/sub-staff-profile-list.php';
                                    else
                                        include 'sub/not-authorize.php';
                                ?>
                            </div>
                        </div>                        
                    </div>
                </div>
            </section>

        </main>
        
        <?php include "pages/page_footer.php" ?>
        <?php include "pages/html_footer.php" ?>    
    </body>
</html>
