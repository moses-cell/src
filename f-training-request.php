<?php 
    require_once "library/global.php";
    require_once "library/session.php";
    require_once "library/page/b_f-training-request.php";
    require_once "library/page/b_global_parameter.php";
    
    $pages_name = "Training Request Form";
    $title = "Training Information";
    $sub_menu = "HRIT";
    $nav_index = "1";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "pages/html_header.php" ?>
        <link href="assets/vendor/timepicker/css/bootstrap-timepicker.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/jquery-ui.css">
        <script src="assets/vendor/timepicker/js/bootstrap-timepicker.js"></script>
        <script src="assets/js/page/jf-training-request.js"></script>
        <script src="assets/vendor/jquery/jquery-ui.js"></script>
        <script src="assets/js/jmodal-popup.js"></script>


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
                        <li class="breadcrumb-item">Secretary/Admin Section</li>
                        <li class="breadcrumb-item active">Training Request</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title"><?php echo $title; ?></div>
                                <div class="card-subtitle mb-4">Review and update internal training information below.</div>
                                    <?php 
                                     if (isset($_GET['id'])) {
                                        include 'sub/training-request/sub-tab-menu-form.php';
                                    } else {
                                        include 'sub/training-request/sub-training-request-form.php';
                                    }
                                        
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
        <?php include "pages/page_footer.php" ?>
        <?php include "pages/html_footer.php" ?>      
    </body>
</html>
