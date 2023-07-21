<?php 
    require_once "library/global.php";
    require_once "library/session.php";
    require_once "library/page/b_f-my-profile.php";
    require_once "library/page/b_global_parameter.php";
    
    $pages_name = "My Profile";
    $title = "Prasarana Employee Information";
    $sub_menu = "StaffSectionGroup";
    $nav_index = "1";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "pages/html_header.php" ?>
        <script src="assets/js/page/jf-hr-staff-profile.js"></script>
    
    </head>
    <body class="nav-fixed bg-light">
        <?php include "pages/top_nav.php" ?>
        <?php include "pages/left_menu.php" ?>
        <!-- Top app bar navigation menu-->
        <main id="main" class="main" >
            <div class="pagetitle" >
                <h1><?php echo $pages_name; ?></h1></h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item">Staff Section</li>
                        <li class="breadcrumb-item active">My Profile</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title"><?php echo $title; ?></div>
                                <div class="card-subtitle mb-4">Review and update staff information below.</div>
                                    <?php include 'sub/hr-staff/sub-staff-profile-form.php'; ?>
                                <div id="loading-overlay">
                                    <div class="loading-icon"></div>
                                </div>  
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
