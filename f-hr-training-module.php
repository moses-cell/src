<?php 
    require_once "library/global.php";
    require_once "library/session.php";
    require_once "library/page/b_f-hr-training-module.php";
    require_once "library/page/b_global_parameter.php";
    
    $pages_name = "HR - Training Module Form";
    $title = "Training Module Information";
    $sub_menu = "HRIT";
    $nav_index = "1";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "pages/html_header.php" ?>
        <script src="assets/js/page/jf-training-module.js"></script>
        <link rel="stylesheet" href="assets/css/jquery-ui.css">
        <script src="assets/vendor/jquery/jquery-ui.js"></script>

    </head>
    <body class="nav-fixed bg-light">
        <?php include "pages/top_nav.php" ?>
        <?php include "pages/left_menu.php" ?>
        <!-- Top app bar navigation menu-->
        <main id="main" class="main" >
            <div class="pagetitle" >
                <h1><?php echo $pages_name; ?></h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item">HR Section</li>
                        <li class="breadcrumb-item">Training</li>
                        <li class="breadcrumb-item active">Training Module</li>
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
                                    <?php include 'sub/training-module/sub-training-module-form.php'; ?>
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
