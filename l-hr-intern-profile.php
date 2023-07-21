<?php 
    require_once dirname(__FILE__)."/library/global.php";
    require_once dirname(__FILE__)."/library/session.php";
    
    $roles = 'HR Admin';
    $authorize = check_user_access($roles);

    $pages_name = "Prasarana Internship";
    $title = "Internship Profile List";
    $sub_menu = "HRIT";
    $nav_index = "0";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "pages/html_header.php" ?>
        <script src="assets/vendor/datatables/datatable.min.js"></script>
        <link href="assets/css/datatable.css" rel="stylesheet" />
        <script src="assets/js/jmodal-popup.js"></script>
        <script src="assets/js/page/jl-intern-profile.js"></script>

    </head>
    <body class="nav-fixed bg-light">
         <!-- Top app bar navigation menu-->
        <?php include "pages/top_nav.php" ?>
        <?php include "pages/left_menu.php" ?>

        <main id="main" class="main">
            <div class="pagetitle">
                <h1><?php echo $pages_name; ?></h1></h1>
                <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item">Internship Section</li>
                        <li class="breadcrumb-item active">Internship Student Profile</li>
                    </ol>
            </div><!-- End Page Title -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <?php
                                    include 'sub/intern/sub-intern-profile-list.php';
                                    
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
