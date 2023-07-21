<?php 
    require_once dirname(__FILE__)."/library/global.php";
    require_once dirname(__FILE__)."/library/session.php";
    require_once dirname(__FILE__)."/library/page/b_f-hr-trainer-profile.php";
    
    $pages_name = "HR - Trainer Profile Form";
    $title = "Trainer Profile";
    $sub_menu = "HRIT";
    $nav_index = "1";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "pages/html_header.php" ?>
        <script src="assets/vendor/datatables/datatable.min.js"></script>
        <link href="assets/css/datatable.css" rel="stylesheet" />

        <script src="assets/js/page/jf-trainer-profile.js"></script>
        <script src="assets/js/page/jl-trainer-profile-employment.js"></script>
        <script src="assets/js/page/jl-trainer-profile-academic.js"></script>
        <script src="assets/js/page/jl-trainer-profile-training.js"></script>
        <script type="text/javascript"  src="assets/js/plugins/mask.money.js"></script>
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
                        <li class="breadcrumb-item">HR Section</li>
                        <li class="breadcrumb-item">Trainer</li>
                        <li class="breadcrumb-item active">Trainer Profile</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <nav class="nav">
                                <a class="nav-link tab-link tab-link-active " id='profile_tab' href="#profile">Trainer Profile</a>
                                <a class="nav-link tab-link" id='working_tab' href="#working">Working Experience</a>
                                <a class="nav-link tab-link" id='academic_tab' href="#academic">Academic Qualification</a>
                                <a class="nav-link tab-link" id='training_tab' href="#training">Training Course Attended</a>
                            </nav>
                            <div class="card-body">
                                <div id='profile_form'>
                                    <div class="card-title"><?php echo $title; ?></div>
                                    <div class="card-subtitle mb-4">Review and update staff information below.</div>
                                    <?php include 'sub/trainer-profile/sub-trainer-profile-form.php'; ?>
                                </div>
                                <div id='working_form' style='display: none;'>
                                    <div class="card-title">Working Experience</div>
                                    <div class="card-subtitle mb-4">Review and update trainer working experience below.</div>
                                    <?php include 'sub/trainer-profile/sub-trainer-employement-form.php'; ?>
                                </div>
                                <div id='academic_form' style='display: none;'>
                                    <div class="card-title">Academic Qualification</div>
                                    <div class="card-subtitle mb-4">Review and update trainer academmic qualification below.</div>
                                    <?php include 'sub/trainer-profile/sub-trainer-academic-form.php'; ?>
                                </div>
                                <div id='training_form' style='display: none;'>
                                    <div class="card-title">Training Course Attended</div>
                                    <div class="card-subtitle mb-4">Review and update trainer training course attended below.</div>
                                    <?php include 'sub/trainer-profile/sub-trainer-training-form.php'; ?>
                                </div>
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
